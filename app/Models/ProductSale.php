<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSale extends Pivot
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_value',
    ];
}
