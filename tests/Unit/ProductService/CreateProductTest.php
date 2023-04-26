<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProduct()
    {

        $product = Product::factory()->create();
        $productService = new ProductService();
        $name = 'Created product name';
        $description = 'Created product description';

   
        $product = $productService->create($name, $description);

        
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
