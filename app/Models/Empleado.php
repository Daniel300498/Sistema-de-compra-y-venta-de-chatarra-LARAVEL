<?php

namespace App\Models;

use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'apellido',
        'ci',
        'cargo',
        'telefono',
        'email',
        'activo',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($m) => $m->uuid = Str::uuid()->toString());
    }

    public function getNombreCompletoAttribute(): string
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
