<?php

namespace App\Services;
use App\Models\Price;
use Illuminate\Database\Eloquent\Collection;

class PriceService
{
    public function create($product_id, $price):Price
    {
        $price = new Price([
            'product_id'=> $product_id,
            'price'=> $price
        ]);

        $price->save();
        return $price;
    }

    public function update($id, $value):Price
    {
        $price = Price::findOrFail($id);

        $price->price = $value;
        $price->save();

        return $price;
    }

    public function delete($id):void
    {
        Price::findOrFail($id);
        Price::destroy($id);
    }

    public function getById($id):Price
    {
       return Price::findOrFail($id);
    }

    public function getAll():Collection
    {
       return Price::get();
    }

    public function getByProductId($id):Collection
    {
        $productService = new ProductService;
        return $productService->getById($id)->prices;
    }

}
