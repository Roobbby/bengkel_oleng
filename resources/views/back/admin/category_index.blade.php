@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Category')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">List Category Barang</h5>
            <div class="card-body">
                <div class="col-sm-12 col-md-6 mb-4">
                    <a href="{{ route('categories.create') }}"
                        class="btn rounded-pill btn-primary waves-effect waves-light">Tambah Data</a>
                </div>
                @include('back.alert')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-category" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr data-entry-id="{{ $category->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-warning mb-2"><i class="ti ti-edit"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Edit Data"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#modal-delete{{ $category->id }}"
                                                class="btn btn-sm btn-danger mb-2"><i class="ti ti-trash"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Hapus Data"></i></a>
                                    </td>
                                    <div class="modal fade" id="modal-delete{{ $category->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Konfirmasi hapus data</h4>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah kamu yakin ingin menghapus
                                                        <b>{{ $category->name }}</b> ini
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
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
                                    <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Content Row -->

    </div>

@endsection

@push('scripts')
@endpush
