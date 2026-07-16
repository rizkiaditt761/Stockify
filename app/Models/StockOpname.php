<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockOpname extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'system_stock',
        'physical_stock',
        'difference',
        'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}