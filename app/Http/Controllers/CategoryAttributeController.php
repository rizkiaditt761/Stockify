<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Http\Request;

class CategoryAttributeController extends Controller
{
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

    // Hapus atribut lama
    $category->categoryAttributes()->delete();

    // Simpan atribut baru
    foreach ($request->input('attributes', []) as $attribute) {

        if (!empty(trim($attribute))) {

            CategoryAttribute::create([
                'category_id' => $category->id,
                'name' => $attribute,
            ]);
        }
    }

    return redirect()
        ->route('categories.index')
        ->with('success', 'Category attributes berhasil disimpan.');
}
}