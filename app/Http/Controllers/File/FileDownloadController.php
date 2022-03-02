<?php

namespace App\Http\Controllers\File;

use App\Models\File;
use App\Traits\ApiResponses;
use App\Http\Controllers\Controller;
use App\Http\Actions\File\FileDownloadAction;

class FileDownloadController extends Controller
{
    use ApiResponses;
     /**
     * @OA\Get(
     * path="/api/v1/file/{uuid}",
     * operationId="downloadFile",
     * tags={"File"},
     * summary="Read a file",
     * description="Read a file",
     *      @OA\Parameter(
     *           name="uuid",
     *           in="path",
     *           @OA\Schema(
     *           type="string"
     *       )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="File downloaded successfully.",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function download(FileDownloadAction $fileDownloadAction, File $uuid)
    {
        $file =  $fileDownloadAction->execute($uuid);

        return $file->download($uuid->path, $uuid->name);
    }
}
