<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CamionFoto extends Model
{
    protected $table = 'camion_fotos';

    protected $fillable = ['camion_id', 'ruta'];

    public function camion()
    {
        return $this->belongsTo(Camion::class, 'camion_id');
    }
}
