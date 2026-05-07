<?php

namespace App\Models;

use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrato extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'contratos';

    protected $fillable = [
        'numero_contrato',
        'tipo_contrato',
        'cliente_id',
        'proveedor_id',
        'fecha_inicio',
        'fecha_fin',
        'cantidad_camiones',
        'toneladas_contrato',
        'monto_total',
        'moneda',
        'estado',
        'documento_pdf',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'fecha_inicio'       => 'date',
        'fecha_fin'          => 'date',
        'monto_total'        => 'decimal:2',
        'toneladas_contrato' => 'decimal:3',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid            = Str::uuid()->toString();
            $model->numero_contrato = self::generarNumero();
        });
    }

    public static function generarNumero(): string
    {
        $anio   = date('Y');
        $ultimo = self::withTrashed()
            ->where('numero_contrato', 'like', "CTR-{$anio}-%")
            ->max('numero_contrato');

        $correlativo = 1;
        if ($ultimo) {
            $partes      = explode('-', $ultimo);
            $correlativo = (int) end($partes) + 1;
        }

        return sprintf('CTR-%s-%03d', $anio, $correlativo);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function contratoCamiones()
    {
        return $this->hasMany(ContratoCamion::class, 'contrato_id');
    }

    // Toneladas declaradas por el proveedor (suma peso_declarado de tramos raíz)
    public function getToneladasAsignadasAttribute(): float
    {
        return (float) $this->contratoCamiones()->sum('toneladas');
    }

    // Toneladas realmente entregadas al cliente (suma peso_llegada de tramos finales Entregado)
    public function getToneladasEntregadasAttribute(): float
    {
        $total = 0;
        foreach ($this->contratoCamiones as $cc) {
            $total += $cc->tramos()
                ->whereDoesntHave('tramosHijos')
                ->where('estado', 'Entregado')
                ->sum('peso_llegada');
        }
        return (float) $total;
    }

    // Toneladas en tránsito (tramos finales aún no entregados)
    public function getToneladasEnTransitoAttribute(): float
    {
        $total = 0;
        foreach ($this->contratoCamiones as $cc) {
            $total += $cc->tramos()
                ->whereDoesntHave('tramosHijos')
                ->whereIn('estado', ['Pendiente', 'En tránsito', 'En frontera'])
                ->sum('peso_salida');
        }
        return (float) $total;
    }

    // Porcentaje de toneladas entregadas respecto al total pactado
    public function getPorcentajeToneladasAttribute(): float
    {
        if (!$this->toneladas_contrato || $this->toneladas_contrato == 0) return 0;
        return min(100, round(($this->toneladas_entregadas / $this->toneladas_contrato) * 100, 1));
    }

    // Clientes únicos a los que se entregó carga en este contrato
    public function getClientesEntregadosAttribute()
    {
        $clienteIds = collect();
        foreach ($this->contratoCamiones as $cc) {
            $ids = $cc->tramos()
                ->whereDoesntHave('tramosHijos')
                ->where('estado', 'Entregado')
                ->whereNotNull('cliente_id')
                ->pluck('cliente_id');
            $clienteIds = $clienteIds->merge($ids);
        }
        return Cliente::whereIn('id', $clienteIds->unique())->orderBy('nombre')->get();
    }
}
