<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Services\Supplier\SupplierService;
use App\Services\Activity\ActivityService;
use Illuminate\Http\Request;
use App\Models\Supplier;

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


    public function index()
    {
        $suppliers = $this->supplierService->all();

        return view(
            'pages.supplier.index',
            compact('suppliers')
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

        // Ambil supplier yang baru dibuat
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
                'Supplier successfully created.'
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
                'Supplier updated successfully.'
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
                'Supplier deleted successfully.'
            );
    }
}