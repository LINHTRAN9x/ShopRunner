<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
