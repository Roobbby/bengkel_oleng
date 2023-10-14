@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
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
                    src="{{ (!empty($profileData->foto)) ? url('image/profile/'.$profileData->foto) : url('image/default-avatar.png') }} " 
                    height="100"
                    width="100"
                    alt="profile"  />
                  <div class="user-info text-center">
                    <h4 class="mb-2">{{ $profileData->name }}</h4>
                    <span class="badge bg-label-secondary mt-1">
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
                            @default
                                Role Tidak Diketahui
                        @endswitch
                    </span>
                  </div>
                </div>
              </div>
              <p class="mt-4 small text-uppercase text-muted">Details</p>
              <div class="info-container">
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <span class="fw-medium me-1">Username:</span>
                    <span>{{ $profileData->username }}</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Email :</span>
                    <span>{{ $profileData->email }}</span>
                  </li>
                    <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Status :</span>
                    <span class="badge bg-label-success">
                        @switch($profileData->status)
                            @case(0)
                                Belum Aktif
                                @break
                            @case(1)
                                Aktif
                                @break
                            @default
                                Belum Terverivikasi
                        @endswitch
                    </span>
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
                            @default
                                Role Tidak Diketahui
                        @endswitch
                    </span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Gender :</span>
                    <span>{{ $profileData->gender }}</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Contact :</span>
                    <span>{{ $profileData->telp }}</span>
                  </li>
                  <li class="pt-1">
                    <span class="fw-medium me-1">Alamat :</span>
                    <span>{{ $profileData->alamat }}</span>
                  </li>
                </ul>
                <div class="d-flex justify-content-center">
                  <a
                    href="javascript:;"
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
              <h5 class="card-header">Change Password</h5>
              <div class="card-body">
                <form method="POST" action="{{ route('update.password') }}"  class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label" for="old_password">Current Password</label>
                      <div class="input-group input-group-merge has-validation">
                        <input 
                        class="form-control @error('old_password') is-invalid @enderror " 
                        type="text" 
                        name="old_password" 
                        id="old_password"
                        placeholder="············"
                        >
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        @error('old_password')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                  </div>
  
                  <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label" for="new_password">New Password</label>
                      <div class="input-group input-group-merge has-validation">
                        <input 
                        class="form-control @error('new_password') is-invalid @enderror" 
                        type="text" 
                        id="new_password" 
                        name="new_password" 
                        placeholder="············"
                        autocomplete="off">
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        @error('new_password')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
  
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                      <div class="input-group input-group-merge has-validation">
                        <input class="form-control" 
                        type="text" 
                        name="new_password_confirmation" 
                        id="new_password_confirmation" 
                        placeholder="············"
                        autocomplete="off">
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-12 mb-4">
                      <h6>Password Requirements:</h6>
                      <ul class="ps-3 mb-0">
                        <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                      </ul>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
                      <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                    </div>
                  </div>
              </form>
              </div>
            </div>
          <div class="card mb-4">
            <h5 class="card-header">Two-steps verification</h5>
            <div class="card-body">
              <h5 class="mb-3">Two factor authentication is not enabled yet.</h5>
              <p class="w-75">
                Two-factor authentication
                <a href="javascript:void(0);">Learn more.</a>
              </p>
              <button class="btn btn-primary mt-2 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#enableOTP">
                Enable two-factor authentication
              </button>
            </div>
          </div>
          <!--/ Change Password -->
        </div>

        <!-- User Content -->
        {{-- <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

        </div> --}}
        <!--/ User Content -->
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
                      <img src="{{ (!empty($profileData->foto)) ? url('image/profile/'.$profileData->foto) : url('image/default-avatar.png') }}" alt="profile" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                              <span class="d-none d-sm-block">Upload new photo</span>
                              <i class="ti ti-upload d-block d-sm-none"></i>
                          </label>
                          <input type="file" id="upload" class="account-file-input" name="foto" hidden="" accept="image/png, image/jpeg, image/jpg, image/gif, image/svg+xml">
                          <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                        </div>
                   </div>
                </div>
                <div class="col-12">
                  <label class="form-label" for="modalEditUserName">Username</label>
                  <input
                    type="text"
                    id="modalEditUserName"
                    name="username"
                    class="form-control"
                    value="{{ $profileData->username }}"
                    placeholder="john.doe.007" />
                </div>
                <div class="col-12">
                  <label class="form-label" for="modalEditName">Name</label>
                  <input
                    type="text"
                    id="modalEditName"
                    name="name"
                    class="form-control"
                    value="{{ $profileData->name }}"
                    placeholder="john.doe.007" />
                </div>
                <div class="col-12">
                  <label class="form-label" for="modalEditEmail">Email</label>
                  <input
                    type="text"
                    id="modalEditEmail"
                    name="email"
                    class="form-control"
                    value="{{ $profileData->email }}"
                    placeholder="john.doe.007" />
                </div>
                {{-- //option Value
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditGender">Gender</label>
                  <select
                    id="modalEditGender"
                    name="gender"
                    class="select2 form-select"
                    >
                    <option selected="" disabled="">Select Gender</option>
                    <option value="laki-laki" {{ $profileData->gender == 'laki-laki' ? 'selected' : ''}}>Laki-Laki</option>
                    <option value="perempuan" {{ $profileData->gender == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
                  </select>
                </div> --}}
                <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                  <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input
                      type="text"
                      id="modalEditUserPhone"
                      name="telp"
                      class="form-control phone-number-mask"
                      value="{{ $profileData->telp }}"
                      placeholder=" " />
                  </div>
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

      <!-- Add New Credit Card Modal -->
      <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3 class="mb-2">Enable One Time Password</h3>
                <p>Verify Your Mobile Number for SMS</p>
              </div>
              <p>
                Enter your mobile phone number with country code and we will send you a verification code.
              </p>
              <form id="enableOTPForm" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
                <div class="col-12 fv-plugins-icon-container">
                  <label class="form-label" for="modalEnableOTPPhone">Phone Number</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text">IND (+62)</span>
                    <input type="text" id="modalEnableOTPPhone" name="modalEnableOTPPhone" class="form-control phone-number-otp-mask" placeholder="08** **** ****">
                  </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
                  <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">
                    Cancel
                  </button>
                </div>
              <input type="hidden"></form>
            </div>
          </div>
        </div>
      </div>
      <!--/ Add New Credit Card Modal -->

      <!-- /Modal -->
    </div>
    <!-- / Content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
@endsection