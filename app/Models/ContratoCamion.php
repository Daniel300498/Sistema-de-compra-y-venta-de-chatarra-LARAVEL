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
}
