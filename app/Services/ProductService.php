<?php

namespace App\Services;

use App\Models\Product;
use App\Services\PriceService;


class ProductService
{

    public function create($name, $description):Product
    {
        $product = new Product([
            'name'=> $name,
            'description'=> $description
        ]);

        $product->save();

        return $product;
    }

    public function getAll()
    {
        return Product::get();
    }

    public function getById($id):Product
    {
        return Product::findOrFail($id);
    }

    public function deleteWithPrices($id):void
    {
        $product = Product::findOrFail($id);

        if($product->prices->count() > 0)
        {
            $priceService = new PriceService;

            foreach($product->prices as $price)
            {
                $priceService->delete($price->id);
            }
        }
        Product::destroy($id);
    }

    public function delete($id):void
    {
        Product::destroy($id);
    }

}
