<?php

namespace App\Http\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class UpdateProductAction
{
    use ApiResponses;

    public function execute(UpdateProductRequest $request, $uuid)
    {
      $product = Product::where('uuid', $uuid)->first();
      
      if(!$product){
          abort($this->notFoundAlert('product not found'));
      }
        $productUpdate = $product->update([
            'category_uuid' => $request->category_uuid,
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'metadata' => $request->metadata,
        ]);
        
        abort_if(!$product, $this->badRequestAlert('Unable to update product. Try again'));

        return $productUpdate;
    }
}