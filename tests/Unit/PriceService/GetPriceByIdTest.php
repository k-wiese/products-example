<?php

namespace Tests\Unit\PriceService;

use App\Models\Price;
use App\Services\PriceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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

        if ($priceFromService->id === $priceFromEloquent->id) {
            $result = true;
        } else {
            $result = false;
        }

        $this->assertTrue($result);
    }
}
