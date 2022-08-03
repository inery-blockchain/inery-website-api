<?php

namespace App\Services;
use App\Models\Category;

class CategoryService
{
    
    public static function getAllCategories()
    {   
        return Category::all();
    }

    public static function getSingle($id)
    {
        $category = Category::findOrFail($id);

        if (!empty($category)) {

            return $category;

        } else {

            return 'error';
        }
    }


}