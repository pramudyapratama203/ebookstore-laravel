<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'book_id',
        'quantity',
        'total',       
        'status',
        'date',
        'description',
        'rating',
        'review',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}