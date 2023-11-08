<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    protected $bookRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }

    public function getAllBooksWithDetails()
    {
        return $this->bookRepository->getAllBooksWithDetails();
    }

    public function getBooksByCategoryArray($categories)
    {
        $temp = [];
        foreach ($categories as $category) {
            $temp[] = $this->bookRepository->getBooksByCategoryID($category->ID);
        }
        return $temp;
    }

    public function getBooksByCategoryID($categoryID)
    {
        return $this->bookRepository->getBooksByCategoryID($categoryID);
    }

    public function getBooksByCategoryName($categoryName)
    {
        return $this->bookRepository->getBooksByCategoryName($categoryName);
    }
}
