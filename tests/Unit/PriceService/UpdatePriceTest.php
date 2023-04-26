<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PriceService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePriceTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdatePrice()
    {
        
        $priceService = new PriceService;
        $price = $priceService->create(5, 200);

        $price = $priceService->update($price->id, 500);

        if($price->price === 500)
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
