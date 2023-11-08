<?php

namespace App\Http\Controllers;

use App\Services\BookService;

class BookController
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAllBooksWithDetails();

        $booksGrouped = [];
        foreach ($books as $book) {
            $booksGrouped[$book->BookName]['categories'][] = $book->Category;
            $booksGrouped[$book->BookName]['author'] = $book->Author;
        }

        return view('index', ['booksGrouped' => $booksGrouped]);
    }

    public function getPersonalDevelopmentBooks()
    {
        $categoryName = 'Kişisel Gelişim';
        $books = $this->bookService->getBooksByCategoryName($categoryName);
        return response()->json($books);
    }

    public function getLoveBooks()
    {
        $categoryName = 'Aşk';
        $books = $this->bookService->getBooksByCategoryName($categoryName);
        return response()->json($books);
    }

    public function getHealthBooks()
    {
        $categoryName = 'Sağlık';
        $books = $this->bookService->getBooksByCategoryName($categoryName);
        return response()->json($books);
    }

    public function getMedicalBooks()
    {
        $categoryName = 'Tıp';
        $books = $this->bookService->getBooksByCategoryName($categoryName);
        return response()->json($books);
    }

}
