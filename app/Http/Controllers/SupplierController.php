<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Services\Supplier\SupplierService;
use App\Services\Activity\ActivityService;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;

class SupplierController extends Controller
{
    protected SupplierService $supplierService;

    protected ActivityService $activityService;

    public function __construct(
        SupplierService $supplierService,
        ActivityService $activityService
    ) {
        $this->supplierService = $supplierService;
        $this->activityService = $activityService;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->search,
        ];

        $suppliers = $this->supplierService
            ->getSupplierData($filters);

        $totalSupplier = Supplier::count();

        $activeSupplier = Supplier::where(
            'is_active',
            true
        )->count();

        $inactiveSupplier = Supplier::where(
            'is_active',
            false
        )->count();

        return view(
            'pages.supplier.index',
            compact(
                'suppliers',
                'totalSupplier',
                'activeSupplier',
                'inactiveSupplier'
            )
        );
    }

    public function create()
    {
        return view('pages.supplier.create');
    }

    public function store(SupplierRequest $request)
    {
        $this->supplierService->create(
            $request->validated()
        );

        $supplier = Supplier::latest('id')->first();

        $this->activityService->log(

            'Supplier',

            'CREATE',

            'Menambahkan supplier ' . $supplier->name,

            $supplier

        );

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Supplier berhasil ditambahkan.'
            );
    }

    public function edit(Supplier $supplier)
    {
        return view(
            'pages.supplier.edit',
            compact('supplier')
        );
    }

    public function update(
        SupplierRequest $request,
        Supplier $supplier
    ) {
        $this->supplierService->update(
            $supplier->id,
            $request->validated()
        );

        $this->activityService->log(

            'Supplier',

            'UPDATE',

            'Mengubah supplier ' . $supplier->name,

            $supplier

        );

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Supplier berhasil diperbarui.'
            );
    }

    public function activate(Supplier $supplier)
    {
        $supplier->update([
            'is_active' => true
        ]);

        $this->activityService->log(

            'Supplier',

            'ACTIVATE',

            'Mengaktifkan supplier ' . $supplier->name,

            $supplier

        );

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Supplier berhasil diaktifkan.'
            );
    }

    public function deactivate(Supplier $supplier)
    {
        $totalProduct = Product::where(
            'supplier_id',
            $supplier->id
        )->count();

        if ($totalProduct > 0) {

return redirect()
    ->route('suppliers.index')
    ->with([
        'warning' => 'Supplier "' .
            $supplier->name .
            '" masih digunakan oleh ' .
            $totalProduct .
            ' produk. Silakan pindahkan supplier pada seluruh produk terlebih dahulu sebelum menonaktifkannya.',

        'supplier_id' => $supplier->id,
    ]);
        }

        $supplier->update([
            'is_active' => false
        ]);

        $this->activityService->log(

            'Supplier',

            'DEACTIVATE',

            'Menonaktifkan supplier ' . $supplier->name,

            $supplier

        );

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Supplier berhasil dinonaktifkan.'
            );
    }

    public function show(Supplier $supplier)
{
    $supplier->loadCount('products');

    $products = Product::with('category')
        ->where('supplier_id', $supplier->id)
        ->orderBy('name')
        ->paginate(10);

    return view(
        'pages.supplier.show',
        compact(
            'supplier',
            'products'
        )
    );
}

    public function destroy(Supplier $supplier)
    {
        $this->activityService->log(

            'Supplier',

            'DELETE',

            'Menghapus supplier ' . $supplier->name,

            $supplier

        );

        $this->supplierService->delete(
            $supplier->id
        );

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Supplier berhasil dihapus.'
            );
    }
}