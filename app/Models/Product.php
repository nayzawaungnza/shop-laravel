<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','name','slug','description','image','price','waiting_time','view_count','status'];


    public function items()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
