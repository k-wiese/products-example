<?php

namespace Tests\Unit\ProductService;

use App\Models\Product;
use App\Services\PriceService;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProductWithPricesTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $productService = new ProductService();

        $priceService = new PriceService();

        $price = $priceService->create($product->id, 200);

        if ($product->prices->count() === 1) {
            $result = true;
        } else {
            $result = false;
        }

        $this->assertTrue($result);

        $productService->deleteWithPrices($product->id);

        $this->assertDatabaseMissing('prices', ['id' => $price->id]);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
