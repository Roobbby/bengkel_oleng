@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit User')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Edit User</h5>
                <small class="text-muted float-end">Edit User</small>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $data->id) }}" method="POST">
                    @include('back.alert')
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Nama Bengkel</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="ti ti-user"></i></span>
                            <input type="text" class="form-control" name="nama_bengkel" id="basic-icon-default-fullname"
                                placeholder="Nama Bengkel" aria-label="Nama Bengkel"
                                aria-describedby="basic-icon-default-fullname2" value="{{ $data->nama_bengkel }}"
                                required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-username">Alamat Bengkel</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-username2" class="input-group-text"><i
                                    class="ti ti-user"></i></span>
                            <input type="text" class="form-control" name="alamat_bengkel"
                                id="basic-icon-default-username" placeholder="alamat_bengkel" aria-label="Username"
                                aria-describedby="basic-icon-default-username2" value="{{ $data->alamat_bengkel }}"
                                required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-username">Gmpas Bengkel</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-username2" class="input-group-text"><i
                                    class="ti ti-user"></i></span>
                            <input type="text" class="form-control" name="gmaps" id="basic-icon-default-username"
                                placeholder="gmaps" aria-label="Username" aria-describedby="basic-icon-default-username2"
                                value="{{ $data->gmaps }}" required />
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection
