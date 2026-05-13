<?php

namespace App\Models;

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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}