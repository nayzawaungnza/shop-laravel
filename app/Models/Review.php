<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use App\Models\CommentLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','product_id','rating','comment'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function customer()
    {
        return $this->belongsTo(User::class);
    }

        // public function likes()
        // {
        //     return $this->hasMany(CommentLike::class);
        // }

}
