<?php

namespace Tests\Unit\ProductService;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateProduct()
    {

        $product = Product::factory()->create();
        $productService = new ProductService();
        $name = 'Updated product name';
        $description = 'Updated product description';

        $productService->update($product->id, $name, $description);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
