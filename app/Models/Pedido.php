<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'producto',
        'cantidad',
        'observaciones',
        'estado',
    ];

    /**
     * Los valores por defecto para los atributos del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'estado' => 'pendiente',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cantidad' => 'integer',
    ];
}
