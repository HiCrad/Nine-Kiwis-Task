<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
