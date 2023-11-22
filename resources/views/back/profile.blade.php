@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')
@php
use Carbon\Carbon;

$now = Carbon::now();
$activatedDate = Carbon::parse($profileData->activated_date);
$remainingDays = max($now->diffInDays($activatedDate), 0);
$sisaDays = 30 - max($now->diffInDays($activatedDate), 0);
$percentage = ($remainingDays / 30) * 100; 
@endphp


  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      @include('back.alert')
      <div class="row mb-4">
        <div class="col-xl-5 col-lg-5 col-md-5 order-1 order-md-0">
          <!-- User Card -->
          <div class="card mb-4">
            <h5 class="card-header">Profile Account</h5>
            <div class="card-body">
              <div class="user-avatar-section">
                <div class="d-flex align-items-center flex-column">
                  <img
                    class="img-fluid rounded mb-2 pt-1 mt-4"
                    src="{{ (!empty($profileData->foto_profile)) ? url('image/profile/'.$profileData->foto_profile) : url('image/default-avatar.png') }} " 
                    height="100"
                    width="100"
                    alt="profile"  />
                  <div class="user-info text-center">
                    <h4 class="mb-2">{{ $profileData->name }}</h4>
                    @switch($profileData->role)
                     @case(0)
                      <span class="badge bg-label-info mt-1">
                           Super Admin
                       </span>
                      @break
                      @case(1)
                        <span class="badge bg-label-primary mt-1">
                            Admin
                        </span>
                          @break
                      @case(2)
                        <span class="badge bg-label-danger  mt-1">
                           User
                        </span>
                          @break
                      @default
                          Role Tidak Diketahui
                  @endswitch
                  </div>
                </div>
              </div>
              <p class="mt-4 small text-uppercase text-muted">Details</p>
              <div class="info-container">
                <ul class="list-unstyled">
                 
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Sapaan :</span>
                    <span>{{ $profileData->sapaan }}</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Panggilan :</span>
                    <span>{{ $profileData->panggilan }}</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Email :</span>
                    <span>{{ $profileData->email }}</span>
                  </li>
                    <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Status :</span>
                      @switch($profileData->status)
                          @case(0)
                          <span class="badge bg-label-danger  mt-1">
                              Belum Aktif
                          </span>
                              @break
                          @case(1)
                          <span class="badge bg-label-success  mt-1">
                              Aktif
                          </span>
                              @break
                          @default
                              Belum Terverivikasi
                      @endswitch
                    </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Role :</span>
                    <span>
                      @switch($profileData->role)
                          @case(0)
                              Super Admin
                              @break
                          @case(1)
                              Admin
                              @break
                          @case(2)
                              User
                              @break
                          @case(3)
                              Costumer
                              @break
                          @default
                              Role Tidak Diketahui
                      @endswitch
                    </span>
                  </li>
                 
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">WhatsApp :</span>
                    <span>0{{ $profileData->telp }}</span>
                  </li>

                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Jenis Kelamin :</span>
                    <span>
                      @switch($profileData->gender)
                        @case(0)
                            Laki-Laki
                            @break
                        @case(1)
                            Perempuan
                      @endswitch  
                    </span>
                  </li>
          
                </ul>
                <div class="d-flex justify-content-center">
                  <a
                    href="/"
                    class="btn btn-primary me-3"
                    data-bs-target="#editUser"
                    data-bs-toggle="modal"
                    >Edit</a>
                </div>
              </div>
            </div>
          </div>
          <!-- /User Card -->
        </div>
        <!-- Change Password -->
        <div class="col-xl-7 col-lg-5 col-md-5 order-1 order-md-0">
            <div class="card mb-4">
            
              <h5 class="card-header">Ganti Password</h5>
              <div class="card-body">
                <form method="POST" action="{{ route('update.password') }}"  class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label" for="old_password">Password Lama</label>
                      <div class="input-group input-group-merge has-validation">
                        <input 
                        class="form-control " 
                        type="text" 
                        name="old_password" 
                        id="old_password"
                        placeholder="············"
                        >
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                      <div id="password-feedback"></div>
                    </div>
                  </div>
  
                  <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label" for="new_password">Password Baru</label>
                      <div class="input-group input-group-merge has-validation">
                        <input 
                        class="form-control" 
                        type="text" 
                        id="new_password" 
                        name="new_password" 
                        placeholder="············"
                        autocomplete="off">
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        
                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
  
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label" for="new_password_confirmation">Confirmasi Password Baru</label>
                      <div class="input-group input-group-merge has-validation">
                        <input class="form-control" 
                        type="text" 
                        name="new_password_confirmation" 
                        id="new_password_confirmation" 
                        placeholder="············"
                        autocomplete="off">
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                      <div id="password-error" class="text-danger"></div>
                    </div>
                    <div class="col-12 mb-4">
                      <h6>Password Requirements:</h6>
                      <ul class="ps-3 mb-0">
                        <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                      </ul>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Simpan</button>
                      <button type="reset" class="btn btn-label-secondary waves-effect">Reset</button>
                    </div>
                  </div>
              </form>
              </div>
            </div>
          
          <!--/ Change Password -->
        
        <!-- User Content -->
        {{-- <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

        </div> --}}
        <!--/ User Content -->
        <!-- Subcribe -->
        @if(Auth::user()->role == 2)
        <div class="card mb-4">
          <h5 class="card-header">Berlangganan</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-6 order-1 order-xl-0">
                <div class="mb-2">
                  {{-- <h6 class="mb-1">Your Current Plan is Basic</h6>
                  <p>A simple start for everyone</p> --}}
                </div>
                <div class="mb-2 pt-1">
                  @if ($profileData->expired_date)
                  <h6 class="mb-1">Aktif Hingga {{ Carbon::parse($profileData->expired_date)->format('d - M - Y ') }}</h6>
                      {{-- <p>We will send you a notification upon Subscription expiration</p> --}}
                  {{-- @else
                      <h6 class="mb-1">Subscription date not set</h6>
                      <p>Please set your subscription date</p> --}}
                  @endif
                </div>                          
                
              </div>
              <div class="col-xl-6 order-0 order-xl-0">
                {{-- <div class="alert alert-warning" role="alert">
                  <h5 class="alert-heading mb-2">We need your attention!</h5>
                  <span>Your plan requires update</span>
                </div> --}}
                <div class="plan-statistics">
                  <div class="d-flex justify-content-between">
                    <h6 class="mb-1">Hari Ke-</h6>
                    <h6 class="mb-1">{{ $remainingDays }} Dari 30 Hari</h6>
                  </div>
                  <div class="progress mb-1" style="height: 10px">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p>{{ $sisaDays }} Hari Sebelum Massa Berlaku Habis</p>
                </div>
              </div>
              {{-- <div class="col-12 order-2 order-xl-0 d-flex flex-wrap gap-2">
                <button class="btn btn-primary me-2 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#upgradePlanModal">
                  Upgrade Plan
                </button>
                <button class="btn btn-label-danger cancel-subscription waves-effect">Cancel Subscription</button>
              </div> --}}
            </div>
          </div>
        </div>
        @endif
          <!-- /Subcribe -->
      </div>
    </div>

      <!-- Modal -->
      <!-- Edit User Modal -->
      <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3 class="mb-2">Edit User Information</h3>
                <p class="text-muted">Updating user details will receive a privacy audit.</p>
              </div>
              <form method="POST" action="{{ route('profile.store')}}" id="editUserForm" class="row g-3" enctype="multipart/form-data">
                @csrf
                 <div class="card-body">
                   <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <label for=""></label>
                      <img src="{{ (!empty($profileData->foto_profile)) ? url('image/profile/'.$profileData->foto_profile) : url('image/default-avatar.png') }}" alt="profile" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                              <span class="d-none d-sm-block">Upload new photo</span>
                              <i class="ti ti-upload d-block d-sm-none"></i>
                          </label>
                          <input type="file" id="upload" class="account-file-input" name="foto_profile" hidden="" accept="image/png, image/jpeg, image/jpg, image/gif, image/svg+xml">
                          <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                        </div>
                    </div>
                  </div>
                <div class="col-12">
                  <label class="form-label" >Sapaan</label>
                  <input
                    type="text"
                    id="modalEditUserName"
                    name="sapaan"
                    class="form-control"
                    value="{{ $profileData->sapaan }}"
                    placeholder="john.doe.007" />
                </div>
                <div class="col-12">
                  <label class="form-label" >Panggilan</label>
                  <input
                    type="text"
                    id="modalEditUserName"
                    name="panggilan"
                    class="form-control"
                    value="{{ $profileData->panggilan }}"
                    placeholder="john.doe.007" />
                </div>
                <div class="col-12">
                  <label class="form-label">Name</label>
                  <input
                    type="text"
                    id="modalEditName"
                    name="name"
                    class="form-control"
                    value="{{ $profileData->name }}"
                    placeholder="john.doe.007" />
                </div>
                <div class="col-12">
                  <label class="form-label">Email</label>
                  <input
                    type="text"
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ $profileData->email }}"
                    placeholder="john.doe.007" />
                    <div id="checksEmail"></div>
                </div>
             
                <div class="col-12 col-md-6">
                  <label class="form-label">Gender</label>
                  <select
                    id="modalEditGender"
                    name="gender"
                    class="select2 form-select"
                    >
                    <option selected="" disabled="">Select Gender</option>
                    <option value="0" {{ $profileData->gender == '0' ? 'selected' : ''}}>Laki-Laki</option>
                    <option value="1" {{ $profileData->gender == '1' ? 'selected' : ''}}>Perempuan</option>
                  </select>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">WhatsApp</label>
                  <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input
                      type="text"
                      id="telp"
                      name="telp"
                      class="form-control phone-number-mask"
                      value="{{ $profileData->telp }}"
                      placeholder=" " 
                      pattern="[0-9]*"/>
                  </div>
                    <div id="checksWhatsApp"></div>
                </div>
                </div>
               
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--/ Edit User Modal -->


      <!-- /Modal -->
    </div>
    <!-- / Content -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#old_password').on('input', function() {
              var oldPassword = $(this).val();
  
              // Buat permintaan Ajax untuk memeriksa kata sandi lama
              $.ajax({
                  url: '{{ route('check.old_password') }}',
                  type: 'POST',
                  data: {
                      '_token': '{{ csrf_token() }}',
                      'old_password': oldPassword
                  },
                  success: function(response) {
                      if (response.valid) {
                          $('#password-feedback').html('<p class="text-success">Password lama benar.</p>');
                      } else {
                          $('#password-feedback').html('<p class="text-danger">Password lama salah.</p>');
                      }
                  }
              });
          });
      });
    </script>
  
    <script type="text/javascript">
        $(document).ready(function(){
            $('#upload').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#uploadedAvatar').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script>
      $(document).ready(function() {
          $('#new_password_confirmation').on('input', function() {
              var new_password = $('#new_password').val();
              var confirmPassword = $(this).val();
              var errorDiv = $('#password-error');
      
              if (new_password === confirmPassword) {
                  errorDiv.text(''); 
              } else {
                  errorDiv.text('Password Tidak Cocok');
              }
          });
      });
    </script>
     {{-- script untuk nomer whatsapp --}}
     <script>
        $(document).ready(function() {
            $('#telp').on('keyup', function() {
                var telp = $(this).val();

                // Hapus pesan jika input kosong
                if (telp === '') {
                    $('#checksWhatsApp').empty();
                    return;
                }

                $.ajax({
                    url: '{{ route('checksWhatsApp') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'telp': telp
                    }, 
                    success: function(response) {
                        if (response.available) {
                            $('#checksWhatsApp').html(
                                '<p class="text-success">WhatsApp tersedia.</p>');
                        } else {
                            $('#checksWhatsApp').html(
                                '<p class="text-danger">WhatsApp sudah terpakai.</p>');
                        }
                    }
                });
            });
        });
    </script>
     {{-- Script untuk validasi nomor --}}
      <script>
        document.getElementById('telp').addEventListener('input', function(e) {
            // Menghapus karakter selain angka dari nilai input
            this.value = this.value.replace(/\D/g, '');

            // Validasi nomor seluler WhatsApp
            var inputValue = this.value;
            if (inputValue.startsWith('0') || inputValue.startsWith('6') || inputValue.startsWith('2'))  {
                inputValue = inputValue.slice(1);
            }

            // Memperbarui nilai input dengan nomor yang sudah divalidasi
            this.value = inputValue;
        });
      </script>
      {{-- script untuk Email --}}
      <script>
        $(document).ready(function() {
            $('#email').on('keyup', function() {
                var email = $(this).val();

                // Hapus pesan jika input kosong
                if (email === '') {
                    $('#checksEmail').empty();
                    return;
                }

                $.ajax({
                    url: '{{ route('checksEmail') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'email': email
                    }, 
                    success: function(response) {
                        if (response.available) {
                            $('#checksEmail').html(
                                '<p class="text-success">Email tersedia.</p>');
                        } else {
                            $('#checksEmail').html(
                                '<p class="text-danger">Email sudah terpakai.</p>');
                        }
                    }
                });
            });
        });
    </script>

@endsection