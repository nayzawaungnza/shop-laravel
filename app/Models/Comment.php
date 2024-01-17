<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\CommentLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment','parent_id'];

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getLikeCountAttribute()
    {
        return $this->likes->count();
    }

    // Relationship with parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relationship with child comments (replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }


}
