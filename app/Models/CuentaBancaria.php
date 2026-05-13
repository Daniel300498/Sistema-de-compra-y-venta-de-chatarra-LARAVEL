<?php

namespace App\Models;

<<<<<<< HEAD
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class CuentaBancaria extends Model
{
    use SoftDeletes;

    protected $table = 'cuentas_bancarias';
    protected $fillable = [
        'banco',
        'numero_cuenta',
        'numero_cuenta_ultimos',
        'titular',
        'documento_titular',
        'moneda',
        'activa',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    protected $casts = [
    'numero_cuenta' => 'encrypted',
    ];
 
    public function gastos()
    {
        return $this->hasMany(GastoExtra::class, 'cuenta_bancaria_id');
    }
=======
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
>>>>>>> ad5e84fe54142e47ab2a5b29fb9c1ac4968296a4

    protected static function boot()
    {
        parent::boot();
<<<<<<< HEAD
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
=======
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
>>>>>>> ad5e84fe54142e47ab2a5b29fb9c1ac4968296a4
