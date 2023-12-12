@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Category')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Tambah Admin</h5>
                <small class="text-muted float-end">Tambah Admin</small>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @include('back.alert')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name">Nama Category</label>
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Massukan Category Barang" aria-label="Nama" required />
                        </div>
                        <div class="mt-3">

                            <button type="submit" class="btn btn-primary">Tambah</button>
                            
                            <a href="{{ route('categories.index') }}"
                            class="btn rounded-pill btn-danger waves-effect waves-light">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @endsection
