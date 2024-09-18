<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body style="background: pink">
    
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">Transactions</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('transaksis.create') }}" class="btn btn-md btn-success mb-3">ADD TRANSACTION</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">TANGGAL TRANSAKSI</th>
                                <th scope="col">NAMA KASIR</th>
                                <th scope="col">NAMA PRODUK</th>
                                <th scope="col">KATEGORI PRODUK</th>
                                <th scope="col">HARGA PRODUK</th>
                                <th scope="col">JUMLAH PRODUK</th>
                                <th scope="col">TOTAL HARGA</th>
                                <th scope="col" style="width: 20%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $trns)
                            <tr>
                                <td>{{ $trns->tanggal_transaksi }}</td>
                                <td>{{ $trns->nama_kasir }}</td>
                                <td>{{ $trns->title }}</td>
                                <td>{{ $trns->product_category_name }}</td>
                                <td>{{ "Rp" . number_format($trns->price, 2, ',', '.') }}</td>
                                <td>{{ $trns->jumlah_pembelian }}</td>
                                <td>{{ "Rp" . number_format($trns->total_harga, 2, ',', '.') }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('transaksis.destroy', $trns->id) }}" method="POST">
                                        <a href="{{ route('transaksis.show', $trns->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                        <a href="{{ route('transaksis.edit', $trns->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Data Transaksi belum Tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Message with SweetAlert
    @if (session('success'))
      Swal.fire({
        icon: 'success',
        title: 'SUCCESS!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
      });
    @elseif (session('error'))
      Swal.fire({
        icon: 'error',
        title: 'FAILED!',
        text: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 2000
      });
    @endif
</script>
</body>
</html>