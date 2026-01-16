<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'servicio_interes',
        'mensaje',
        'leido',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'leido' => 'boolean',
    ];
}
