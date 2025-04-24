<x-app-layout>
    
<div class="container py-5">
    <h2 class="mb-4">Keranjang Belanja</h2>

    @php
        $cartItems = []; // ini hanya placeholder, nanti bisa diganti data asli dari session atau database
    @endphp

    @if (count($cartItems) === 0)
        <div class="alert alert-info">
            Keranjang belanja kamu kosong 😢
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item['nama'] }}</td>
                        <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>Rp{{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('checkout.index') }}" class="btn btn-success">Lanjutkan ke Pembayaran</a>
        </div>
    @endif
</div>
</x-app-layout>
