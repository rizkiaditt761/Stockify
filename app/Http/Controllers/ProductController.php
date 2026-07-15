<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\ProductRequest;
use App\Services\Product\ProductService;

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

        return view('pages.product.create', compact('categories', 'suppliers'));
    }


    public function store(ProductRequest $request)
    {
        $this->productService->create($request->validated());

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
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('pages.product.edit', compact(
            'product',
            'categories',
            'suppliers'
        ));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->update(
            $product->id,
            $request->validated()
        );

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