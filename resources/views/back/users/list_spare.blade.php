@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'List Sparepart')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">List Data Sparepart</h5>
            <div class="card-datatable dataTable_select text-nowrap">
                <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        @include('back.alert')
                        <div class="col-sm-12 col-md-6">
                            <a href="{{ route('item.create') }}"
                                class="btn rounded-pill btn-primary waves-effect waves-light">Tambah Data</a>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                            <div id="search" class="dataTables_filter">
                                <label>Search:<input type="search" class="form-control" placeholder=""
                                        aria-controls="search"></label>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-table table dataTable no-footer" id="" aria-describedby="">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Category</th>
                                    <th>Foto Barang</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $lists)
                                    <tr class="">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lists->nama_barang }}</td>
                                        <td>{{ $lists->category }}</td>
                                        <td> <img src="image/item/{{ $lists->cover }}" alt="Barang" class="rounded"
                                                width="100" height="70">
                                        </td>
                                        <td>{{ $lists->harga }}</td>
                                        <td>{{ $lists->stok }}</td>
                                        <td>{!! Str::limit($lists->deskripsi, 10, '...') !!}</td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#modal-view{{ $lists->id }}"
                                                class="btn btn-sm btn-primary mb-2"><i class="ti ti-eye"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="View Data"></i></a>

                                            <a href="{{ route('item.edit', $lists->id) }}"
                                                class="btn btn-sm btn-warning mb-2"><i class="ti ti-edit"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Edit Data"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#modal-delete{{ $lists->id }}"
                                                class="btn btn-sm btn-danger mb-2"><i class="ti ti-trash"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Hapus Data"></i></a>
                                        </td>
                                
                                        <div class="modal fade" id="modal-delete{{ $lists->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Konfirmasi hapus data</h4>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah kamu yakin ingin menghapus
                                                            <b>{{ $lists->nama_barang }}</b> ini
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('item.destroy', $lists->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-default"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modal-view{{ $lists->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 class="modal-title">Data Barang</h4>
                                                        <div class="card-body">
                                                            <form action="">

                                                                <div class="d-flex align-items-center flex-column mb-3">
                                                                    <label class="form-label"> Gambar Barang</label>
                                                                    <img class="img-fluid rounded mb-2 pt-1 mt-4"
                                                                        src="image/item/{{ $lists->cover }}" alt="Barang"
                                                                        class="rounded" width="150" height="100" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Barang</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span class="input-group-text"><i
                                                                                class="ti ti-user"></i></span>
                                                                        <input type="text" class="form-control"
                                                                            name="nama_barang"
                                                                            id="basic-icon-default-fullname"
                                                                            placeholder="Nama" aria-label="Nama"
                                                                            value="{{ $lists->nama_barang }}" required
                                                                            readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Category</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-username2"
                                                                            class="input-group-text"><i
                                                                                class="ti ti-brand-whatsapp"></i></span>
                                                                        <input type="text" class="form-control"
                                                                            name="category" id="basic-icon-default-username"
                                                                            placeholder="WhatsApps" aria-label="WhatsApps"
                                                                            value="{{ $lists->category }}" required
                                                                            readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Harga</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-username2"
                                                                            class="input-group-text"><i
                                                                                class="ti ti-building"></i></span>
                                                                        <input type="text" class="form-control"
                                                                            name="harga"
                                                                            id="basic-icon-default-username"
                                                                            placeholder="nama bengkel"
                                                                            aria-label="nama bengkel"
                                                                            value="{{ $lists->harga }}" required
                                                                            readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Stok</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-username2"
                                                                            class="input-group-text"><i
                                                                                class="ti ti-building"></i></span>
                                                                        <input type="text" class="form-control"
                                                                            name="stok"
                                                                            id="basic-icon-default-username"
                                                                            placeholder="nama bengkel"
                                                                            aria-label="nama bengkel"
                                                                            value="{{ $lists->stok }}" required
                                                                            readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Deskripsi</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-username2"
                                                                            class="input-group-text"><i
                                                                                class="ti ti-map-2"></i></span>
                                                                        <textarea class="form-control" name="deskripsi" id="basic-icon-default-username" placeholder="alamat bengkel"
                                                                            aria-label="alamat bengkel" required readonly>{!! $lists->deskripsi !!}</textarea>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="" method="post">
                                                            <button type="button" class="btn btn-default"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_3_paginate">
                                <ul class="pagination">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
