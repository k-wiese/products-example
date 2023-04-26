<?php

namespace Tests\Unit\PriceService;

use App\Models\Price;
use App\Services\PriceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletePriceTest extends TestCase
{
    use RefreshDatabase;

    public function testDeletePrice()
    {

        $price = Price::factory()->create();

        $priceService = new PriceService();

        $this->assertDatabaseHas('prices', ['id' => $price->id]);

        $priceService->delete($price->id);

        $this->assertDatabaseMissing('prices', ['id' => $price->id]);
    }
}
