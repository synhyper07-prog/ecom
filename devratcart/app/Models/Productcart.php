<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Productcart extends Model{
    protected $fillable = ['id', 'user_id', 'product_id', 'qty', 'amount', 'items', 'color', 'cart_keys', 'cart_values', 'created_at', 'size', 'price', 'is_read'];
    public $timestamps = false;
}

?>