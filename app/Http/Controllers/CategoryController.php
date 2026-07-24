<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\Category\CategoryService;
use App\Services\Activity\ActivityService;
use App\Models\Category;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    protected ActivityService $activityService;


    public function __construct(
        CategoryService $categoryService,
        ActivityService $activityService
    ) {
        $this->categoryService = $categoryService;

        $this->activityService = $activityService;
    }


    public function index()
    {
        $categories = $this->categoryService->all();

        return view(
            'pages.category.index',
            compact('categories')
        );
    }


    public function create()
    {
        return view('pages.category.create');
    }



    public function edit(Category $category)
    {
        return view(
            'pages.category.edit',
            compact('category')
        );
    }



    public function update(
        CategoryRequest $request,
        Category $category
    ) {

        $this->categoryService->update(
            $category->id,
            $request->validated()
        );


        $this->activityService->log(

            'Category',

            'UPDATE',

            'Mengubah kategori ' . $category->name,

            $category

        );


        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Category updated successfully.'
            );
    }





    public function destroy(Category $category)
    {

        $this->activityService->log(

            'Category',

            'DELETE',

            'Menghapus kategori ' . $category->name,

            $category

        );


        $this->categoryService->delete(
            $category->id
        );


        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Category deleted successfully.'
            );
    }





    public function store(CategoryRequest $request)
    {

       $this->categoryService->create(
            $request->validated()
        );

        $category = Category::latest('id')->first();


        $this->activityService->log(

            'Category',

            'CREATE',

            'Membuat kategori ' . $category->name,

            $category

        );


        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Category successfully created.'
            );
    }
}