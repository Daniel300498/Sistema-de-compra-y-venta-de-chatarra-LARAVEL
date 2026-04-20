<?php
namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class Contacto extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'uuid',
        'tipo',
        'valor',
        'contactable_id',
        'contactable_type',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $casts = [
        'principal' => 'boolean',
    ];
    public function contactable()
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}