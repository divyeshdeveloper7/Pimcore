<?php

namespace App\Transformer;

use Pimcore\Model\DataObject\Product;
use App\DTO\ProductDTO;

class ProductTransformer
{
    public function transform(Product $product): array
    {
        return [
            'id'    => $product->getId(),
            'name'  => $product->getName(),
            'price' => (float) $product->getPrice(),
            'sku'   => $product->getSku(),
        ];
    }
}