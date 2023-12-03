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
                <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                    @include('back.alert')
                    @csrf
                    <input type="text" name="domain_id" value="{{ Auth::user()->domain->id }}">
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
                            <input type="text" class="form-control" name="harga" id="harga"
                                placeholder="Masukkan Harga" aria-label="Masukkan Harga" aria-describedby="harga" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Stok</label>
                        <div class="input-group input-group-merge">
                            <input type="number" name="stok" class="form-control" placeholder="Stok" aria-label="Stok"
                                id="stokInput" min="0" max="100" oninput="validateStok()"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="inputGroupFile02">Gambar</label>
                        <img id="imagePreview"
                        style="max-width: 30%; height: auto; margin-top: 10px; margin-bottom: 10px; display: none;"
                        alt="Preview">
                        <div class="input-group input-group-merge">
                            <input type="file" class="form-control" name="cover" id="inputGroupFile02"
                            onchange="previewImage()">
                        </div>
                    </div>
                    


                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Deskripsi</label>
                        <div class="input-group input-group-merge">
                            <div class="container-xxl flex-grow-1 container-p-y">

                                <textarea name="deskripsi" id="deskripsiInput"></textarea>

                            </div>
                        </div>
                    </div>
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
    @endsection
    @push('scripts')
        
    
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
    function previewImage() {
        var input = document.getElementById('inputGroupFile02');
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
        function validateStok() {
            var stokInput = document.getElementById('stokInput');

            // Pastikan nilai tidak kurang dari 0
            if (parseInt(stokInput.value) < 0) {
                stokInput.value = 0;
            }

            // Pastikan nilai tidak lebih dari 100
            if (parseInt(stokInput.value) > 100) {
                stokInput.value = 100;
            }
        }
    </script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsiInput');
    </script>

@endpush
