<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class Sala extends Model implements Auditable
{
    use HasFactory, SoftDeletes, Userstamps;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'salas';

    protected $fillable = [
        'nombre',
        'piso',
        'tipo',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',  
        ];

        protected static function boot()
        {
            parent::boot();
            static::creating(function ($model) {
                $model->uuid = Str::uuid()->toString();
            });
        }
        public function camas()
        {      
            return $this->hasMany(Cama::class); //Areas es el nombre del modelo /models/cama.php
        }

}
