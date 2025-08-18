<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
    'name',
    'email',
    'phone',
    'is_client',
    'is_supplier',
    'is_employee'
];

    protected $casts = [
        'is_client' => 'boolean',
        'is_employee' => 'boolean',
        'is_supplier' => 'boolean',
        'is_partner' => 'boolean',
        'has_price_table' => 'boolean',
        'icms_taxpayer' => 'boolean'
    ];

    public function getDocumentFormattedAttribute()
    {
        if ($this->nature === 'physical') {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->document);
        }

        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $this->document);
    }
}
