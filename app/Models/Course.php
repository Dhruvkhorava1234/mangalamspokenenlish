<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'price',
        'status',
        'level',
        'duration',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    /**
     * Images/slides belonging to this course.
     */
    public function images(): HasMany
    {
        return $this->hasMany(CourseImage::class)->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Orders for this course.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Paid orders scope.
     */
    public function paidOrders(): HasMany
    {
        return $this->hasMany(Order::class)->where('payment_status', 'paid');
    }

    /**
     * Scope published courses.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
