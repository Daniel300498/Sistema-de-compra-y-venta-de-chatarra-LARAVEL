<?php

namespace App\Models;

use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuentaBancaria extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'cuentas_bancarias';

    protected $fillable = [
        'banco_id', 'tipo_titular', 'titular_id', 'titular_type',
        'numero_cuenta', 'moneda', 'alias', 'activo',
        'created_by', 'updated_by',
    ];

    protected $casts = ['activo' => 'boolean'];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($m) => $m->uuid = Str::uuid()->toString());
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }

    public function titular()
    {
        return $this->morphTo();
    }

    public function getNombreTitularAttribute(): string
    {
        return match($this->tipo_titular) {
            'empresa'   => 'Empresa (cuenta propia)',
            'proveedor' => $this->titular?->nombre ?? '—',
            'operador'  => $this->titular?->nombre_completo ?? '—',
            default     => '—',
        };
    }
}
