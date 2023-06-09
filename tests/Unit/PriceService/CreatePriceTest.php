<?php

namespace Tests\Unit\PriceService;

use App\Services\PriceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePriceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePrice()
    {

        $priceService = new PriceService();
        $product_id = 5;
        $priceValue = 200;

        $price = $priceService->create($product_id, $priceValue);

        $this->assertDatabaseHas('prices', [
            'id' => $price->id,
            'product_id' => $product_id,
            'price' => $priceValue,
        ]);
    }
}
