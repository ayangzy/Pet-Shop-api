<?php

namespace App\Http\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use App\Http\Requests\CreateProductRequest;

class CreateProductAction
{
    use ApiResponses;

    public function execute(CreateProductRequest $request)
    {
        $product = Product::create([
            'uuid' => Str::uuid(),
            'category_uuid' => $request->category_uuid,
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'metadata' => $request->metadata,
        ]);

        abort_if(!$product, $this->badRequestAlert('Unable to create product. please retry'));

        return $product;
    }
}