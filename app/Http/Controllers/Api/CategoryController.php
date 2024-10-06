<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth:api', ['except' => ['index']]);
        $this->middleware('admin', ['except' => ['index']]);
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of Category.
     * any one can get all category (i mean Admin and User)
     * with token and without it
     */
    public function index()
    {
        $categories = Category::query()
                    ->withWhereHas('books', function ($q) {
                    $q->where('is_active', true)
                    ->select('id', 'title', 'author', 'published_at', 'category_id'); 
                    })->get();
        return $this->success($categories,'This is All Category');
    }

    /**
     * Store a newly category.
     * only admin can add category
     * @param StoreRequest $request
     * @return /Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $category = $this->categoryService->addCategory($validatedData);
        return $this->success($category,'You Added Category Successfully',201);
    }


    /**
     * Update the specified Category.
     * only Admin can update specifice Category
     * @param UpdateRequest $request
     * @param Category $category
     * @return /Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $validatedData = $request->validated();
        $category =$this->categoryService->updateCategory($validatedData,$category);
        return $this->success($category,'You Update Category Successfully');
    }

    /**
     * Remove the specified Category.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success(null,'You Removed Successfully');
    }
}
