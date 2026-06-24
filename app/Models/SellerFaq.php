<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SellerFaq extends Model{
	public $timestamps = false;
    protected $fillable = ['heading', 'is_active', 'id']; 

    public function list(){
        return $this->hasMany(SellerFaqsChild::class, 'seller_faq_id', 'id');
    } 
}

?>