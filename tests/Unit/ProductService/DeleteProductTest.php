<?php

namespace Tests\Unit\ProductService;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $productService = new ProductService();

        $this->assertDatabaseHas('products', ['id' => $product->id]);

        $productService->delete($product->id);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);

    }
}
