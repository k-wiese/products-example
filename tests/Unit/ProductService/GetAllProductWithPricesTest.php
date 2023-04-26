<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Price;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;


class GetAllProductWithPricesTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllProductWithPrices()
    {
        $productWithPrices1 = Product::factory()->create();
        Price::factory()->create(['product_id' => $productWithPrices1->id,]);
        $productWithPrices2 = Product::factory()->create();
        Price::factory()->create(['product_id' => $productWithPrices2->id]);

        $productWithoutPrice = Product::factory()->create();
        
        $productService = new ProductService();
        $products = $productService->getAllWithPrices();
        $this->assertTrue($products->contains($productWithPrices1));
        $this->assertTrue($products->contains($productWithPrices2));

        foreach ($products as $product) 
        {
            $this->assertTrue($product->relationLoaded('prices'));
        }
    }
}
