<p>Puede realizar la búsqueda del funcionario ingresando el número de carnet o fecha en el listado siguiente.</p>


<form action="{{ route('refrigerios.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-1">
        <label for="fecha" class="col-sm-12 col-md-4 control-label text-right">
            Fecha <span class="text-danger">(*)</span>
        </label>
        <div class="col-sm-12 col-md-8">
            <input id="fecha" type="date" class="form-control {{ $errors->has('fecha') ? ' error' : '' }}"name="fecha" value="{{ old('fecha', isset($area) ? $area->fecha : '') }}"onkeyup="this.value = this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        </div>
    </div>
    <div class="row mb-1">
        <label for="tipo_dato" class="col-sm-12 col-md-4 control-label text-right">Tipo Información</label>
        <div class="col-md-4">
            <select name="tipo_dato" id="tipo_dato" class="form-control">
                <option value="">Seleccionar...</option>
                <option value="X" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'X' ? 'selected' : '' }}>ASISTENCIA</option>
                <option value="AB" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'AB' ? 'selected' : '' }}>ABANDONO</option>
                <option value="BM" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'BM' ? 'selected' : '' }}>BAJA MEDICA</option>
                <option value="BP" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'BP' ? 'selected' : '' }}>BAJA DE PERSONAL</option>
                <option value="C" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'C' ? 'selected' : '' }}>CUMPLEAÑOS</option>
                <option value="LCH" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'LCH' ? 'selected' : '' }}>LICENCIA CON HABER</option>
                <option value="LSH" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'LSH' ? 'selected' : '' }}>LICENCIA SIN GOCE</option>
                <option value="C" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'C' ? 'selected' : '' }}>COMISION</option>
                <option value="F" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'F' ? 'selected' : '' }}>FALTA</option>
                <option value="T" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'T' ? 'selected' : '' }}>TRANSFERENCIA</option>
                <option value="CL" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'CL' ? 'selected' : '' }}>COMPENSACION LABORAL</option>
                <option value="D" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'D' ? 'selected' : '' }}>DESCANSO</option>
                <option value="XOS" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'XOS' ? 'selected' : '' }}>ORDEN DE SALIDA</option>
                <option value="XHP" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'XHP' ? 'selected' : '' }}>HORA PARTICULAR</option>
                <option value="XJM" {{ old('tipo_dato', $refrigerio->tipo_dato) == 'XJM' ? 'selected' : '' }}>JUSTIFICATIVO MEDICO</option>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{ $texto }}</button>
            <a href="{{ route('refrigerios.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</form>
</div>
</div>
</section>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Refrigerios Registrados del funcionario Seleccionado</h5>
                    <p class="mb-0">
                        Desde el men&uacute; de <strong>Opciones</strong> puede editar o eliminar una &aacute;rea.
                    </p>
                    <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar el &aacute;rea que corresponda.</p>
                    
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                               <th>Nro Item</th>
                                <th>Sueldo</th>
                                <th>Nro Item</th>
                                <th>Sueldo</th>
                                <th>Dias habiles trabajados</th>
                                <th>Faltas</th>
                                <th>Abandono</th>
                                <th>Vacacion</th>
                                <th>LCGH</th>
                                <th>LSGH</th>
                                <th>Asueto</th>
                                <th>Viaticos</th>
                                <th>Feriados</th>
                                <th>Importe Diario</th>
                                <th>Total a Pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                                <tr>
                                <td>{{$cargoEmpleado->cargo->nro_item}}</td>
                                <td> {{$cargoEmpleado->cargo->sueldo}}</td>
                                <td> {{$cargoEmpleado->cargo->nro_item}}</td>
                                <td> {{$cargoEmpleado->cargo->sueldo}}</td>
                                <td> {{$refrigerio->dias_trabajados }}</td>
                                <td> {{$refrigerio->faltas }}</td>
                                <td> {{ $refrigerio->abandono }}</td>
                                <td> {{ $refrigerio->vacacion }}</td>
                                <td> {{ $refrigerio->LCH }}</td>
                                <td> {{ $refrigerio->LSH }}</td>
                                <td> {{ $refrigerio->ASUETO }}</td>
                                <td> {{ $refrigerio->VIATICOS }}</td>
                                <td> {{ $refrigerio->feriado }}</td>
                                <td> Bs. 17.00</td>
                                <td> Bs. {{ number_format($refrigerio->dias_trabajados * 17, 2) }}</td>
                                </tr>
                         </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>@foreach($diasArray as $dia)<th>{{ $dia }}</th>@endforeach</tr>
                            <tr>@for ($i = 1; $i <= $diasEnElMes; $i++)<th>{{$i}}</th>@endfor</tr>
                        </thead>
                        <tbody>
                            @foreach($biometricoMensual as $registro)
                                <tr>
                                    @for($i = 1; $i <= $diasEnElMes; $i++)
                                        @php $valor = $registro->{'col_'.$i}; @endphp
                                        <td class="{{ 
                                            $valor == 'X' ? 'bg-success' : 
                                            ($valor == 'F' ? 'bg-danger' : 
                                            ($valor == 'AB' ? 'bg-warning' : ''))
                                        }}">
                                            {{ $valor }}
                                        </td>
                                    @endfor
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

