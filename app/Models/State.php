<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Country;
use App\Models\Township;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name','country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
    }

    // Define the relationship with the orders table
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
