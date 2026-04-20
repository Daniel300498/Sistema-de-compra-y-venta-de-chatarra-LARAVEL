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
        'monto_total',
        'moneda',
        'estado',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
        'monto_total'  => 'decimal:2',
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
}
