<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan Supplier.
     */
    public function index(): View
    {
        // Mengambil semua supplier beserta nama kategori mereka
        $suppliers = Supplier::select('suppliers.*', 'category_supplier.supplier_category_name as category_name')
            ->leftJoin('category_supplier', 'category_supplier.id', '=', 'suppliers.supllier_category_id')
            ->latest()
            ->paginate(10);

        // Menampilkan view 
        return view('suppliers.index', compact('suppliers'));
    }
}