<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Services\Supplier\SupplierService;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
       protected SupplierService $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $suppliers = $this->supplierService->all();

        return view('pages.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('pages.supplier.create');
    }

    public function store(SupplierRequest $request)
    {
        $this->supplierService->create($request->validated());

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier successfully created.');
    }

    public function edit(Supplier $supplier)
    {
        return view('pages.supplier.edit', compact('supplier'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $this->supplierService->update($supplier->id, $request->validated());

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier)
    {
        $this->supplierService->delete($supplier->id);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully.');
    }
}
