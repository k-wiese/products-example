<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

use function PHPSTORM_META\map;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'sortBy'=>'in:name,id',
            'hasPrice'=>'in:true,false',
            'ascOrDesc'=>'in:asc,desc',
            'qty'=>'min:1|max:1000|integer'
        ]);

        if($request->query('sortBy') != null)
        {
            $sortBy = $request->query('sortBy');
        }
        else
        {
            $sortBy = 'id';
        }
    

        if($request->query('hasPrice') != null)
        {
            $hasPrice = $request->query('hasPrice');
        }
        else
        {
            $hasPrice = false;
        }

        if($request->query('ascOrDesc') != null)
        {
            $ascOrDesc = $request->query('ascOrDesc');
        }
        else
        {
            $ascOrDesc = 'asc';
        }

        if($request->query('qty') != null)
        {
            $qty = intval($request->query('qty'));
        }
        else
        {
            $qty = 15;
        }

        $products = $this->productService->getAllWithPricesAndSorting($sortBy, $hasPrice, $ascOrDesc, $qty);
        
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->getByIdWithPrices($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->getByIdWithPrices($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = $this->productService->getById($id);

        $request->validate([
            'name' => 'max:30',
            'description' => 'max:100',
        ]);

        $requestData = $request->all();

        $this->productService->update($product->id,$requestData['name'], $requestData['description']);

        return redirect()->route('product.edit', $product)->with('message-product','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->deleteWithPrices($id);
        return redirect()->route('product.index')->with('message','Product deleted successfully');
    }
}
