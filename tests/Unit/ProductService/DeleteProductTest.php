<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
