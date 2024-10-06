<?php

namespace App\Services;

use App\Models\Category;

class CategoryService {

    /**
     * add new category by admin
     * @param array $data
     */
    public function addCategory(array $data)
    {
        return Category::create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }
    /**
     * update specifice Category just by admin
     * @param array $data
     * @param Category $category
     */
    public function updateCategory(array $data, Category $category)
    {
        $updateCategory = array_filter([
            'name' => $data['name'] ?? $category->name ,
            'description' => $data['description'] ?? $category->description
        ]);

        $category ->update($updateCategory);

        return $category;
    }
}