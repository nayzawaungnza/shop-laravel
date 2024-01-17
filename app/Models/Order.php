<?php

namespace App\Models;

use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Product;
use App\Models\Township;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id',
                            'company_name',
                            'shipping_country_id',
                            'shipping_state_id',
                            'shipping_township_id',
                            'shipping_zip',
                            'shipping_address',

                            'different_shipping_country_id',
                            'different_shipping_state_id',
                            'different_shipping_township_id',
                            'different_shipping_address',
                            'different_shipping_phone',

                            'payment_method',
                            'total_amount',
                            'payment_status',
                            'order_date',
                            'order_note',
                            'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // Define the relationship with the countries table
    public function shipping_country()
    {
        return $this->belongsTo(Country::class);
    }

    // Define the relationship with the states table
    public function shipping_state()
    {
        return $this->belongsTo(State::class);
    }

    // Define the relationship with the townships table
    public function shipping_township()
    {
        return $this->belongsTo(Township::class);
    }

    // Define the relationship with the countries table
    public function different_shipping_country()
    {
        return $this->belongsTo(Country::class);
    }

    // Define the relationship with the states table
    public function different_shipping_state()
    {
        return $this->belongsTo(State::class);
    }

    // Define the relationship with the townships table
    public function different_shipping_township()
    {
        return $this->belongsTo(Township::class);
    }

}
