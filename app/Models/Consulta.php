<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Consulta extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
      protected $fillable = [
        'fecha',
        'paciente_id',
        'motivo_consulta',
        'diagnostico',
        'observaciones', 
    ];
     public function pacientes(){
        return $this->belongsTo(Paciente::class);
    }
     public function recetas()
    {      
        return $this->hasMany(Receta::class); 
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
