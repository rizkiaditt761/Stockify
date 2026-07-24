<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\ProductRequest;
use App\Services\Product\ProductService;
use App\Services\Activity\ActivityService;
use App\Models\ProductAttribute;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected ProductService $productService;

    protected ActivityService $activityService;


    public function __construct(
        ProductService $productService,
        ActivityService $activityService
    ) {
        $this->productService = $productService;

        $this->activityService = $activityService;
    }


    public function index(Request $request)
    {
        $query = Product::with([
            'category',
            'supplier'
        ]);


        $status = $request->get('status', 'all');


        if ($status == 'active') {

            $query->where('is_active', true);

        } elseif ($status == 'inactive') {

            $query->where('is_active', false);

        }


        if ($request->filled('search')) {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );

        }


        if ($request->filled('category')) {

            $query->where(
                'category_id',
                $request->category
            );

        }


        $products = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();


        $categories = Category::orderBy('name')->get();


        $activeCategory = null;


        if ($request->filled('category')) {

            $activeCategory = Category::find(
                $request->category
            );

        }


        $totalProduct = $products->total();


        return view(
            'pages.product.index',
            compact(
                'products',
                'categories',
                'activeCategory',
                'totalProduct'
            )
        );
    }



    public function create()
    {
        $categories = Category::all();

        $suppliers = Supplier::all();


        return view(
            'pages.product.create',
            compact(
                'categories',
                'suppliers'
            )
        );
    }




public function store(ProductRequest $request)
{

    $data = $request->validated();



    /*
    |--------------------------------------------------------------------------
    | Upload Product Image
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('image')) {


        $data['image'] =
            $request->file('image')
            ->store('products', 'public');


    }



    $product = Product::create($data);


        if ($request->has('attributes')) {


            $category = Category::with('categoryAttributes')
                ->findOrFail($request->category_id);


            $attributes = $request->input(
                'attributes',
                []
            );


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



        // ACTIVITY LOG CREATE PRODUCT

        $this->activityService->log(

            'Product',

            'CREATE',

            'Membuat produk ' . $product->name,

            $product

        );



        return redirect()

            ->route('products.index')

            ->with(
                'success',
                'Product successfully created.'
            );

    }





    public function show(Product $product)
    {
        $product->load([
            'category',
            'supplier',
            'attributes'
        ]);


        return view(
            'pages.product.show',
            compact('product')
        );
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





   public function update(
    ProductRequest $request,
    Product $product
)
{

    $data = $request->validated();



    /*
    |--------------------------------------------------------------------------
    | Update Product Image
    |--------------------------------------------------------------------------
    */


    if ($request->hasFile('image')) {


        // Hapus gambar lama

        if ($product->image && \Storage::disk('public')->exists($product->image)) {


            \Storage::disk('public')
                ->delete($product->image);

        }



        // Upload gambar baru

        $data['image'] = $request
            ->file('image')
            ->store(
                'products',
                'public'
            );

    }





    /*
    |--------------------------------------------------------------------------
    | Update Product
    |--------------------------------------------------------------------------
    */


    $product->update($data);





    /*
    |--------------------------------------------------------------------------
    | Update Attributes
    |--------------------------------------------------------------------------
    */


    $product->attributes()->delete();



    $attributes = $request->input(
        'attributes',
        []
    );



    $category = Category::with('categoryAttributes')
        ->findOrFail(
            $request->category_id
        );




    foreach ($category->categoryAttributes as $attribute) {


        if (!empty($attributes[$attribute->id])) {


            ProductAttribute::create([

                'product_id' => $product->id,

                'name'       => $attribute->name,

                'value'      => $attributes[$attribute->id],

            ]);

        }

    }





    /*
    |--------------------------------------------------------------------------
    | Activity Log
    |--------------------------------------------------------------------------
    */


    $this->activityService->log(

        'Product',

        'UPDATE',

        'Mengubah data produk '.$product->name,

        $product

    );





    return redirect()

        ->route('products.index')

        ->with(
            'success',
            'Product updated successfully.'
        );

}




    public function activate(Product $product)
    {

        $this->productService
            ->activate($product->id);



        $this->activityService->log(

            'Product',

            'ACTIVATE',

            'Mengaktifkan produk ' . $product->name,

            $product

        );



        return redirect()

            ->route('products.index')

            ->with(
                'success',
                'Product activated successfully.'
            );

    }





    public function deactivate(Product $product)
    {

        $this->productService
            ->deactivate($product->id);



        $this->activityService->log(

            'Product',

            'DEACTIVATE',

            'Menonaktifkan produk ' . $product->name,

            $product

        );



        return redirect()

            ->route('products.index')

            ->with(
                'success',
                'Product deactivated successfully.'
            );

    }





public function destroy(Product $product)
{


    if ($product->image) {


        Storage::disk('public')
            ->delete($product->image);


    }



    $this->productService
        ->delete($product->id);



        $this->activityService->log(

            'Product',

            'DELETE',

            'Menghapus produk ' . $product->name,

            $product

        );



        return redirect()

            ->route('products.index')

            ->with(
                'success',
                'Product deleted successfully.'
            );

    }
}