<?php

namespace App\Repositories\Category;

use LaravelEasyRepository\Repository;

interface CategoryRepository extends Repository
{
    public function deactivate($id);

    public function activate($id);

    public function hasProducts($id);
}