<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category',
        'price',
        'cover_color',
        'rating',
        'sold',
        'is_new',
        'seller_id',
        'description',
        'pages',
        'language',
        'publisher',
        'year',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'is_new' => 'boolean',
            'year' => 'integer',
        ];
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}