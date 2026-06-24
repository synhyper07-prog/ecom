<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model{
    protected $fillable = ['full_name','phone_no', 'email', 'address', 'country', 'city', 'user_id', 'postal_code'];
    public $timestamps = false;
}