<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Internacion extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
     protected $table='internaciones';
      protected $fillable = [
        'fecha',
        'paciente_id',
        'cama_id',
        'medico_id',
        'fecha_ocupacion',
        'fecha_desocupacion',
        'motivo',
        'observaciones', 
        'nombre_cobertura',
        'tipo_cobertura',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
     public function pacientes(){
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
    public function camas()
    {
        return $this->belongsTo(Cama::class, 'cama_id');
    }
    public function medicos(){
        return $this->belongsTo(Medico::class, 'medico_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
