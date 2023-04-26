<?php

namespace App\Services;

use App\Models\Product;
use App\Services\PriceService;
use Illuminate\Database\Eloquent\Collection;

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

    public function getAll():Collection
    {
        return Product::get();
    }

    public function getAllWithPrices():Collection
    {
        $products = Product::get();
        foreach($products as $product)
        {
            $product->push($product->prices);
        }
        return $products;
    }

    public function getAllWithPricesAndSorting($sortBy = 'id', $hasPrice = false, $ascOrDesc = 'asc', $qty = 15)
    {
        $products = Product::query();


        if ($hasPrice) 
        {
            $products = $products->has('prices');
        } 

        switch($sortBy)
        {
            case 'name':

                if($ascOrDesc === 'asc')
                {
                    $products = $products->orderBy('name');
                }
                else
                {
                    $products = $products->orderByDesc('name');
                }

                break;

            case 'id':

                if($ascOrDesc === 'asc')
                {
                    $products = $products->orderBy('id');
                }
                else
                {
                    $products = $products->orderByDesc('id');
                }

                break;
        }

        $products = $products->paginate($qty)->appends(request()->query());

        foreach($products as $product)
        {
            $product->push($product->prices);
        }

        return $products;
    }

    public function getById($id):Product
    {
        return Product::findOrFail($id);
    }

    public function getByIdWithPrices($id):Product
    {
        $product = Product::findOrFail($id);

        $product->push($product->prices);

        return $product;
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
        Product::findOrFail($id);

        Product::destroy($id);
    }

    public function update($id, $name = null, $description = null):Product
    {
        $product = Product::findOrFail($id);

        $dataToUpdate = [];

        $dataToUpdate['name'] = !is_null($name)? $name : $product->name;

        $dataToUpdate['description'] = !is_null($description)? $description : $product->description;

        $product->update($dataToUpdate);

        $product->save();

        return $product;
    }
}
