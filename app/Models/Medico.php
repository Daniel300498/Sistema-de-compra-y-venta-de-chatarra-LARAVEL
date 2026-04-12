<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Medico extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'nombres',
        'ap_paterno',
        'ap_materno',
        'especialidad',
        'telefono',
        'correo',
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
