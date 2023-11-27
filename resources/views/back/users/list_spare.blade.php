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
                        <table class="dt-table table dataTable no-footer"
                            id="" aria-describedby="">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Category</th>
                                    <th>Foto Barang</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $lists)
                                    <tr>
                                        <td >{{ $loop->iteration }}</td>
                                        <td >{{ $lists->nama_barang }}</td>
                                        <td >{{ $lists->category }}</td>
                                        <td >{{ $lists->cover }}</td>
                                        <td >{{ $lists->harga }}</td>
                                        <td >{{ $lists->stok }}</td>
                                        <td >{{ $lists->deskripsi }}</td>
                                        <td >

                                        </td>
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
