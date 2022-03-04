<?php

namespace App\Http\Actions\Product;

use App\Models\Product;
use App\Traits\ApiResponses;
use App\Http\Requests\UpdateProductRequest;

class UpdateProductAction
{
    use ApiResponses;

    public function execute(
        UpdateProductRequest $request,
        Product $product
    ): bool {
        return $product->update([
            'category_uuid' => $request->category_uuid,
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'metadata' => $request->metadata,
        ]);
    }
}
