<?php

namespace App\Http\Controllers;

use App\Services\PriceService;
use Illuminate\Http\Request;

class PriceApiController extends Controller
{
    private $priceService;

    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }

    public function index()
    {
        $prices = $this->priceService->getAll();

        return response(json_encode($prices), 200)
            ->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        $this->priceService->create($request->product_id, $request->price);

        return response('Successfully created price', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function show(string $id)
    {
        $price = $this->priceService->getById($id);

        return response(json_encode($price), 200)
            ->header('Content-Type', 'application/json');
    }

    public function update(Request $request, string $id)
    {
        $this->priceService->update($id, $request->price);

        return response('Successfully updated product', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function destroy(string $id)
    {
        $this->priceService->delete($id);

        return response('Successfully deleted price', 200)
            ->header('Content-Type', 'text/plain');

    }
}
