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
    echo "1<br>";

    $request->validate([
        'attributes' => 'required|array',
    ]);

    echo "2<br>";

    $category->categoryAttributes()->delete();

    echo "3<br>";

    foreach ($request->input('attributes', []) as $attribute) {

        echo "attribute = ".$attribute."<br>";

        if (!empty($attribute)) {

            CategoryAttribute::create([
                'category_id' => $category->id,
                'name' => $attribute,
            ]);

            echo "insert berhasil<br>";
        }
    }

    echo "4<br>";

    die();
}
}