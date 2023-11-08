<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\BookService;

class CategoryController extends Controller
{



    public function index(CategoryService $categoryService)
    {


        $categoryService->getAllCategories();
        $categoryService->getBooksByCategories();
        return response()->json($categoryService->categories, 200);
    }

}
