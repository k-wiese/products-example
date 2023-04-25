<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\ProductService;

class Products extends Component
{
    public function render()
    {
        $productService = new ProductService;
        $products = $productService->getAll();

        return view('livewire.products', compact('products'));
    }
}
