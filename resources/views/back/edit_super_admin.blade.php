@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin Manage')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Form Edit Super Admin</h5>
        <small class="text-muted float-end">Edit Super Admin</small>
      </div>
      <div class="card-body">
        <form action="{{ route('superadmin.update', $data->id) }}" method="POST">
          @include('back.alert')
          @csrf
          @method('PUT')
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
                value="{{ $data->name }}"
                required/>
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-username">Username</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-username2" class="input-group-text"
                ><i class="ti ti-user"></i
              ></span>
              <input
                type="text"
                class="form-control"
                name="username"
                id="basic-icon-default-username"
                placeholder="Username"
                aria-label="Username"
                aria-describedby="basic-icon-default-username2"
                value="{{ $data->username }}"
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
                value="{{ $data->email }}"
                required />
            </div>
            <div class="form-text">You can use letters, numbers & periods</div>
          </div>
    
          <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
      </div>
    </div>
  </div>
  
  @endsection