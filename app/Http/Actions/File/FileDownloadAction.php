<?php

namespace App\Http\Actions\File;

use App\Models\File;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Storage;

class FileDownloadAction
{
    use ApiResponses;
    /**
     * @param mixed $file
     * 
     * @return object
     */
    public function execute(File $file)
    {

        $storage = Storage::disk('pet_shop');
        $exist = $storage->exists($file->path);

        abort_if(!$exist, $this->badRequestAlert('This file has been deleted or moved'));

        return $storage;
    }
}