<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SellerFaqsChild extends Model{
	public $timestamps = false;
    protected $fillable = ['id', 'seller_faq_id', 'sub_heading', 'detail', 'is_active'];
}

?>