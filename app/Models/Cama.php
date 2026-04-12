<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Cama extends Model implements Auditable
{
    use HasFactory, SoftDeletes, Userstamps;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'camas';

    protected $fillable = [
        'numero',
        'estado',
        'sala_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
    public function internaciones()
    {      
        return $this->hasMany(Internacion::class); 
    }
    public function salas()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }
}
