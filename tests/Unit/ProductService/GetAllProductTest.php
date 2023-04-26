<?php

namespace Tests\Unit\ProductService;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAllProductTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllProduct()
    {
        $productService = new ProductService();
        $products = Product::factory()->count(3)->create();

        $allProducts = $productService->getAll();

        $this->assertEquals($allProducts->count(), 3);

        foreach ($products as $product) {
            $this->assertContains($product->name, $allProducts->pluck('name'));
            $this->assertContains($product->description, $allProducts->pluck('description'));
        }
    }
}
