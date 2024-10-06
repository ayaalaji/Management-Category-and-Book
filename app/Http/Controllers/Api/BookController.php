<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Services\BookService;

class BookController extends Controller
{
    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->middleware('auth:api',['except'=> ['index','show']]);
        $this->middleware('admin',['except'=> ['index','show']]);
        $this->bookService = $bookService;
    }
    /**
     * Display a listing of Book with Category which belongs to it.
     * @return /Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $book=Book::with(['category:id,name'])->where('is_active',true)->get();
        return $this->success($book,'You Get All Book Successfully');
    }

    /**
     * Store a newly created book.
     * only admin can added book
     * @param StoreRequest $request
     * @param Book $book
     * @return /Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request,Book $book)
    {
        $validatedData = $request->validated();
        $bookStore = $this->bookService->createBook($validatedData,$book);
        return $this->success($bookStore,'You Created Book Successfully',201);
    }

    /**
     * Display the specified Book.
     * @param Book $book
     * @return /Illuminate\Http\JsonResponse
     */
    public function show(Book $book)
    {
        $book->load(['category:id,name']);
        return $this->success($book,'Book retrieved successfully');
    }

    /**
     * Update the specified Book.
     * only admin can update specifice Book
     * @param UpdateRequest $request
     * @param Book $book
     * @return /Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Book $book)
    {
        $validatedData =$request->validated();
        $book = $this->bookService->updateBook($validatedData,$book);
        return $this->success($book,'You Updated Book Successfully');
    }

    /**
     * Remove the specified Book.
     * only admin can remove book
     * @param Book $book
     * @return /Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return $this->success(null,'You Removed Book Successfully');
    }
}
