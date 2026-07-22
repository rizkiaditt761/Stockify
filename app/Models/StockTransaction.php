<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'confirmed_by',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
        'transaction_date',
        'confirmed_at',
        'status',
        'notes',
        'rejection_reason',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'confirmed_at'     => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Produk yang ditransaksikan
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Manager/Admin yang membuat transaksi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Staff yang mengonfirmasi transaksi
    public function confirmedBy()
    {
        return $this->belongsTo(
            User::class,
            'confirmed_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helper
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status === 'Pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'Completed';
    }

    public function isRejected(): bool
    {
        return $this->status === 'Rejected';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'Cancelled';
    }
}