@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'User Manage')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Form Tambah User</h5>
        <small class="text-muted float-end">Tambah User</small>
      </div>
      <div class="card-body">
        <form action="{{ route('user.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Sapaan</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"
                ><i class="ti ti-user-question"></i
              ></span>
                  <select
                    name="gender"
                    class="select2 form-select"
                    >
                    <option selected="" disabled="">Pilih Sapaan mu</option>
                    <option value="0">Pak</option>
                    <option value="1">Bu</option>
                    <option value="2">Saudara</option>
                    <option value="3">Saudari</option>
                    <option value="4">Kak</option>
                    <option value="5">Dek</option>
                  </select>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Panggilan</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"
                ><i class="ti ti-user-heart"></i
              ></span>
              <input
                type="text"
                class="form-control"
                name="name"
                id="basic-icon-default-fullname"
                placeholder="Massukan Panggilan"
                aria-label="Massukan Panggilan"
                aria-describedby="basic-icon-default-fullname2"
                required/>
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Nama</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"
                ><i class="ti ti-user"></i
              ></span>
              <input
                type="text"
                class="form-control"
                name="name"
                id="basic-icon-default-fullname"
                placeholder="Nama"
                aria-label="Nama"
                aria-describedby="basic-icon-default-fullname2"
                required/>
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-mail"></i></span>
              <input
                type="text"
                id="basic-icon-default-email"
                class="form-control"
                name="email"
                placeholder="Email"
                aria-label="Email"
                aria-describedby="basic-icon-default-email2"
                required />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-lock">Password</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="ti ti-lock"></i></span>
                <input
                    type="text"
                    id="basic-icon-default-key"
                    class="form-control"
                    name="password"
                    placeholder="Password"
                    aria-label="Password"
                    aria-describedby="basic-icon-default-key"
                    required
                    value="123456"
                    readonly
                />
              </div>
            <div class="form-text">Ini adalah Default Password yang diberikan </div>
            <div class="form-text">Silahkan reset password setelah akun dibuat </div>
          </div>
          <div class="mb-3" hidden>
            <label for="smallSelect" class="form-label">Role</label>
            <select id="smallSelect" name="role" class="form-select form-select-md ">
              <option value="2">User</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
  @endsection