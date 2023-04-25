<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PriceService;

class PriceController extends Controller
{
    private $priceService;

    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'product_id' => 'required',
            'price' => 'required|integer|max:2147483645'
        ]);

        $requestData = $request->all();
        $this->priceService->create($requestData['product_id'], $requestData['price']);

        return redirect()->route('product.edit', $requestData['product_id'])->with('message-prices','Price added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'price' => 'required|integer|max:2147483645'
        ]);

        $this->priceService->update($id,$request->price);

        $product_id = $this->priceService->getById($id)->product->id;

        return redirect()->route('product.edit', $product_id)->with('message-prices','Price updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_id = $this->priceService->getById($id)->product->id;
        $this->priceService->delete($id);
        return redirect()->route('product.edit', $product_id)->with('message-prices','Price deleted successfully');
    }
}
