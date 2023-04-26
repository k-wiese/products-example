<?php

namespace Tests\Unit\ProductService;

use App\Models\Product;
use App\Services\PriceService;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAllProductWithPricesAndSortingTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllProductWithPricesAndSorting()
    {
        $productService = new ProductService();
        $priceService = new PriceService();

        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();
        $product3 = Product::factory()->create();
        $product4 = Product::factory()->create();

        $product1->name = 'D';
        $product1->save();
        $priceService->create($product1->id, 200);

        $product2->name = 'C';
        $product2->save();

        $product3->name = 'B';
        $product3->save();
        $priceService->create($product3->id, 200);

        $product4->name = 'A';
        $product4->save();

        $products = $productService->getAllWithPricesAndSorting('id', false, 'desc', 4);
        //first should be product4 since it has highest ID and no price
        if ($products->first()->id === $product4->id) {
            $result = true;
        } else {
            $result = false;
        }
        $this->assertTrue($result);

        $products = $productService->getAllWithPricesAndSorting('name', true, 'asc', 4);
        //first should be product3 since it starts with B and has price
        if ($products->first()->id === $product3->id) {
            $result = true;
        } else {
            $result = false;
        }
        $this->assertTrue($result);

        $products = $productService->getAllWithPricesAndSorting('id', true, 'asc', 4);
        //first should be product1 since it has lowest id and has price
        if ($products->first()->id === $product1->id) {
            $result = true;
        } else {
            $result = false;
        }
        $this->assertTrue($result);

    }
}
