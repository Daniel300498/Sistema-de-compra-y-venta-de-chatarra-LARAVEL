<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Paciente extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'ci',
        'ci_complemento',
        'ci_lugar',
        'nombres',
        'ap_paterno',
        'ap_materno',
        'fecha_nacimiento',
        'edad',
        'email',
        'domicilio',
        'sexo',
        'nro_celular',
        'direccion',
        'contacto_nombre',
        'contacto_telefono',
        'contacto_parentesco',
        'created_by',
        'updated_by',
        'deleted_by',
        
    ];
    public function internaciones()
    {      
        return $this->hasMany(Internacion::class); 
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
