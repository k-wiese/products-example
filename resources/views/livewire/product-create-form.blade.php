<div>
    
        <div class="input-group mb-3">
          
          <span class="input-group-text" id="name">Name</span>
          <input type="text" class="form-control" placeholder="Example name" value="{{old('name')}}" aria-label="name" aria-describedby="name" name="name" wire:model="name">
         

        </div>
        <div class="my-3">

            @error('name') <span class="error alert alert-danger my-3">{{ $message }}</span> @enderror
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="description">Description</span>
          <input type="text" class="form-control" placeholder="Example description of example product" value="{{old('description')}}" aria-label="description" aria-describedby="description" name="description" wire:model="description">
        </div>
        <div class="my-3">

            @error('description') <span class="error alert alert-danger my-3">{{ $message }}</span> @enderror
        </div>

        <div class="my-2">

            <button wire:click="addPriceInput" class="btn btn-outline-success" type="button" wire:loading.attr="disabled">Add price (+)</button>
        </div>
        <div class="my-2">
            <button wire:click="removePriceInput" class="btn btn-outline-danger" type="button" wire:loading.attr="disabled">Remove price (-)</button>
        </div>


        @foreach ($priceInputs as $index => $input)


        <div class="input-group mb-3">
            <span class="input-group-text" >Price ({{$index+1}})</span>
            <input type="number" class="form-control" placeholder="1 EUR = 100" wire:model="priceInputs.{{ $index }}">
           

        </div>

        @endforeach  
        
        <div class="my-3">

            @error('priceInputs.*') <span class="error alert alert-danger my-3">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-outline-light d-block w-100" wire:click="create">Create</button>
      
</div>
