<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Publicacion extends Model implements Auditable
{
    use HasFactory, SoftDeletes, Userstamps, AuditableTrait;

    protected $table = 'publicaciones';

    protected $fillable = [
        'titulo',
        'fecha_registro',
        'fecha_publicacion',
        'fecha_caducidad',
        'estado',
        'motivo',
        'documento',
        'descripcion',
        'tipo',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

}
