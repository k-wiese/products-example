<?php

namespace App\Http\Controllers;

use App\Services\PriceService;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    private $priceService;

    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'price' => 'required|integer|max:2147483645',
        ]);

        $requestData = $request->all();
        $this->priceService->create($requestData['product_id'], $requestData['price']);

        return redirect()->route('product.edit', $requestData['product_id'])->with('message-prices', 'Price added successfully');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'price' => 'required|integer|max:2147483645',
        ]);

        $this->priceService->update($id, $request->price);

        $product_id = $this->priceService->getById($id)->product->id;

        return redirect()->route('product.edit', $product_id)->with('message-prices', 'Price updated successfully');

    }

    public function destroy(string $id)
    {
        $product_id = $this->priceService->getById($id)->product->id;
        $this->priceService->delete($id);

        return redirect()->route('product.edit', $product_id)->with('message-prices', 'Price deleted successfully');
    }
}
