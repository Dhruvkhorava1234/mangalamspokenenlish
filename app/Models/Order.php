<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'amount',
        'payment_status',
        'transaction_id',
        'payment_method',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'expires_at' => 'datetime',
        ];
    }

    /**
     * Check if this order/subscription is currently active (not expired).
     */
    public function isActive(): bool
    {
        if ($this->payment_status !== 'paid') {
            return false;
        }

        if ($this->expires_at === null) {
            // Default 1 year validity from order creation if not explicitly set
            return $this->created_at->addYear()->isFuture();
        }

        return $this->expires_at->isFuture();
    }

    /**
     * Check if this subscription has expired.
     */
    public function isExpired(): bool
    {
        return ! $this->isActive();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->withTrashed();
    }
}
