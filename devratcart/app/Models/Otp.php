<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Otp extends Model{
    protected $fillable = ['mobile_no', 'otp_str', 'status', 'id'];
    public $timestamps = false;
}

?>