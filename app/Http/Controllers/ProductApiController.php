<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Http\Response;
use App\Services\PriceService;

class ProductApiController extends Controller
{
    private $productService;
    private $priceService;

    public function __construct(ProductService $productService, PriceService $priceService)
    {
        $this->productService = $productService;
        $this->priceService = $priceService;
    }

    public function index():Response
    {
        $products = $this->productService->getAllWithPrices();

        return response(json_encode($products), 200)
            ->header('Content-Type', 'application/json');
    }

    public function create(Request $request):Response
    {
        $request->validate([
            'name' => 'required|max:30',
            'description' => 'required|max:100',
        ]);
        $bodyContent = json_decode($request->getContent());

        $product = $this->productService->create($bodyContent->name, $bodyContent->description);

        if(isset($bodyContent->prices))
        {
            foreach($bodyContent->prices as $price)
            {
                $this->priceService->create($product->id, $price);
            }

            return response('Product added succesfully to the database with its prices', 200)
                ->header('Content-Type', 'text/plain');
        }

        return response('Product added succesfully to the database without prices', 200)
        ->header('Content-Type', 'text/plain');
    }

    public function update(Request $request, $id):Response
    {
        $request->validate([
            'name' => 'max:30',
            'description' => 'max:100',
        ]);
        $bodyContent = json_decode($request->getContent());

        if(isset($bodyContent->name))
        {
            $name = $bodyContent->name;
        }
        else
        {
            $name = null;
        }
        if(isset($bodyContent->description))
        {
            $description = $bodyContent->description;

        }
        else
        {
            $description = null;
        }

        $this->productService->update($id,$name, $description);

        return response('Product sucessfully updated', 200)
        ->header('Content-Type', 'text/plain');
    }

    public function show(string $id):Response
    {
        if (!is_numeric($id)) 
        {
            return response('Error - Invalid ID', 400)
                ->header('Content-Type', 'text/plain');
        }

        $product = $this->productService->getByIdWithPrices($id);

        return response(json_encode($product), 200)
            ->header('Content-Type', 'application/json');

    }

    public function delete(string $id):Response
    {
        
        $this->productService->delete($id);

        return response('Successully deleted product', 200)
            ->header('Content-Type', 'text/plain');
    }
    public function deleteWithPrices(string $id):Response
    {
        $this->productService->deleteWithPrices($id);

        return response('Successully deleted product with its prices', 200)
            ->header('Content-Type', 'text/plain');
    }



}
