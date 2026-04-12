<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Receta extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table='recetas';
    protected $fillable = [
        'medico_id',
        'consulta_id',
        'indicaciones_generales',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    public function consultas(){
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }
    public function medicos(){
        return $this->belongsTo(Medico::class, 'medico_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
