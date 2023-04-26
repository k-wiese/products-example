<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'sortBy' => 'in:name,id',
            'hasPrice' => 'in:true,false',
            'ascOrDesc' => 'in:asc,desc',
            'qty' => 'min:1|max:1000|integer',
        ]);

        $products = $this->productService->getAllWithPricesAndSorting($request->sortBy, $request->hasPrice, $request->ascOrDesc, $request->qty);

        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function show(string $id)
    {
        $product = $this->productService->getByIdWithPrices($id);

        return view('product.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = $this->productService->getByIdWithPrices($id);

        return view('product.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = $this->productService->getById($id);

        $request->validate([
            'name' => 'max:30',
            'description' => 'max:100',
        ]);

        $this->productService->update($id, $request->name, $request->description);

        return redirect()->route('product.edit', $product)->with('message-product', 'Product updated successfully');
    }

    public function destroy(string $id)
    {
        $this->productService->deleteWithPrices($id);

        return redirect()->route('product.index')->with('message', 'Product deleted successfully');
    }
}
