@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'User Manage')
@section('content')

@php
use Illuminate\Support\Str;

  $user = Auth::user();
  $domain = $user->domain;

  $profileDataBengkel = Auth::user();
  $profileDataBengkel->load('domain');
  $namaBengkel = $profileDataBengkel->domain ? $profileDataBengkel->domain->nama_bengkel : "Tidak ada";

@endphp

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-4">
    <div class="col-xl-5 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
      <div class="profile-section">
        <div class="card mb-4">
          <h5 class="card-header">Profile bengkel</h5>
          <div class="card-body">
            <div class="user-avatar-section">
              <div class="d-flex align-items-center flex-column">
                <img
                  class="img-fluid rounded mb-2 pt-1 mt-4"
                  src="{{ (!empty($profileDataBengkel->domain->foto)) ? url('image/profile_bengkel/'.$profileDataBengkel->domain->foto) : url('image/default_bengkel.png') }} " 
                  height="100"
                  width="100"
                  alt="profile"  />
                <div class="user-info text-center">
                  <h4 class="mb-2">{{ $profileDataBengkel->domain->nama_bengkel }}</h4>
                  <h4 class="mb-2">{{ $profileDataBengkel->domain->domain_user }}</h4>
                </div>
              </div>
            </div>
            <p class="mt-4 small text-uppercase text-muted">Details</p>
            <div class="info-container">
              <ul class="list-unstyled">
                <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Alamat Bengkel :</span>
                  <span>{{ $profileDataBengkel->domain->alamat_bengkel }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Link gmaps :</span>
                  <span>{{ $profileDataBengkel->domain->gmaps }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-medium me-1">Link Landing :</span>
                  <span>{{ $profileDataBengkel->domain->domain }}</span>
                </li>
              </ul>
              <div class="d-flex justify-content-center">
                <button 
                id="editButton"
                class="btn btn-primary">Edit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
        <!-- /User Card -->
      </div>
      <div class="edit-section" style="display: none;">
        <div class="col-md">
          <div class="card">
            <h5 class="card-header">Edit Profile Bengkel</h5>
            <div class="card-body">
              <form class="needs-validation" novalidate>

                <div class="mb-3">
                  <label class="form-label" for="bs-validation-name">Nama Bengkel</label>
                  <input
                    type="text"
                    class="form-control"
                    name="nama_bengkel"
                    id="bs-validation-name"
                    placeholder="Massukan Nama Bengkel"
                    required />
                
                </div>

                <div class="mb-3">
                  <label class="form-label" for="bs-validation-name">Alamat Bengkel</label>
                  <input
                    type="text"
                    class="form-control"
                    name="alamat_bengkel"
                    id="bs-validation-name"
                    placeholder="Massukan Alamat Bengkel"
                    required />
           
                </div>

                <div class="mb-3">
                  <label class="form-label" for="bs-validation-name">Link Google Maps</label>
                  <input
                    type="text"
                    class="form-control"
                    name="gmaps"
                    id="bs-validation-name"
                    placeholder="Massukan Link Maps Bengkel"
                    required />
          
                </div>
              
                <div class="mb-3">
                  <label class="form-label" for="bs-validation-upload-file">Foto Bengkel</label>
                  <input type="file" class="form-control" id="bs-validation-upload-file" required />
                </div>
                
                <div class="mb-3">
                  <label class="form-label" for="bs-validation-bio">Bio</label>
                  <textarea
                    class="form-control"
                    id="bs-validation-bio"
                    name="bs-validation-bio"
                    rows="3"
                    required></textarea>
                </div>
                
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('profile.com' , ['domain_user' => $domain]) }}"
                    class="btn btn-primary">Cancel</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
        <!-- /Bootstrap Validation -->
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Saat halaman dimuat, tampilkan profil dan sembunyikan form edit
        $(".profile-section").show();
        $(".edit-section").hide();

        // Ketika tombol "Edit" diklik
        $("#editButton").click(function() {
            // Sembunyikan profil dan tampilkan form edit
            $(".profile-section").hide();
            $(".edit-section").show();
        });

        // Misalnya, Anda juga ingin menambahkan tombol "Batal" untuk kembali ke profil
        $("#cancelButton").click(function() {
            // Sembunyikan form edit dan tampilkan profil
            $(".edit-section").hide();
            $(".profile-section").show();
        });
    });
</script>


@endsection