<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['produto', 'quantidade', 'valor_unitario', 'data_venda'];

    protected $casts = [
        'data_venda' => 'date'
    ];

    public function getFaturamentoAttribute()
    {
        return $this->quantidade * $this->valor_unitario;
    }
}
