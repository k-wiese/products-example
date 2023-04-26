<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetProductByIdTest extends TestCase
{
    use RefreshDatabase;

    public function testGetProductById()
    {
        $productService = new ProductService();

        $products = Product::factory()->count(3)->create();
        $id = $products->first()->id;

        $productFromService = $productService->getById($id);
        $productFromEloquent = Product::findOrFail($id);

        if($productFromService->id === $productFromEloquent->id)
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        $this->assertTrue($result);

    }
}
