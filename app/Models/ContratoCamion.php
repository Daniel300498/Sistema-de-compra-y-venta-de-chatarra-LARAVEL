<?php

namespace App\Models;

use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContratoCamion extends Model
{
    use HasFactory, Userstamps;

    protected $table = 'contrato_camiones';

    protected $fillable = [
        'contrato_id',
        'camion_id',
        'toneladas',
        'monto_acordado',
        'moneda_flete',
        'fecha_asignacion',
        'estado_entrega',
        'conductor_id',
        'observaciones',
        'activo',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'toneladas'        => 'decimal:3',
        'monto_acordado'   => 'decimal:2',
        'fecha_asignacion' => 'date',
        'activo'           => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class, 'camion_id');
    }

    public function conductor()
    {
        return $this->belongsTo(OperadorTransporte::class, 'conductor_id');
    }

    public function tramos()
    {
        return $this->hasMany(Tramo::class, 'contrato_camion_id');
    }

    // Tramos raíz (sin padre): el primer tramo de cada cadena
    public function tramosRaiz()
    {
        return $this->hasMany(Tramo::class, 'contrato_camion_id')->whereNull('tramo_padre_id');
    }

    public function pagos()
    {
        return $this->hasMany(PagoCamion::class, 'contrato_camion_id');
    }

    // Peso total entregado al cliente (tramos finales Entregado)
    public function getPesoEntregadoAttribute(): float
    {
        return (float) $this->tramos()
            ->whereDoesntHave('tramosHijos')
            ->where('estado', 'Entregado')
            ->sum('peso_llegada');
    }

    // Descuento en monto: se toma el mayor descuento_porcentaje registrado en tramos finales
    public function getDescuentoMontoAttribute(): float
    {
        if (!$this->monto_acordado) return 0;
        $pct = (float) $this->tramos()
            ->whereDoesntHave('tramosHijos')
            ->whereNotNull('descuento_porcentaje')
            ->max('descuento_porcentaje');
        return round($this->monto_acordado * $pct / 100, 2);
    }

    // Monto neto a pagar después del descuento
    public function getMontoNetoAttribute(): float
    {
        return max(0, (float)($this->monto_acordado ?? 0) - $this->descuento_monto);
    }

    // Total ya pagado
    public function getTotalPagadoAttribute(): float
    {
        return (float) $this->pagos()->whereNull('deleted_at')->sum('monto');
    }

    // Saldo pendiente
    public function getSaldoPendienteAttribute(): float
    {
        return max(0, $this->monto_neto - $this->total_pagado);
    }
}
