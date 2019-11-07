<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'product';

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'discount_type',
        'status',
        'created_at',
        'created_by',
        'updated_at'
    ];



}
