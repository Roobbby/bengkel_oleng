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
            <form action="{{ route('products.update', $products->id) }}" method="POST">
                @include('back.alert')
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="name">Nama Barang</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Nama Bengkel" aria-label="Nama Bengkel" value="{{ $products->name }}" readonly />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select id="id_category" name="id_category" class="select2 form-select" disabled>
                        <option selected="" disabled="">Pilih Category</option>
                        @foreach($categories as $id => $categoryName)
                        <option {{ $id == $products->category->id ? 'selected' : '' }} value="{{ $id }}">{{ $categoryName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="price">Harga</label>
                    <div class="input-group input-group-merge">
                        <input type="number" class="form-control" name="price" id="basic-icon-default-username" value="{{ $products->price }}" readonly />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="quantity">Stok</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="quantity" id="quantity" value="{{ $products->quantity }}" readonly />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label mb-2" for="image">Gambar</label>
                    @if ($products->image)
                    <div>
                        <img src="{{ $product->image ? asset('storage/item/' . $product->image) : asset('image/default_item.png') }}" alt="profile" class="img-fluid mb-3" style="max-height: 250px; max-width: 250px;" id="existingImage">
                    </div>
                    @endif
                    <!-- <div class="input-group input-group-merge">
                            <input type="file" class="form-control" name="image" id="imageInput" />
                        </div> -->
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
    $(document).ready(function() {
        $('#imageInput').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#existingImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    CKEDITOR.replace('deskripsiInput');
</script>
@endpush