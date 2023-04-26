<?php

namespace App\Http\Livewire;

use App\Services\PriceService;
use App\Services\ProductService;
use Livewire\Component;

class ProductCreateForm extends Component
{
    public $priceInputs = [];

    public $name;

    public $description;

    public $message;

    protected $rules = [
        'name' => 'max:30|required',
        'description' => 'max:100|required',
        'priceInputs.*' => 'numeric|min:1|required|max:2147483645',
    ];

    public function render()
    {
        return view('livewire.product-create-form');
    }

    public function create()
    {

        $this->validate();

        $productService = new ProductService;
        $priceService = new PriceService;

        $product = $productService->create($this->name, $this->description);
        if (count($this->priceInputs) > 0) {
            foreach ($this->priceInputs as $price) {
                $priceService->create($product->id, $price);
            }
        }

        $this->message = 'Successfully created product';

    }

    public function addPriceInput()
    {
        $this->priceInputs[] = '';
    }

    public function removePriceInput()
    {
        if (count($this->priceInputs) > 0) {
            array_pop($this->priceInputs);
        }
    }
}
