<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\ProductRequest;
use App\Services\Product\ProductService;
use App\Models\ProductAttribute;
use App\Models\StockTransaction;

class ProductController extends Controller
{
    protected ProductService $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index()
    {
        $products = Product::with(['category', 'supplier'])->get();

        return view('pages.product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('pages.product.create', compact(
            'categories', 
            'suppliers'
        ));
    }


 public function store(ProductRequest $request)
{
    // Simpan produk
    $product = Product::create($request->validated());

    // Simpan atribut produk
    if ($request->has('attributes')) {

        $category = Category::with('categoryAttributes')
            ->findOrFail($request->category_id);

        $attributes = $request->input('attributes', []);

        foreach ($category->categoryAttributes as $attribute) {

            if (!empty($attributes[$attribute->id])) {

                ProductAttribute::create([
                    'product_id' => $product->id,
                    'name'       => $attribute->name,
                    'value'      => $attributes[$attribute->id],
                ]);

            }

        }

    }

    // Otomatis buat transaksi Initial Stock
    if ($product->stock > 0) {

        StockTransaction::create([
            'product_id'       => $product->id,
            'user_id'          => auth()->id(),
            'type'             => 'IN',
            'quantity'         => $product->stock,
            'stock_before'     => 0,
            'stock_after'      => $product->stock,
            'transaction_date' => now(),
            'status'           => 'Completed',
            'notes'            => 'Initial Stock',
        ]);

    }

    return redirect()
        ->route('products.index')
        ->with('success', 'Product successfully created.');
}
    public function show(Product $product)
    {
        $product->load([
            'category',
            'supplier',
            'attributes'
        ]);

        return view('pages.product.show', compact('product'));
    }


    public function edit(Product $product)
{
    $product->load('attributes');

    $categories = Category::all();
    $suppliers = Supplier::all();

    return view(
        'pages.product.edit',
        compact(
            'product',
            'categories',
            'suppliers'
        )
    );
}


   public function update(ProductRequest $request, Product $product)
{
    $product->update($request->validated());

    $product->attributes()->delete();

    $attributes = $request->input('attributes', []);

    $category = Category::with('categoryAttributes')
        ->findOrFail($request->category_id);

    foreach ($category->categoryAttributes as $attribute) {

        if (!empty($attributes[$attribute->id])) {

            ProductAttribute::create([
                'product_id' => $product->id,
                'name'       => $attribute->name,
                'value'      => $attributes[$attribute->id],
            ]);

        }

    }

    return redirect()
        ->route('products.index')
        ->with('success', 'Product updated successfully.');
}

    public function destroy(Product $product)
    {
        $this->productService->delete($product->id);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}