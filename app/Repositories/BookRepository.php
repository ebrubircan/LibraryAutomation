<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BookRepository
{
    //tüm kitap bilgileri
    public function getAllBooksWithDetails()
    {
        return DB::table('books')
            ->join('books_categories', 'books.ID', '=', 'books_categories.BookID')
            ->join('categories', 'books_categories.CategoryID', '=', 'categories.ID')
            ->join('authors', 'books.AuthorID', '=', 'authors.ID')
            ->select('books.*', 'categories.CategoryName as Category', 'authors.AuthorName as Author')
            ->get();
    }

    public function getBooksByCategoryID($categoryID)
    {
     return DB::table('books')->where('CatID',$categoryID)->get();
    }

    //belirli kategoriye göre sırala
    public function getBooksByCategoryName($categoryName)
    {
        return DB::table('books')
            ->join('books_categories', 'books.ID', '=', 'books_categories.BookID')
            ->join('categories', 'books_categories.CategoryID', '=', 'categories.ID')
            ->join('authors', 'books.AuthorID', '=', 'authors.ID')
            ->select('books.*', 'categories.CategoryName as Category', 'authors.AuthorName as Author')
            ->where('categories.CategoryName', $categoryName)
            ->get();
    }
}
