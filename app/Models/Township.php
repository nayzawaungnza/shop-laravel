<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Township extends Model
{
    use HasFactory;

    protected $fillable = ['name','state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    // Define the relationship with the orders table
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
