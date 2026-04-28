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
        'fecha_asignacion',
        'estado_entrega',
        'conductor_id',
        'observaciones',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'toneladas'        => 'decimal:3',
        'fecha_asignacion' => 'date',
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

    // Peso total entregado al cliente (tramos finales Entregado)
    public function getPesoEntregadoAttribute(): float
    {
        return (float) $this->tramos()
            ->whereDoesntHave('tramosHijos')
            ->where('estado', 'Entregado')
            ->sum('peso_llegada');
    }
}
