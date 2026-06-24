<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Size extends Model{
	public $timestamps = false;
    protected $fillable = ['category_id', 'subcategory_id', 'child_subcategory_id', 'size', 'id'];
}

?>