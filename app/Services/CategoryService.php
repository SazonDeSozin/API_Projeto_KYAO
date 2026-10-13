<?php
namespace App\Services;
use App\Repositories\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll() {
        return $this->categoryRepository->getAll();
    }

    public function findById($id) {
        return $this->categoryRepository->findById($id);
    }

    public function store($data) {
        return $this->categoryRepository->store($data);
    }

    public function update($id, $data) {
        return $this->categoryRepository->update($id, $data);
    }

    public function delete($id) {
        return $this->categoryRepository->delete($id);
    }
}