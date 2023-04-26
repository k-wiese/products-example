<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PriceService;
use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
