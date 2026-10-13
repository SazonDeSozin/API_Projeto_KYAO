<?php
namespace App\Http\Controllers;
use App\Services\CategoryService;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function get() {
        $categories = $this->categoryService->getAll();
        return CategoryResource::collection($categories);
    }

    public function store(CategoryStoreRequest $request) {
        $data = $request->validated();
        $category = $this->categoryService->store($data);
        return (new CategoryResource($category))->response()->setStatusCode(201);
    }

    public function details($id) {
        $category = $this->categoryService->findById($id);
        if (!$category) return response()->json(['message' => 'Category not found'], 404);
        return new CategoryResource($category);
    }

    public function update(CategoryStoreRequest $request, $id) {
        $data = $request->validated();
        $category = $this->categoryService->update($id, $data);
        if (!$category) return response()->json(['message' => 'Category not found'], 404);
        return new CategoryResource($category);
    }

    public function destroy($id) {
        $category = $this->categoryService->delete($id);
        if (!$category) return response()->json(['message' => 'Category not found'], 404);
        return response()->json(['message' => 'Category deleted'], 202);
    }
}