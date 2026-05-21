<?php

namespace App\Service;

use App\Repository\ProductRepository;
use App\Transformer\ProductTransformer;

class ProductService
{
    public function __construct(
        private ProductRepository $repository,
        private ProductTransformer $transformer
    ) {}

    public function getProducts(int $page, int $limit): array
    {
        $offset = ($page - 1) * $limit;

        $list  = $this->repository->findPaginated($limit, $offset);
        $total = $this->repository->count();

        $items = [];

        foreach ($list as $product) {
            $items[] = $this->transformer->transform($product);
        }

        return [
            'items' => $items,
            'total' => $total
        ];
    }

    public function getProductById(int $id): array
    {
        $product = $this->repository->findById($id);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        return $this->transformer->transform($product);
    }
}