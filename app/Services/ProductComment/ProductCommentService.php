<?php

namespace App\Services\ProductComment;

use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Services\BaseService;

class ProductCommentService extends BaseService implements ProductCommentServiceInterface
{
    public $repository;
    public function __construct(ProductCommentRepositoryInterface $ProductCommentRepository)
    {
        $this->repository = $ProductCommentRepository;
    }
}
