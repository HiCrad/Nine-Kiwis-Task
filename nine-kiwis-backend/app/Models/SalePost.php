<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SalePost extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_SOLD = 1;

    protected $fillable = [
        'user_id',
        'title',
        'price',
        'category',
        'condition',
        'photos',
        'brand',
        'description',
        'tags',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'photos' => 'array',
    ];

    public function getStatusAttribute($value)
    {
        return $value == self::STATUS_PENDING ? 'Pending' : 'Sold';
    }

    public function setStatusAttribute($value)
    {
        if ($value == 'Pending') {
            $this->attributes['status'] = self::STATUS_PENDING;
        } elseif ($value == 'Sold') {
            $this->attributes['status'] = self::STATUS_SOLD;
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Get the photos attribute as an array.
     */
    public function getPhotosAttribute($value)
    {
        $photoPaths = json_decode($value);

        if (!is_array($photoPaths)) {
            return [];
        }

        return array_map(function ($photo) {
            return $photo;
        }, $photoPaths);
    }
}
