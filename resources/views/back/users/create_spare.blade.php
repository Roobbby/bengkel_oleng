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
                <form action="{{ route('item.store') }}" method="POST">
                    @include('back.alert')
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Nama Barang</label>
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="nama_barang" id="basic-icon-default-fullname"
                                placeholder="Massukan Nama Barang" aria-label="Massukan Nama Barang"
                                aria-describedby="basic-icon-default-fullname2" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Category</label>
                        <div class="input-group input-group-merge">
                            <select name="id_category" id="id_category" class="select2 form-select">
                                <option selected="" disabled="">Pilih Category mu</option>
                                <option value="0">Aksesori</option>
                                <option value="1">Suku Cadang</option>
                                <option value="2">Layanan Jasa</option>
                            </select>
                            <input type="text" name="category" id="category" value="">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Harga</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" name="harga" id="harga"
                                placeholder="Masukkan Harga" aria-label="Masukkan Harga" aria-describedby="harga"
                                oninput="formatRupiah(this)" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Stok</label>
                        <div class="input-group input-group-merge">
                            <input type="number" class="form-control" placeholder="Stok" aria-label="Stok">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Gambar</label>
                        <div class="input-group input-group-merge">
                            <input type="file" class="form-control" id="inputGroupFile02">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Deskripsi</label>
                        <div class="input-group input-group-merge">
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <div class="row">
                                    <!-- Snow Theme -->
                                    <div class="col-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div id="snow-toolbar">
                                                    <span class="ql-formats">
                                                        <select class="ql-font"></select>
                                                        <select class="ql-size"></select>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <button class="ql-bold"></button>
                                                        <button class="ql-italic"></button>
                                                        <button class="ql-underline"></button>
                                                        <button class="ql-strike"></button>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <select class="ql-color"></select>
                                                        <select class="ql-background"></select>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <button class="ql-script" value="sub"></button>
                                                        <button class="ql-script" value="super"></button>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <button class="ql-header" value="1"></button>
                                                        <button class="ql-header" value="2"></button>
                                                        <button class="ql-blockquote"></button>
                                                        <button class="ql-code-block"></button>
                                                    </span>
                                                </div>
                                                <div id="snow-editor">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <input type="hidden" name="status" value=0 readonly>
                            <div class="">
                                <button type="submit"
                                    class="btn rounded-pill btn-primary waves-effect waves-light me-3">Tambah</button>

                                <a href="{{ route('item.index') }}"
                                    class="btn rounded-pill btn-danger waves-effect waves-light">Kembali</a>
                            </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('id_category').addEventListener('change', function() {

            var selectedIdCategory = this.value;

            var categoryOptions = {
                '0': 'Aksesori',
                '1': 'Suku Cadang',
                '2': 'Layanan Jasa'
            };

            document.getElementById('category').value = categoryOptions[selectedIdCategory];
        });
    </script>
    <script>
        function formatRupiah(input) {
            // Menghilangkan karakter selain angka
            var nilai = input.value.replace(/[^\d]/g, '');

            // Format nilai sebagai rupiah
            var hargaFormatted = new Intl.NumberFormat('id-ID').format(nilai);

            // Tampilkan nilai yang diformat pada input
            input.value = hargaFormatted;
        }
    </script>

@endsection
