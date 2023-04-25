<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductApiController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllWithPrices();

        return response(json_encode($products), 200)
            ->header('Content-Type', 'application/json');
    }

    public function show(string $id)
    {
        if (!is_numeric($id)) 
        {
            return response('Error - Invalid ID', 400)
                ->header('Content-Type', 'text/plain');
        }

        $product = $this->productService->getByIdWithPrices($id);

        return response(json_encode($product), 200)
            ->header('Content-Type', 'application/json');

    }

}
