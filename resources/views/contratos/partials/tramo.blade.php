@php
    $estadoColor = [
        'En tránsito'  => 'primary',
        'En frontera'  => 'warning text-dark',
        'Transbordado' => 'info text-dark',
        'Entregado'    => 'success',
    ];
    $estadoIcono = [
        'En tránsito'  => 'bi-truck',
        'En frontera'  => 'bi-sign-stop',
        'Transbordado' => 'bi-arrow-left-right',
        'Entregado'    => 'bi-check-circle',
    ];
    $color  = $estadoColor[$tramo->estado]  ?? 'secondary';
    $icono  = $estadoIcono[$tramo->estado]  ?? 'bi-circle';
    $hijos  = $tramo->tramosHijos;
    $indent = $nivel * 20;
@endphp

<div class="border rounded p-2 mb-2 {{ $nivel > 0 ? 'border-start border-3 border-info' : '' }}"
     style="margin-left: {{ $indent }}px; position: relative;">

    {{-- Badge de estado: siempre arriba a la derecha --}}
    <span class="badge bg-{{ $color }}" style="position: absolute; top: 8px; right: 8px;">
        <i class="bi {{ $icono }}"></i> {{ $tramo->estado }}
    </span>

    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2" style="padding-right: 110px;">

        {{-- Info del tramo --}}
        <div>
            @if($nivel > 0)
                <span class="text-muted me-1">
                    @for($i = 0; $i < $nivel; $i++)<i class="bi bi-arrow-return-right"></i>@endfor
                </span>
            @endif

            <span class="badge bg-{{ $tramo->tipo_tramo === 'Internacional' ? 'danger' : 'secondary' }} me-1">
                {{ $tramo->tipo_tramo }}
            </span>
            <strong>{{ $tramo->origen }}</strong>
            <i class="bi bi-arrow-right mx-1 text-muted"></i>
            <strong>{{ $tramo->destino }}</strong>

            <span class="ms-2 text-muted small">
                <i class="bi bi-truck"></i> {{ $tramo->camion->placa }} {{ $tramo->camion->marca }}
                @if($tramo->conductor)
                    &nbsp;·&nbsp;<i class="bi bi-person"></i> {{ $tramo->conductor->nombre_completo }}
                @endif
            </span>
        </div>

        {{-- Acciones --}}
        <div class="d-flex align-items-center gap-2 flex-wrap">

            @can('contratos.edit')
                {{-- Botón llegada: visible si está en tránsito --}}
                @if($tramo->estado === 'En tránsito')
                    <button class="btn btn-sm btn-outline-success"
                        onclick="abrirModalLlegada(
                            '{{ $tramo->uuid }}',
                            '{{ $tramo->origen }} → {{ $tramo->destino }} ({{ $tramo->camion->placa }})',
                            '{{ $tramo->peso_salida }}',
                            '{{ $tramo->fecha_salida->format('Y-m-d') }}'
                        )">
                        <i class="bi bi-geo-alt"></i> Registrar llegada
                    </button>
                @endif

                {{-- Botón agregar transbordo: solo si está en frontera --}}
                @if($tramo->estado === 'En frontera')
                    @php
                        $yaAsignadoHijos = (float) $tramo->tramosHijos()->sum('peso_salida');
                        $disponibleTransbordo = round((float) $tramo->peso_llegada - $yaAsignadoHijos, 3);
                    @endphp
                    <button class="btn btn-sm btn-outline-info"
                        onclick="abrirModalTransbordo(
                            {{ $tramo->contrato_camion_id }},
                            {{ $tramo->id }},
                            '{{ addslashes($tramo->destino) }}',
                            '{{ addslashes($tramo->origen) }} → {{ addslashes($tramo->destino) }} ({{ $tramo->camion->placa }})',
                            {{ $disponibleTransbordo }},
                            '{{ $tramo->fecha_llegada?->format('Y-m-d') }}'
                        )"
                        {{ $disponibleTransbordo <= 0 ? 'disabled' : '' }}>
                        <i class="bi bi-arrow-down-right"></i> Agregar transbordo
                        @if($disponibleTransbordo > 0)
                            <span class="badge bg-light text-dark ms-1">{{ number_format($disponibleTransbordo, 3) }} t disp.</span>
                        @else
                            <span class="badge bg-danger ms-1">Sin toneladas</span>
                        @endif
                    </button>
                @endif

                {{-- Eliminar: solo si no está entregado/transbordado y no tiene hijos --}}
                @if(!in_array($tramo->estado, ['Entregado', 'Transbordado']) && $hijos->isEmpty())
                    <a href="{{ route('tramo.destroy', $tramo->uuid) }}"
                        class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('¿Eliminar este tramo?')">
                        <i class="bi bi-trash"></i>
                    </a>
                @endif
            @endcan
        </div>
    </div>

    {{-- Línea 1: pesos --}}
    <div class="mt-2 d-flex flex-wrap gap-3">
        @if($nivel === 0 && $tramo->peso_declarado)
            <small class="text-muted">
                <i class="bi bi-tag"></i> Declarado por proveedor:
                <strong>{{ number_format($tramo->peso_declarado, 3) }} t</strong>
            </small>
        @elseif($nivel > 0 && $tramo->peso_salida)
            <small class="text-muted">
                <i class="bi bi-box-arrow-up"></i> Salida:
                <strong>{{ number_format($tramo->peso_salida, 3) }} t</strong>
            </small>
        @endif
        @if($tramo->peso_llegada)
            @php $diff = $tramo->peso_salida ? $tramo->peso_salida - $tramo->peso_llegada : 0; @endphp
            <small class="{{ $diff > 0 ? 'text-warning' : 'text-success' }}">
                <i class="bi bi-box-arrow-in-down"></i> Llegada:
                <strong>{{ number_format($tramo->peso_llegada, 3) }} t</strong>
                @if($diff > 0)
                    <span class="text-danger">(−{{ number_format($diff, 3) }} t)</span>
                @endif
            </small>
        @endif
    </div>
    {{-- Línea 2: fechas con origen/destino --}}
    <div class="d-flex flex-wrap gap-3">
        @if($tramo->fecha_salida)
            <small class="text-muted">
                <i class="bi bi-calendar"></i> Salida desde <strong>{{ $tramo->origen }}</strong>: {{ $tramo->fecha_salida->format('d/m/Y') }}
            </small>
        @endif
        @if($tramo->fecha_llegada)
            <small class="text-muted">
                <i class="bi bi-calendar-check"></i> Llegada a <strong>{{ $tramo->destino }}</strong>: {{ $tramo->fecha_llegada->format('d/m/Y') }}
            </small>
        @endif
    </div>

    @if($tramo->observaciones)
        <small class="text-muted d-block mt-1">
            <i class="bi bi-chat-left-text"></i> {{ $tramo->observaciones }}
        </small>
    @endif
</div>

{{-- Tramos hijos recursivos --}}
@foreach($hijos as $hijo)
    @include('contratos.partials.tramo', [
        'tramo'               => $hijo,
        'nivel'               => $nivel + 1,
        'camionesDisponibles' => $camionesDisponibles,
    ])
@endforeach
