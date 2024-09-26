<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier; // Tambahkan ini jika Supplier ada di App\Models
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index() : View
    {
        $product = new Product;
        $products = $product->get_product()
                            ->latest()
                            ->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * create
     * 
     * @return View
     */
    public function create(): View
    {
        $product = new Product; // Ganti 'product' menjadi 'Product'
        $supplier = new Supplier; // Ganti 'supplier' menjadi 'Supplier'

        $data['categories'] = $product->get_category_product()->get();
        $data['suppliers'] = $supplier->get_supplier()->get();

        return view('products.create', compact('data'));
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     * 
     */
    public function store(Request $request): RedirectResponse // Ubah 'request' menjadi 'Request'
    {
        $validatedData = $request->validate([
            'product_category_id'   => 'required|integer',
            'id_supplier'           => 'required|integer',
            'image'                 => 'required|image|mimes:jpeg,jpg,png|max:2048', // Perbaiki 'pmg' menjadi 'png'
            'title'                 => 'required|min:5',
            'description'           => 'required|min:10',
            'price'                 => 'required|numeric',
            'stock'                 => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/images'); // Simpan gambar ke folder penyimpanan

            // Create product
            Product::create([ // Ubah 'prduct' menjadi 'Product'
                'product_category_id'   => $request->product_category_id,
                'id_supplier'           => $request->id_supplier,
                'image'                 => $image->hashName(),
                'title'                 => $request->title,
                'description'           => $request->description,
                'price'                 => $request->price,
                'stock'                 => $request->stock,
            ]);

            return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }

        // Redirect to index
        return redirect()->route('products.index')->with(['error' => 'Failed to upload image']); // Ubah ',' menjadi '.'
    }
}