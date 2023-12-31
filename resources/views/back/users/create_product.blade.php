@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Crete Items')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Tambah Barang</h5>
                <small class="text-muted float-end">Tambah Barang</small>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @include('back.alert')
                    @csrf
                    <input type="hidden" name="domain_id" value="{{ Auth::user()->domain->id }}">
                    <div class="mb-3">
                        <label class="form-label" for="name">Nama Barang</label>
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Massukan Nama Barang" value="{{ old('name') }}" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="category"> Category Barang</label>
                        <select name="category_id" id="category" class="form-control">
                            <option selected="" disabled="">Pilih Category mu</option>
                            @foreach ($categories as $id => $categoryName)
                                <option value="{{ $id }}">{{ $categoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Harga</label>
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="price" id="price"
                                placeholder="Masukkan Harga" aria-label="Masukkan Harga" value="{{ old('price') }}"
                                required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantity">Stok</label>
                        <div class="input-group input-group-merge">
                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Stok"
                                aria-label="Stok" min="0" max="100" oninput="validateStok()"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="image">Gambar</label>
                        <img id="imagePreview"
                            style="max-width: 30%; height: auto; margin-top: 10px; margin-bottom: 10px; display: none;"
                            alt="Preview">
                        <div class="input-group input-group-merge">
                            <input type="file" class="form-control" name="image" id="image"
                                onchange="previewImage()">
                        </div>
                    </div>

                    <div class="">
                        <button type="submit"
                            class="btn rounded-pill btn-primary waves-effect waves-light me-3">Tambah</button>

                        <a href="{{ route('products.index') }}"
                            class="btn rounded-pill btn-danger waves-effect waves-light">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function validateStok() {
            var quantity = document.getElementById('quantity');

            // Pastikan nilai tidak kurang dari 0
            if (parseInt(quantity.value) < 0) {
                quantity.value = 0;
            }

            // Pastikan nilai tidak lebih dari 100
            if (parseInt(quantity.value) > 100) {
                quantity.value = 100;
            }
        }
    </script>
    <script>
        function previewImage() {
            var input = document.getElementById('image');
            var preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        var rupiah = document.getElementById('price');
        rupiah.addEventListener('keyup', function (e) {
            // Gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value);
        });
    
        /* Fungsi formatRupiah */
        function formatRupiah(angka) {
        var number_string = angka.toString().replace(/[^0-9]/g, ''),
            split = number_string.split('.'),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + '.' + split[1] : rupiah;
        return rupiah;
        }
    </script>
    
@endpush
