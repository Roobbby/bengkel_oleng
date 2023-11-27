@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'List Sparepart')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">List Data Sparepart</h5>
            <div class="header ms-3"><a href="{{ route('item.create') }}"
                    class="btn rounded-pill btn-primary waves-effect waves-light">Tambah Data</a></div>
            <div class="card-datatable dataTable_select text-nowrap">
                <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="DataTables_Table_3_length">
                                <label>Show <select name="DataTables_Table_3_length" aria-controls="DataTables_Table_3"
                                        class="form-select">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                            <div id="DataTables_Table_3_filter" class="dataTables_filter">
                                <label>Search:<input type="search" class="form-control" placeholder=""
                                        aria-controls="DataTables_Table_3"></label>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-select-table table dataTable no-footer dt-checkboxes-select"
                            id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_3"
                                        rowspan="1" colspan="1" style="width: 34.3854px;" aria-sort="descending"
                                        aria-label="No: activate to sort column ascending">No
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1"
                                        colspan="1" style="width: 110.479px;"
                                        aria-label="Nama Barang: activate to sort column ascending">Nama Barang
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1"
                                        colspan="1" style="width: 77.6979px;"
                                        aria-label="Category: activate to sort column ascending">Category
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1"
                                        colspan="1" style="width: 61.3229px;"
                                        aria-label="Cover Image: activate to sort column ascending">Cover Image
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1"
                                        colspan="1" style="width: 66.0625px;"
                                        aria-label="Harga: activate to sort column ascending">Harga
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1"
                                        colspan="1" style="width: 54.2604px;"
                                        aria-label="Stok: activate to sort column ascending">Stok
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1"
                                        colspan="1" style="width: 87.4896px;"
                                        aria-label="Action: activate to sort column ascending">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $lists)
                                    <tr class="odd">
                                        <td valign="top" colspan="8">{{ $loop->iteration }}</td>
                                        <td valign="top" colspan="8">{{ $lists->nama_barang }}</td>
                                        <td valign="top" colspan="8">{{ $lists->category }}</td>
                                        <td valign="top" colspan="8">{{ $lists->cover }}</td>
                                        <td valign="top" colspan="8">{{ $lists->harga }}</td>
                                        <td valign="top" colspan="8">{{ $lists->stok }}</td>
                                        <td valign="top" colspan="8">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_info" id="DataTables_Table_3_info" role="status" aria-live="polite">
                                Showing 0 to 0 of 0 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_3_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled"
                                        id="DataTables_Table_3_previous"><a aria-controls="DataTables_Table_3"
                                            aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0"
                                            class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item next disabled" id="DataTables_Table_3_next"><a
                                            aria-controls="DataTables_Table_3" aria-disabled="true" aria-role="link"
                                            data-dt-idx="next" tabindex="0" class="page-link">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
