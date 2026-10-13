<?php
namespace App\Repositories;
use App\Models\Category;

class CategoryRepository
{
    public function getAll() {
        return Category::all();
    }

    public function findById($id) {
        return Category::find($id);
    }

    public function store($data) {
        return Category::create($data);
    }

    public function update($id, $data) {
        $category = Category::find($id);
        if($category) {
            $category->update($data);
        }
        return $category;
    }

    public function delete($id) {
        $category = Category::find($id);
        if($category) {
            $category->delete();
        }
        return $category;
    }
}