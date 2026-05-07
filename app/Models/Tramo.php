<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;
use App\Models\Cliente;

class Tramo extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'tramos';

    protected $fillable = [
        'contrato_camion_id',
        'tramo_padre_id',
        'camion_id',
        'conductor_id',
        'cliente_id',
        'origen',
        'destino',
        'tipo_tramo',
        'peso_declarado',
        'peso_salida',
        'peso_llegada',
        'descuento_porcentaje',
        'observaciones_llegada',
        'fecha_salida',
        'fecha_llegada',
        'estado',
        'activo',
        'observaciones',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'peso_declarado' => 'decimal:3',
        'peso_salida'    => 'decimal:3',
        'peso_llegada'   => 'decimal:3',
        'fecha_salida'   => 'date',
        'fecha_llegada'  => 'date',
        'activo'         => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($m) => $m->uuid = Str::uuid()->toString());
    }

    // El camión asignado al contrato al que pertenece este tramo
    public function contratoCamion()
    {
        return $this->belongsTo(ContratoCamion::class);
    }

    // Tramo anterior del que se originó (transbordo)
    public function tramoPadre()
    {
        return $this->belongsTo(Tramo::class, 'tramo_padre_id');
    }

    // Tramos hijos generados por transbordo en este tramo
    public function tramosHijos()
    {
        return $this->hasMany(Tramo::class, 'tramo_padre_id');
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function conductor()
    {
        return $this->belongsTo(OperadorTransporte::class, 'conductor_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Un tramo es "final" si no tiene hijos (llega al cliente)
    public function esFinal(): bool
    {
        return $this->tramosHijos()->count() === 0;
    }
}
