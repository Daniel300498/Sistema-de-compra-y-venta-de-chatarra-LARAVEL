<?php

namespace App\Models;

use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CamionConductor extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, Userstamps;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'camion_conductores';

    protected $fillable = [
        'camion_id',
        'conductor_id',
        'fecha_inicio',
        'fecha_fin',
        'observaciones',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class, 'camion_id');
    }

    public function conductor()
    {
        return $this->belongsTo(OperadorTransporte::class, 'conductor_id');
    }

    public function estaActivo(): bool
    {
        return is_null($this->fecha_fin);
    }
}
