<?php

namespace App\Services\Category;

use LaravelEasyRepository\BaseService;

interface CategoryService extends BaseService
{
    public function deactivate($id);

    public function activate($id);

    public function hasProducts($id);
}