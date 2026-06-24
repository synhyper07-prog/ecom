<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends model{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'class_id',
        'subject_id',
        'topic_name',
        'is_active',
        'updated_at',
        'created_at'
    ];
}
