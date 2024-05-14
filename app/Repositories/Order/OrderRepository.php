<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    public function getModel()
    {
        return Order::class;
    }

    public function getOrderByUserId($userId)
    {
        return $this->model->where('user_id',$userId)
            ->orderBy("id","desc")
            ->get();
    }
}
