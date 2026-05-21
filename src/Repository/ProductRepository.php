<?php

namespace App\Repository;

use Pimcore\Model\DataObject\Product;

class ProductRepository
{
    public function findPaginated(int $limit, int $offset)
    {
        $list = new Product\Listing();

        $list->setLimit($limit);
        $list->setOffset($offset);
        $list->setOrderKey('oo_id');
        $list->setOrder('DESC');

        return $list->load();
    }

    public function count(): int
    {
        return Product::getList()->getTotalCount();
    }

    public function findById(int $id): ?Product
    {
        return Product::getById($id);
    }
}