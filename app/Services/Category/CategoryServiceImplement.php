<?php

namespace App\Services\Category;

use LaravelEasyRepository\Service;
use App\Repositories\Category\CategoryRepository;

class CategoryServiceImplement extends Service implements CategoryService
{
    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(CategoryRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * Cek apakah kategori masih memiliki produk.
     */
    public function hasProducts($id)
    {
        return $this->mainRepository->hasProducts($id);
    }

    /**
     * Nonaktifkan kategori.
     */
    public function deactivate($id)
    {
        if ($this->hasProducts($id)) {

            return [
                'success' => false,
                'message' => 'Kategori masih digunakan oleh produk sehingga tidak dapat dinonaktifkan.',
            ];

        }

        $this->mainRepository->deactivate($id);

        return [
            'success' => true,
            'message' => 'Kategori berhasil dinonaktifkan.',
        ];
    }

    /**
     * Aktifkan kembali kategori.
     */
    public function activate($id)
    {
        $this->mainRepository->activate($id);

        return [
            'success' => true,
            'message' => 'Kategori berhasil diaktifkan.',
        ];
    }
}