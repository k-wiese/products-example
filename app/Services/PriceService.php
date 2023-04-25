<?php

namespace App\Services;
use App\Models\Price;


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

    public function update($id, $value)
    {
 
        $price = Price::findOrFail($id);

        $price->update([
            'price' => $value
        ]);
        $price->save();
    }

    public function delete($id):void
    {
        Price::destroy($id);
    }

    public function getById($id):Price
    {
       return Price::findOrFail($id);
    }

    public function getByProductId($id)
    {
        $productService = new ProductService;
        return $productService->getById($id)->prices;
    }

}
