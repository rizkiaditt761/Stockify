<?php

namespace App\Repositories\Category;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Category;

class CategoryRepositoryImplement extends Eloquent implements CategoryRepository
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Cek apakah kategori masih memiliki produk.
     */
    public function hasProducts($id)
    {
        $category = $this->model->findOrFail($id);

        return $category->products()->count() > 0;
    }

    /**
     * Nonaktifkan kategori.
     */
    public function deactivate($id)
    {
        $category = $this->model->findOrFail($id);

        $category->update([
            'is_active' => false,
        ]);

        return $category;
    }

    /**
     * Aktifkan kembali kategori.
     */
    public function activate($id)
    {
        $category = $this->model->findOrFail($id);

        $category->update([
            'is_active' => true,
        ]);

        return $category;
    }
}