<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

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
        
        if($request->query('qty') != null)
        {
            $qty = intval($request->query('qty'));
        }
        else
        {
            $qty = 15;
        }

        
        $products = $this->productService->getAllWithPricesAndPagination($qty);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
