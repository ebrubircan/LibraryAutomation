<?php

namespace App\Services;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;
    public $categories;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository=$categoryRepository;
    }

    public function getAllCategories()
    {
        $this->categories = $this->categoryRepository->getAllCategories();
    }

    public function getBooksByCategories()
    {
        $bookService = new BookService();
        $temp = [];
        foreach ($this->categories as $category) {
            $temp[] = [
                'category_id' => $category->ID,
                'category_name'=> $category->CategoryName,
                'books' => $bookService->getBooksByCategoryID($category->ID)
            ];
        }
        $this->setCategories($temp);
    }

    public function getCategoryRepository(): CategoryRepository
    {
        return $this->categoryRepository;
    }

    public function setCategoryRepository(CategoryRepository $categoryRepository): void
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

}
