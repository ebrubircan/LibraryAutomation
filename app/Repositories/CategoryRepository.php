<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;


class CategoryRepository
{
    public function getAllCategories()
    {
        return DB::table('categories')->get();
    }
}
