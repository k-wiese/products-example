<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
