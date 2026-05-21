<?php

namespace App\Controller\Api\V1;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    public function __construct(
        private ProductService $productService
    ) {}

    #[Route('/api/v1/products', name: 'api_products_list', methods: ['GET'])]
    public function list(Request $request): JsonResponse
    {
        $page  = (int) $request->get('page', 1);
        $limit = (int) $request->get('limit', 20);

        $data = $this->productService->getProducts($page, $limit);

        return $this->json([
            'status' => 'success',
            'data'   => $data['items'],
            'meta'   => [
                'page'  => $page,
                'limit' => $limit,
                'total' => $data['total']
            ]
        ]);
    }

    #[Route('/{id}', name: 'api_product_detail', methods: ['GET'])]
    public function detail(int $id): JsonResponse
    {
        $product = $this->productService->getProductById($id);

        return $this->json([
            'status' => 'success',
            'data'   => $product
        ]);
    }
}