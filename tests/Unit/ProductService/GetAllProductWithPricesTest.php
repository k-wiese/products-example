<?php

namespace Tests\Unit\ProductService;

use App\Models\Price;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAllProductWithPricesTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllProductWithPrices()
    {
        $productWithPrices1 = Product::factory()->create();
        Price::factory()->create(['product_id' => $productWithPrices1->id]);
        $productWithPrices2 = Product::factory()->create();
        Price::factory()->create(['product_id' => $productWithPrices2->id]);

        $productService = new ProductService();
        $products = $productService->getAllWithPrices();
        $this->assertTrue($products->contains($productWithPrices1));
        $this->assertTrue($products->contains($productWithPrices2));

        foreach ($products as $product) {
            $this->assertTrue($product->relationLoaded('prices'));
        }
    }
}
