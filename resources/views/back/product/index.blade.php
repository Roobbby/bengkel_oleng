@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Product List')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <h5 class="card-header">List Data Sparepart</h5>
        @include('back.alert')
        <div class="card-body">
            <div class="col-sm-12 col-md-6 mb-4">
                <a href="{{ route('products.create') }}"
                    class="btn rounded-pill btn-primary waves-effect waves-light">Tambah Data</a>
                <a href="{{ route('products.create') }}"
                    class="btn rounded-pill btn-success waves-effect waves-light">Export Pdf</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-product"
                    cellspacing="0" width="90%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Cover</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr data-entry-id="{{ $product->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td><span>{{ $product->category->name }}</span></td>
                            <td>{{ number_format($product->price, 0, ',' , '.') }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                @if ($product->image)
                                <a href="image/item/{{ $product->image }}" target="_blank">
                                    <img src="image/item/{{ $product->image }}" width="45px" height="45px" />
                                </a>
                                @else
                                <span class="badge badge-warning">no image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="btn btn-sm btn-primary mb-2"><i class="ti ti-eye"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="View Data"></i></a>

                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-sm btn-warning mb-2"><i class="ti ti-edit"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Edit Data"></i></a>

                                <a data-bs-toggle="modal" data-bs-target="#modal-delete{{ $product->id }}"
                                    class="btn btn-sm btn-danger mb-2"><i class="ti ti-trash"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Hapus Data"></i></a>
                            </td>

                            <div class="modal fade" id="modal-delete{{ $product->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Konfirmasi hapus data</h4>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah kamu yakin ingin menghapus
                                                <b>{{ $product->name }}</b> ini
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('products.destroy', $product->id) }}"
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

                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
@endpush