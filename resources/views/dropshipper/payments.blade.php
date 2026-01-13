@extends('layouts.dropshipper')

@section('title', 'Pembayaran')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        
        <div class="bg-orange-600 p-6 text-center text-white">
            <h1 class="text-2xl font-bold font-display">Konfirmasi Pembayaran</h1>
            <p class="text-orange-100 text-sm mt-1">Lengkapi data pengiriman dan pembayaran</p>
        </div>

        <div class="p-8">
            <form action="{{ route('dropshipper.payment.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="grand_total" id="grandTotal">
                <input type="hidden" name="selected_ids" value="{{ implode(',', array_column($selectedProducts, 'id')) }}">

                <!-- Informasi Pengiriman -->
                <div class="mb-8 border-b border-gray-100 pb-8">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Alamat Pengiriman</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                            <input type="text" name="shipping_name" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="Nama lengkap">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="tel" name="shipping_phone" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="0812-3456-7890">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="shipping_address" rows="2" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            placeholder="Jl. Nama Jalan No. 123, RT/RW, Kelurahan, Kecamatan"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                            <input type="text" name="shipping_city" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="Nama Kota/Kabupaten">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <input type="text" name="shipping_postal_code" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="12345">
                        </div>
                    </div>
                </div>

                <!-- Rincian Biaya -->
                <div class="mb-8 border-b border-gray-100 pb-8">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Rincian Biaya</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal Produk</span>
                            <span class="font-medium">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <div>
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <select name="shipping_cost" id="shippingCost" onchange="updateTotal()" 
                                    class="ml-2 border border-gray-300 rounded px-2 py-1 text-sm">
                                    <option value="0">Pilih Kurir</option>
                                    <option value="10000">JNE Reguler - Rp 10.000</option>
                                    <option value="15000">JNE OKE - Rp 15.000</option>
                                    <option value="20000">JNE YES - Rp 20.000</option>
                                    <option value="12000">POS Indonesia - Rp 12.000</option>
                                    <option value="18000">TIKI - Rp 18.000</option>
                                </select>
                            </div>
                            <span id="shippingCostDisplay" class="font-medium">Rp 0</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Platform (5%)</span>
                            @php
                                $platformFee = $totalHarga * 0.05;
                            @endphp
                            <span id="platformFeeDisplay" class="font-medium">Rp {{ number_format($platformFee, 0, ',', '.') }}</span>
                            <input type="hidden" name="platform_fee" id="platformFee" value="{{ $platformFee }}">
                        </div>
                        
                        <div class="border-t border-gray-200 pt-3 mt-3">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total Pembayaran</span>
                                <span id="totalAmount">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Metode Pembayaran</h2>
                    
                    <div class="mb-6">
                        <select name="payment_method" id="paymentMethod" onchange="changeRekening()" 
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-orange-500 outline-none transition">
                            <option value="BCA Virtual Account">BCA Virtual Account</option>
                            <option value="Mandiri Virtual Account">Mandiri Virtual Account</option>
                            <option value="BRI Virtual Account">BRI Virtual Account</option>
                            <option value="GoPay">GoPay</option>
                            <option value="OVO">OVO</option>
                            <option value="Dana">Dana</option>
                            <option value="ShopeePay">ShopeePay</option>
                        </select>
                    </div>

                    <div class="bg-blue-50 p-5 rounded-xl border border-blue-100 mb-8 flex items-center gap-4 transition-all">
                        <div id="bankLogo" class="w-14 h-14 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">
                            BCA
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 uppercase tracking-wide" id="payLabel">Nomor Virtual Account</p>
                            <div class="flex items-center justify-between">
                                <p class="text-2xl font-mono font-bold text-gray-800" id="rekNum">8800-1234-5678-9000</p>
                                <button type="button" onclick="copyRek()" class="text-blue-600 hover:text-blue-800 text-xs font-bold bg-white border border-blue-200 px-3 py-1 rounded-full shadow-sm">SALIN</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-800 mb-3">Upload Bukti Transfer</label>
                        <div class="relative">
                            <input type="file" name="proof_of_payment" id="fileUpload" class="hidden" onchange="previewFile()" required>
                            <label for="fileUpload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-orange-50 hover:border-orange-400 transition bg-gray-50">
                                <div class="text-center" id="uploadPlaceholder">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    <p class="text-sm text-gray-600"><span class="font-bold text-orange-600">Klik untuk upload</span> bukti transfer</p>
                                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (maks. 2MB)</p>
                                </div>
                                <p id="fileName" class="text-green-600 font-bold hidden"></p>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-orange-600 text-white font-bold py-4 rounded-xl hover:bg-orange-700 transition shadow-lg shadow-orange-200 text-lg">
                    Konfirmasi & Selesai
                </button>
                <a href="{{ route('dropshipper.cart') }}" class="block text-center text-gray-400 text-sm mt-4 hover:text-gray-600">Batalkan</a>
            </form>
        </div>
    </div>
</div>

<script>
    // Data Dummy Nomor untuk Simulasi
    const accounts = {
        'BCA Virtual Account': { code: '8800-1234-5678-000', color: 'bg-blue-600', label: 'BCA' },
        'Mandiri Virtual Account': { code: '900-00-98765-4321', color: 'bg-yellow-600', label: 'MDR' },
        'BRI Virtual Account': { code: '1288-01-00099-30', color: 'bg-blue-800', label: 'BRI' },
        'GoPay': { code: '0812-3456-7890', color: 'bg-green-500', label: 'GOP' },
        'OVO': { code: '0812-3456-7890', color: 'bg-purple-600', label: 'OVO' },
        'Dana': { code: '0812-3456-7890', color: 'bg-blue-400', label: 'DAN' },
        'ShopeePay': { code: '0812-3456-7890', color: 'bg-orange-500', label: 'SPY' },
    };

    // Hitung total awal
    const subtotal = {{ $totalHarga }};
    let shippingCost = 0;
    const platformFee = {{ $platformFee }};

    function updateTotal() {
        // Dapatkan biaya pengiriman yang dipilih
        const shippingSelect = document.getElementById('shippingCost');
        shippingCost = parseInt(shippingSelect.value) || 0;
        
        // Update tampilan biaya pengiriman
        document.getElementById('shippingCostDisplay').textContent = formatRupiah(shippingCost);
        
        // Hitung total
        const total = subtotal + shippingCost + platformFee;
        
        // Update tampilan total
        document.getElementById('totalAmount').textContent = formatRupiah(total);
        document.getElementById('grandTotal').value = total;
    }

    function formatRupiah(amount) {
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function changeRekening() {
        const selected = document.getElementById('paymentMethod').value;
        const data = accounts[selected];
        
        document.getElementById('rekNum').innerText = data.code;
        document.getElementById('bankLogo').className = `w-14 h-14 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm ${data.color}`;
        document.getElementById('bankLogo').innerText = data.label;
    }

    function previewFile() {
        const input = document.getElementById('fileUpload');
        if (input.files && input.files[0]) {
            // Validasi ukuran file (maks 2MB)
            const fileSize = input.files[0].size / 1024 / 1024; // in MB
            if (fileSize > 2) {
                alert('Ukuran file terlalu besar. Maksimal 2MB');
                input.value = ''; // Reset input file
                return;
            }
            
            // Validasi tipe file
            const fileType = input.files[0].type;
            if (!fileType.match('image.*')) {
                alert('Hanya file gambar yang diizinkan (JPG, PNG)');
                input.value = ''; // Reset input file
                return;
            }
            
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            const nameDisplay = document.getElementById('fileName');
            nameDisplay.innerText = "✓ " + input.files[0].name;
            nameDisplay.classList.remove('hidden');
        }
    }

    function copyRek() {
        const text = document.getElementById('rekNum').innerText;
        navigator.clipboard.writeText(text);
        alert('Nomor rekening berhasil disalin!');
    }
    
    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Set default shipping cost display
        document.getElementById('shippingCostDisplay').textContent = 'Rp 0';
        document.getElementById('platformFeeDisplay').textContent = formatRupiah(platformFee);
    });


</script>
@endsection