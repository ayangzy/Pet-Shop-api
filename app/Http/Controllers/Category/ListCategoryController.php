<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\Traits\ApiResponses;
use App\Http\Actions\ListActions;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class ListCategoryController extends Controller
{
    use ApiResponses;
     /**
     * @OA\Get(
     * path="/api/v1/categories",
     * operationId="allCategories",
     * tags={"Categories"},
     * summary="List all Categories",
     * description="List all Categories",
     *      @OA\Parameter(
     *           name="page",
     *           in="query",
     *           @OA\Schema(
     *           type="integer"
     *       )
     *       ),
     *      @OA\Parameter(
     *           name="limit",
     *           in="query",
     *           @OA\Schema(
     *           type="integer"
     *       )
     *       ),
     *      @OA\Parameter(
     *           name="sortBy",
     *           in="query",
     *           @OA\Schema(
     *           type="string"
     *       )
     *       ),
     *      @OA\Parameter(
     *           name="desc",
     *           in="query",
     *           @OA\Schema(
     *           type="boolean"
     *       )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Categories listed successfully",
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
    public function show()
    {
        $categories = (new ListActions(Category::class, 'categories'))->sortWithoutAuth();

        return $this->successResponse('Categories retrieved successfully.', [
            'categories' => CategoryResource::collection($categories),
            'first_page_url' => $categories->url(1),
            'from' => $categories->firstItem(),
            'per_page' => $categories->perPage(),
            'prev_page_url' => $categories->previousPageUrl(),
            'next_page_url' => $categories->nextPageUrl(),
            'last_page' => $categories->lastPage(),
            'to' => $categories->lastItem(),
            'total' => $categories->total(),
        ]);
    }
}
