<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;
    public function get_transaksi(){
        //get all products
        $sql = $this->select('transaksis.*', 'products.title', 'category_product.product_category_name', 'products.price', DB::raw("(jumlah_pembelian*price) as total_harga"))
                    ->join('products', 'products.id', '=', 'transaksis.products_id')
                    ->join('category_product', 'category_product.id', '=', 'transaksis.category_id');

        return $sql;
    }
}