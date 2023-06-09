<?php

namespace Tests\Unit\ProductService;

use App\Services\PriceService;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetProductByIdWithPricesTest extends TestCase
{
    use RefreshDatabase;

    public function testGetProductByIdWithPrices()
    {
        $productService = new ProductService();
        $priceService = new PriceService();

        $product = $productService->create('Name', 'Description');
        $price = $priceService->create($product->id, 200);

        $productWithPrice = $productService->getByIdWithPrices($product->id);

        if ($productWithPrice->prices->first()->id === $price->id) {
            $result = true;
        } else {
            $result = false;
        }

        $this->assertTrue($result);

    }
}
