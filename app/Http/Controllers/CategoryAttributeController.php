<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Services\Activity\ActivityService;
use Illuminate\Http\Request;

class CategoryAttributeController extends Controller
{
    protected ActivityService $activityService;

    public function __construct(
        ActivityService $activityService
    ) {
        $this->activityService = $activityService;
    }

    public function index(Category $category)
    {
        $attributes = $category->categoryAttributes;

        return view(
            'pages.category_attribute.index',
            compact(
                'category',
                'attributes'
            )
        );
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'attributes' => 'required|array',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Simpan atribut lama untuk log
        |--------------------------------------------------------------------------
        */

        $oldAttributes = $category
            ->categoryAttributes
            ->pluck('name')
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Hapus atribut lama
        |--------------------------------------------------------------------------
        */

        $category->categoryAttributes()->delete();

        /*
        |--------------------------------------------------------------------------
        | Simpan atribut baru
        |--------------------------------------------------------------------------
        */

        $newAttributes = [];

        foreach ($request->input('attributes', []) as $attribute) {

            if (!empty(trim($attribute))) {

                CategoryAttribute::create([

                    'category_id' => $category->id,

                    'name' => $attribute,

                ]);

                $newAttributes[] = $attribute;

            }

        }

        /*
        |--------------------------------------------------------------------------
        | Activity Log
        |--------------------------------------------------------------------------
        */

        $this->activityService->log(

            'Category Attribute',

            'UPDATE',

            'Mengubah atribut kategori "' .
            $category->name .
            '" dari [' .
            implode(', ', $oldAttributes) .
            '] menjadi [' .
            implode(', ', $newAttributes) .
            ']',

            $category

        );

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Category attributes berhasil disimpan.'
            );
    }
}