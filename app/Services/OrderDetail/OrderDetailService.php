<?php

namespace App\Services\OrderDetail;

use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Services\BaseService;

class OrderDetailService extends BaseService implements OrderDetailServiceInterface
{
    public $repository;
    public function __construct(OrderDetailRepositoryInterface $OrderDetailRepository)
    {
        $this->repository = $OrderDetailRepository;
    }
}
