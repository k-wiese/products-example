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

    public function getAllWithPrices()
    {
        $products = Product::get();
        foreach($products as $product)
        {
            $product->push($product->prices);
        }
        return $products;
    }

    public function getAllWithPricesAndSorting($sortBy = 'id', $hasPrice, $ascOrDesc = 'asc', $qty = 15)
    {
        $products = Product::query();


        if ($hasPrice) 
        {
            $products = $products->has('prices');
        } 
        else 
        {
            $products = $products->doesntHave('prices');
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

    public function update($id, $name = null, $description = null)
    {
        $product = Product::findOrFail($id);

        $dataToUpdate = [];

        if (!is_null($name)) 
        {
            $dataToUpdate['name'] = $name;
        }
        else 
        {
            $dataToUpdate['name'] = $product->name;
        }

        if (!is_null($description)) 
        {
            $dataToUpdate['description'] = $description;
        } else 
        {
            $dataToUpdate['description'] = $product->description;
        }

        $product->update($dataToUpdate);

        $product->save();
    }
}
