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
                <form action="{{ route('item.update', $products->id) }}" method="POST">
                    @include('back.alert')
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Nama Barang</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="ti ti-user"></i></span>
                            <input type="text" class="form-control" name="nama_bengkel" id="basic-icon-default-fullname"
                                placeholder="Nama Bengkel" aria-label="Nama Bengkel"
                                aria-describedby="basic-icon-default-fullname2" value="{{ $products->nama_barang }}" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select id="id_category" name="id_category" class="select2 form-select">
                            <option selected="" disabled="">Pilih Category</option>
                            <option value="0" {{ $products->id_category == '0' ? 'selected' : '' }}>
                                Aksesoris</option>
                            <option value="1" {{ $products->id_category == '1' ? 'selected' : '' }}>
                                Suku Cadang</option>
                            <option value="2" {{ $products->id_category == '2' ? 'selected' : '' }}>
                                Layananan Jasa</option>
                        </select>
                        <input type="text" name="category" id="category" value="{{ $products->category }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-username">Harga</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-username2" class="input-group-text"><i
                                    class="ti ti-user"></i></span>
                            <input type="text" class="form-control" name="gmaps" id="basic-icon-default-username"
                                placeholder="gmaps" aria-label="Username" aria-describedby="basic-icon-default-username2"
                                value="{{ $products->harga }}" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-username">Stok</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-username2" class="input-group-text"><i
                                    class="ti ti-user"></i></span>
                            <input type="text" class="form-control" name="gmaps" id="basic-icon-default-username"
                                placeholder="gmaps" aria-label="Username" aria-describedby="basic-icon-default-username2"
                                value="{{ $products->stok }}" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-username">Gambar</label>
                        <div>
                            <img src="/image/item/{{ $products->cover }}" alt="profile" class="img-fluid mb-3"
                                style="max-height: 100px; max-width: 100px;">
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="file" class="form-control" name="cover" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Deskripsi</label>
                        <div class="input-group input-group-merge">
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <textarea name="deskripsi" id="deskripsiInput">{{ $products->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <a href="{{ route('item.index') }}" class="btn btn-danger">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Set nilai awal untuk category pada saat halaman dimuat
        document.getElementById('category').value = getCategoryName('{{ $products->id_category }}');

        // Event listener untuk mengubah nilai category saat id_category berubah
        document.getElementById('id_category').addEventListener('change', function() {
            var selectedIdCategory = this.value;
            document.getElementById('category').value = getCategoryName(selectedIdCategory);
        });

        // Fungsi untuk mendapatkan nama kategori berdasarkan ID
        function getCategoryName(categoryId) {
            var categoryOptions = {
                '0': 'Aksesori',
                '1': 'Suku Cadang',
                '2': 'Layanan Jasa'
            };

            return categoryOptions[categoryId] || '';
        }
    </script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsiInput');
    </script>
@endpush
