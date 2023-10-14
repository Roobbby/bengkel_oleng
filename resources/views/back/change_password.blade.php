{{-- tidak terpakai --}}
@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Change Password')


@section('content')
    
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="row">
        <div class="col-md-12">
          <!-- Change Password -->
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
                      class="form-control  @error('old_password') is-invalid @enderror" 
                      type="password" 
                      name="old_password" 
                      id="old_password"
                      placeholder="············"
                      >
                      @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                    <label class="form-label" for="new_password">New Password</label>
                    <div class="input-group input-group-merge has-validation">
                      <input 
                      class="form-control @error('new_password') is-invalid @enderror" 
                      type="password" 
                      id="new_password" 
                      name="new_password" 
                      placeholder="············"
                      autocomplete="off">
                      @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                  </div>

                  <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                    <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                    <div class="input-group input-group-merge has-validation">
                      <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="············"
                      autocomplete="off">
                      <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                  </div>
                  <div class="col-12 mb-4">
                    <h6>Password Requirements:</h6>
                    <ul class="ps-3 mb-0">
                      <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                      <li class="mb-1">At least one lowercase character</li>
                      <li>At least one number, symbol, or whitespace character</li>
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
          <!--/ Change Password -->

          <!-- Two-steps verification -->

          <div class="card mb-4">
            <h5 class="card-header">Two-steps verification</h5>
            <div class="card-body">
              <h5 class="mb-3">Two factor authentication is not enabled yet.</h5>
              <p class="w-75">
                Two-factor authentication adds an additional layer of security to your account by requiring more
                than just a password to log in.
                <a href="javascript:void(0);">Learn more.</a>
              </p>
              <button class="btn btn-primary mt-2 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#enableOTP">
                Enable two-factor authentication
              </button>
            </div>
          </div>

          <!-- Modal -->

          <!-- Enable OTP Modal -->

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

          <!--/ Enable OTP Modal -->

          <!-- /Modal -->

          <!--/ Two-steps verification -->

        </div>
      </div>
    </div>

    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
    
@endsection