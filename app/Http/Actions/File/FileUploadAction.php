<?php

namespace App\Http\Actions\File;

use App\Models\File;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Requests\FileUploadRequest;

class FileUploadAction
{
    use ApiResponses;

    public function execute(FileUploadRequest $request)
    {
        return $this->uploadFile($request);
    }


    private function uploadFile($payload)
    {
        $file = $payload->file('file');
        $store = $file->store('uploads/pet-shop', 'pet_shop');

        $imageSize = $file->getSize();
        $size = number_format($imageSize / 1000, 2) . ' KB';

        $upload = File::create([
            'uuid' => Str::uuid(),
            'name' => $file->getClientOriginalName(),
            'path' => $store,
            'size' => $size,
            'type' => $file->getClientOriginalExtension()
        ]);

        abort_if(!$upload, $this->badRequestAlert('Unable to upload image. Try again'));

        return $upload;
    }
}
