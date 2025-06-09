@extends('backend.v_layouts.app')
@section('title', 'Transaksi Baru')
@push('styles')
    @vite('resources/css/transaksi.css')
@endpush

@section('content')
<div class="transaksi-container">
    <div class="transaksi-layout">

        {{-- KOLOM KIRI: DAFTAR PRODUK --}}
        <div class="product-selection">
            <div class="page-header">
                <div><h1>Transaksi Baru</h1><p>Pilih produk untuk ditambahkan ke keranjang.</p></div>
                <a href="{{ route('backend.transaksi.history') }}" class="btn-secondary">Riwayat Transaksi</a>
            </div>
            <form action="{{ route('backend.transaksi.index') }}" method="GET">
                <div class="search-bar">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" /></svg></span>
                    <input type="text" name="search" placeholder="Cari Produk Berdasarkan Nama Atau Kode Produk" onchange="this.form.submit()">

                </div>
            </form>
            <div class="product-grid">
                @forelse($products as $product)
                    <div class="product-card" onclick="addToCart({{ $product->idBrg }}, '{{ $product->namaBrg }}', {{ $product->hrgJual }}, '{{ asset('storage/' . $product->fotoBrg) }}')">
                        <img src="{{ asset('storage/' . $product->fotoBrg) }}" alt="{{ $product->namaBrg }}">
                        <div class="info"><h3>{{ $product->namaBrg }}</h3><p>Rp{{ number_format($product->hrgJual, 0, ',', '.') }}</p></div>
                    </div>
                @empty
                    <p>Produk Tidak Ditemukan
                    </p>
                @endforelse
            </div>
        </div>

        {{-- KOLOM KANAN: KERANJANG --}}
        <div class="cart-section">
            <div class="cart">
                <div class="cart-header">
                    <h2>Keranjang</h2>
                    <p id="order-code">#TRX-{{ $nextTransactionId }}</p>
                </div>
                <div id="cart-items-container"><p class="empty-cart-message">Keranjang masih kosong.</p></div>
                <div class="cart-summary">
                    <div class="summary-row"><span>Subtotal</span><span id="cart-subtotal">Rp0</span></div>
                    <div class="summary-row"><span>Pajak 11%</span><span id="cart-tax">Rp0</span></div>
                    <div class="summary-row total"><span>Total Pembayaran</span><span id="cart-total">Rp0</span></div>
                    <input type="number" placeholder="Masukan Uang Pelanggan" class="payment-input" id="payment-input">
                    <button class="btn-process" id="process-btn" onclick="calculateChange()">Proses</button>
                    <div class="change-display"><span>Uang Kembalian</span><span id="change-display">Rp0</span></div>
                    <button class="btn-process" id="complete-btn">Selesai</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let cart = [];
    const PAJAK = 0.11;
    let currentTotal = 0;

    function formatRupiah(number) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number); }

    function addToCart(id, name, price, image) {
        const existingProductIndex = cart.findIndex(item => item.id === id);
        if (existingProductIndex > -1) {
            cart[existingProductIndex].quantity++;
        } else {
            cart.push({ id, name, price, quantity: 1, image: image });
        }
        renderCart();
    }
    
    function updateQuantity(id, change) {
        const productIndex = cart.findIndex(item => item.id === id);
        if (productIndex > -1) {
            cart[productIndex].quantity += change;
            if (cart[productIndex].quantity <= 0) {
                cart.splice(productIndex, 1);
            }
        }
        renderCart();
    }

    function removeFromCart(id) {
        cart = cart.filter(item => item.id !== id);
        renderCart();
    }

    function renderCart() {
        const cartContainer = document.getElementById('cart-items-container');
        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="empty-cart-message">Keranjang masih kosong.</p>';
        } else {
            cartContainer.innerHTML = cart.map(item => `
                <div class="cart-item">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    <div class="details">
                        <h4>${item.name}</h4>
                        <div class="qty">
                            <span style="cursor:pointer;" onclick="updateQuantity(${item.id}, -1)">-</span>
                            <strong>${item.quantity}</strong>
                            <span style="cursor:pointer;" onclick="updateQuantity(${item.id}, 1)">+</span>
                        </div>
                    </div>
                    <div class="price">${formatRupiah(item.price * item.quantity)}</div>
                    <div style="cursor:pointer;" onclick="removeFromCart(${item.id})">🗑️</div>
                </div>
            `).join('');
        }
        updateTotals();
    }

    function updateTotals() {
        const subtotal = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
        const tax = subtotal * PAJAK;
        currentTotal = subtotal + tax; // Simpan total ke variabel global
        document.getElementById('cart-subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('cart-tax').textContent = formatRupiah(tax);
        document.getElementById('cart-total').textContent = formatRupiah(currentTotal);
    }

    function calculateChange() {
        const paymentAmount = parseFloat(document.getElementById('payment-input').value) || 0;
        // PERBAIKAN: Validasi uang pelanggan
        if (paymentAmount < currentTotal) {
            alert('Jumlah uang yang dibayarkan tidak boleh kurang dari Total Pembayaran!');
            return;
        }
        const change = paymentAmount - currentTotal;
        document.getElementById('change-display').textContent = formatRupiah(Math.max(0, change));
    }

    // FUNGSI BARU: Untuk menyimpan transaksi
    document.getElementById('complete-btn').addEventListener('click', function() {
        this.disabled = true; // Nonaktifkan tombol untuk mencegah klik ganda
        this.textContent = 'Menyimpan...';

        const paymentAmount = parseFloat(document.getElementById('payment-input').value) || 0;
        
        if (cart.length === 0) {
            alert('Keranjang masih kosong!');
            this.disabled = false;
            this.textContent = 'Selesai';
            return;
        }
        if (paymentAmount < currentTotal) {
            alert('Jumlah uang yang dibayarkan tidak mencukupi!');
            this.disabled = false;
            this.textContent = 'Selesai';
            return;
        }

        const transactionData = {
            total_pembayaran: currentTotal,
            uang_dibayar: paymentAmount,
            uang_kembalian: paymentAmount - currentTotal,
            items: cart
        };

        fetch("{{ route('backend.transaksi.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(transactionData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
               
                window.location.reload(); 
            } else {
                alert('Gagal: ' + data.message);
                this.disabled = false;
                this.textContent = 'Selesai';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan teknis.');
        })
        .finally(() => {
            this.disabled = false; // Aktifkan kembali tombol
            this.textContent = 'Selesai';
        });
    });

    
</script>
@endpush