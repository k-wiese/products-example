<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PriceService;
use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetPriceByIdTest extends TestCase
{
    use RefreshDatabase;

    public function testGetPriceById()
    {

        $priceService = new PriceService();

        $prices = Price::factory()->count(3)->create();
        $id = $prices->first()->id;

        $priceFromService = $priceService->getById($id);
        $priceFromEloquent = Price::findOrFail($id);

        if($priceFromService->id === $priceFromEloquent->id)
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
