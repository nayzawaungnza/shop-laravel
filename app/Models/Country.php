<?php

namespace App\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name','iso_code'];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    // Define the relationship with the orders table
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
