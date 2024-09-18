<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function index(): View
    {
        $transaksis = new Transaksi;

        $transaksi = $transaksis->get_transaksi()
                                ->latest()
                                ->paginate(10);

        return view('transaksis.index', compact('transaksi'));
    }
}