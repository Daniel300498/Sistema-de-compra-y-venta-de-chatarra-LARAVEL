<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class Contrato extends Model implements Auditable
{
    use HasFactory, SoftDeletes, Userstamps;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'contratos';

    protected static function boot()
    {
        parent::boot();

        // Generar UUID automáticamente al crear
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }


    protected $fillable = [
        'documento',
        'fecha_ini',
        'fecha_fin',
        'nro_contrato',
        'empleado_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class,'empleado_id');
    }
  }
