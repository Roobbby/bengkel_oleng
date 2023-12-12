@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'User Manage')
@section('content')

    @php
        use Illuminate\Support\Str;
        use App\Models\Domain;
        $user = Auth::user();
        $user->load('domain');
        $domain_user = optional($user->domain)->domain_user;
        $domainuser = Domain::value('domain_user');
    @endphp

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            @include('back.alert')
            <h5 class="card-header">Data Users</h5>
            <div class="card-datatable table-responsive">
                <div class="header ms-3"><a href="{{ route('user.create') }}"
                        class="btn rounded-pill btn-primary waves-effect waves-light">Tambah Data</a></div>

                <br>
                <table class="dt-row-grouping table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nama Bengkel</th>
                            <th>Alamat & Link Gmap</th>
                            <th>Status</th>
                            <th>Link Page</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                            @if ($user->domain)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $user->name }}
                                        <br>
                                        0{{ $user->telp }}
                                    </td>
                                    <td>
                                        {{ $user->domain->nama_bengkel }}
                                    </td>
                                    <td>
                                        {{ Str::limit($user->domain->alamat_bengkel, 20) }}
                                        <br>
                                        <a href="{{ $user->domain->gmaps }}" target="_blank">
                                            Lihat di Google Maps
                                        </a>
                                    </td>
                                    <td>
                                        @if ($user->status == 0)
                                            <form method="POST"
                                                action="{{ route('user.toggleStatus', ['id' => $user->id]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit"
                                                    class="btn btn-primary active waves-effect waves-light">Belum
                                                    Aktif</button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                disabled>Approve</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->domain)
                                            <form
                                                action="{{ route('haut.user',['domain_user' => $user->domain->domain_user]) }}"
                                                method="GET" target="_blank">
                                                <button type="submit">Ke Halaman Utama {{ $user->name }}</button>
                                            </form>
                                        @else
                                            <p>User {{ $user->name }} tidak memiliki domain terkait.</p>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#modal-view{{ $user->id }}"
                                                        class="btn btn-sm btn-primary mb-2"><i class="ti ti-eye"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-original-title="View Data"></i></a>

                                                    <a href="{{ route('user.edit', $user->domain->id) }}"
                                                        class="btn btn-sm btn-warning mb-2"><i class="ti ti-edit"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-original-title="Edit Data"></i></a>

                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete{{ $user->domain->id }}"
                                                        class="btn btn-sm btn-danger mb-2"><i class="ti ti-trash"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-original-title="Hapus Data"></i></a>

                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="btn btn-sm btn-success "><i class="ti ti-brand-cashapp "
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-original-title="Transaksi"></i></a>

                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="btn btn-sm btn-info "><i class="ti ti-user-dollar "
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-original-title="Pelanggan"></i></a>

                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="btn btn-sm btn-dark "><i class="ti ti-tool"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-original-title="Sparepart"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                            @endif
                            <div class="modal fade" id="modal-delete{{ $user->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Konfirmasi hapus data</h4>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah kamu yakin ingin menghapus data user <b>{{ $user->name }}</b></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
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
                            {{-- Modal View --}}
                            <div class="modal fade" id="modal-view{{ $user->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="modal-title">Data User</h4>
                                            <div class="card-body">
                                                <form action="">

                                                    <div class="d-flex align-items-center flex-column mb-3">
                                                        <img class="img-fluid rounded mb-2 pt-1 mt-4"
                                                            src="{{ !empty($user->domain->foto_profile) ? url('image/profile/' . $user->domain->foto_profile) : url('image/default_bengkel.png') }} "
                                                            height="100" width="100" alt="profile" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i
                                                                    class="ti ti-user"></i></span>
                                                            <input type="text" class="form-control" name="name"
                                                                id="basic-icon-default-fullname" placeholder="Nama"
                                                                aria-label="Nama" value="{{ $user->name }}" required
                                                                readonly />
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">WhatApps</label>
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-username2"
                                                                class="input-group-text"><i
                                                                    class="ti ti-brand-whatsapp"></i></span>
                                                            <input type="text" class="form-control" name="telp"
                                                                id="basic-icon-default-username" placeholder="WhatsApps"
                                                                aria-label="WhatsApps" value="0{{ $user->telp }}"
                                                                required readonly />
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Bengkel</label>
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-username2"
                                                                class="input-group-text"><i
                                                                    class="ti ti-building"></i></span>
                                                            <input type="text" class="form-control"
                                                                name="nama_bengkel" id="basic-icon-default-username"
                                                                placeholder="nama bengkel" aria-label="nama bengkel"
                                                                value="{{ $user->domain ? $user->domain->nama_bengkel : 'null' }}"
                                                                required readonly />
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-username2"
                                                                class="input-group-text"><i
                                                                    class="ti ti-map-2"></i></span>
                                                            <textarea class="form-control" name="alamat_bengkel" id="basic-icon-default-username" placeholder="alamat bengkel"
                                                                aria-label="alamat bengkel" required readonly>{{ $user->domain ? $user->domain->alamat_bengkel : 'null' }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Gmaps</label>
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-username2"
                                                                class="input-group-text"><i
                                                                    class="ti ti-brand-google-maps"></i></span>
                                                            <a href="{{ $user->domain ? $user->domain->gmaps : '#' }}"
                                                                target="_blank" class="form-control"
                                                                style="text-decoration: underline;"
                                                                {{ $user->domain ? '' : 'disabled' }}>{{ $user->domain ? $user->domain->gmaps : 'null' }}</a>
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
                            <th>Nama</th>
                            <th>Nama Bengkel</th>
                            <th>Alamat & Link Gmap</th>
                            <th>Status</th>
                            <th>Link Page</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>


@endsection
