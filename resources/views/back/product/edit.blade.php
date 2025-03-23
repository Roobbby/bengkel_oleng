@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit SparePart')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Edit Sparepart</h5>
            <small class="text-muted float-end">Edit Sparepart</small>
        </div>

        <div class="card-body">
            <form id="form" action="{{ route('products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                @include('back.alert')
                @csrf
                @method('PUT')
                <input type="hidden" name="domain_id" value="{{ Auth::user()->domain->id }}">
                <div class="mb-3">
                    <label class="form-label" for="name">Nama Barang</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Nama Bengkel" aria-label="Nama Bengkel" value="{{ $products->name }}" required />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        <option disabled {{ old('category_id', $products->category_id ?? '') == '' ? 'selected' : '' }}>
                            Pilih Kategori
                        </option>
                        @foreach ($categories as $id => $categoryName)
                        <option value="{{ $id }}" {{ old('category_id', $products->category_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $categoryName }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="price">Harga</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="price" id="price" value="{{ number_format($products->price, 0, ',', '.') }}" required />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="quantity">Stok</label>
                    <div class="input-group input-group-merge">
                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="{{ $products->quantity }}" required />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label mb-2" for="image">Gambar</label>
                    @if ($products->image)
                    <div>
                        <img src="{{ $products->image ? asset('storage/item/' . $products->image) : asset('image/default_item.png') }}" alt="profile" class="img-fluid mb-3" style="max-height: 250px; max-width: 250px;" id="existingImage">
                    </div>
                    @endif
                    <div class="input-group input-group-merge">
                        <input type="file" class="form-control" name="image" id="imageInput" />
                    </div>
                </div>

                <!-- {{-- <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Deskripsi</label>
                        <div class="input-group input-group-merge">
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <textarea name="deskripsi" id="deskripsiInput">{{ $products->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div> --}} -->

                <div class="text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-danger">kembali</a>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('deskripsiInput');
    $(document).ready(function() {
        $('#imageInput').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#existingImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        let priceInput = document.getElementById('price');

        // Simpan nilai asli jika ada di value
        if (priceInput.value) {
            let rawValue = priceInput.value.replace(/[^0-9]/g, '');
            priceInput.setAttribute('data-raw', rawValue);
            priceInput.value = formatRupiah(rawValue);
        }

        // Event listener untuk format angka saat diketik
        priceInput.addEventListener('keyup', function(e) {
            let rawValue = this.value.replace(/[^0-9]/g, ''); // Simpan angka asli tanpa format
            this.setAttribute('data-raw', rawValue); // Simpan nilai asli
            this.value = formatRupiah(rawValue); // Format tampilan input
        });

        // Saat form submit, kembalikan nilai asli
        document.getElementById('form').addEventListener('submit', function() {
            let priceRaw = priceInput.getAttribute('data-raw');
            if (priceRaw) {
                priceInput.value = priceRaw; // Kembalikan angka asli sebelum dikirim
            }
        });

        // Fungsi format Rupiah
        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^0-9]/g, ''),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }
    });
</script>
@endpush