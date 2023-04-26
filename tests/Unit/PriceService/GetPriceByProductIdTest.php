<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PriceService;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetPriceByProductIdTest extends TestCase
{
    use RefreshDatabase;

    public function testGetPriceByProductId()
    {
        
        $priceService = new PriceService();
        $product = Product::factory()->create();

        $price = $priceService->create($product->id, 200);

        $prices = $priceService->getByProductId($product->id);

        if($prices->first()->id === $price->id)
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
