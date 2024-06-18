<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    public $timestamps = false;
    use SoftDeletes;
    protected $fillable = [
       'coupon_time',
        'coupon_condition',
        'coupon_number',
        'coupon_code',
        'coupon_name',
    ];

    protected $primaryKey = 'coupon_id';
    protected $table = 'coupons';


}
