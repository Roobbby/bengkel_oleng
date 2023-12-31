@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin Manage')
@section('content')

    @php

        $id = Auth::user()->id;
        $admin = App\Models\User::find($id);

    @endphp

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Data Admins</h5>
            @include('back.alert')
            <div class="card-datatable table-responsive">
                <div class="header ms-3"><a href="{{ route('admin.create') }}"
                        class="btn rounded-pill btn-primary waves-effect waves-light">Tambah Data</a></div>
                <br>

                <table class="dt-row-grouping table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $admin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td><img src="{{ !empty($admin->foto) ? url('image/profile/' . $admin->foto) : url('image/default-avatar.png') }}"
                                        width="50" alt=""></td>
                                <td>
                                    @if ($admin->status == 0)
                                        <form method="POST" action="{{ route('admin.toggleStatus', $admin->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-primary active waves-effect waves-light">Off</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                            disabled>On</button>
                                    @endif
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#modal-view{{ $admin->id }}"
                                        class="btn btn-sm btn-primary"><i class="ti ti-eye" data-bs-toggle="tooltip"
                                            data-bs-placement="right" data-bs-original-title="View Data"></i></a>
                                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-sm btn-warning"><i
                                            class="ti ti-edit" data-bs-toggle="tooltip" data-bs-placement="right"
                                            data-bs-original-title="Edit Data"></i></a>
                                    <a data-bs-toggle="modal" data-bs-target="#modal-delete{{ $admin->id }}"
                                        class="btn btn-sm btn-danger"><i class="ti ti-trash" data-bs-toggle="tooltip"
                                            data-bs-placement="right" data-bs-original-title="Hapus Data"></i></a>
                                </td>
                                {{-- Modal --}}
                                <div class="modal fade" id="modal-delete{{ $admin->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi hapus data</h4>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah kamu yakin ingin menghapus data user <b>{{ $admin->name }}</b>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.destroy', $admin->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-default"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="modal-view{{ $admin->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Data</h4>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <form action="">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-icon-default-fullname">Foto</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span id="basic-icon-default-fullname2"
                                                                        class="input-group-text"><i
                                                                            class="ti ti-user"></i></span>
                                                                    <img src="{{ !empty($admin->foto) ? url('image/profile/' . $admin->foto) : url('image/default-avatar.png') }}"
                                                                        width="100" alt="">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-icon-default-fullname">Nama</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span id="basic-icon-default-fullname2"
                                                                        class="input-group-text"><i
                                                                            class="ti ti-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        name="name" id="basic-icon-default-fullname"
                                                                        placeholder="Nama" aria-label="Nama"
                                                                        aria-describedby="basic-icon-default-fullname2"
                                                                        value="{{ $admin->name }}" required readonly />
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-icon-default-fullname">Username</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span id="basic-icon-default-fullname2"
                                                                        class="input-group-text"><i
                                                                            class="ti ti-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        name="usernmae" id="basic-icon-default-fullname"
                                                                        placeholder="Username" aria-label="Username"
                                                                        aria-describedby="basic-icon-default-fullname2"
                                                                        value="{{ $admin->username }}" required
                                                                        readonly />
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-icon-default-email">Email</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"><i
                                                                            class="ti ti-mail"></i></span>
                                                                    <input type="text" id="basic-icon-default-email"
                                                                        class="form-control" name="email"
                                                                        placeholder="Email" aria-label="Email"
                                                                        aria-describedby="basic-icon-default-email2"
                                                                        value="{{ $admin->email }}" required readonly />
                                                                </div>
                                                                <div class="form-text">You can use letters, numbers &
                                                                    periods</div>
                                                            </div>

                                                        </form>
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
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


@endsection
