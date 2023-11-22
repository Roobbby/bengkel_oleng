@extends('back.auth.layout.auth_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')

@section('content')
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner py-4">
            <!-- Login -->
            <div class="card">
              <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-4 mt-2">
                  <a href="{{ route('haut') }}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                      <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                          fill="#7367F0" />
                        <path
                          opacity="0.06"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                          fill="#161616" />
                        <path
                          opacity="0.06"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                          fill="#161616" />
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                          fill="#7367F0" />
                      </svg>
                    </span>
                    <span class="app-brand-text demo text-body fw-bold ms-1">Bengkel Oleng</span>
                  </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-1 pt-2">Welcome to Bengkel_Oleng! 👋</h4>
                <p class="mb-4">Please sign-in to your account</p>
    
                <form id="formAuthentication" class="mb-3" action="{{ route('actionlogin') }}" method="POST">
                  @if (session('alert') === 'success')
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('alert') === 'error')
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                      type="text"
                      class="form-control"
                      id="email"
                      name="email" required
                      placeholder="Enter your email"
                      autofocus />
                  </div>
                  <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="Password"
                        aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>

                    <a href="/" data-bs-toggle="modal" data-bs-target="#enableOTP">
                      <small>Forgot Password?</small>
                    </a>
                   
                  </div>
                  
                  <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                  </div>
                </form>
    
                <p class="text-center">
                  <span>New on our platform?</span>
                  <a href="{{ route('register.online') }}">
                    <span>Create an account</span>
                  </a>
                </p>
    
                
              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
    </div>
    <div class="modal fade" id="enableOTP" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
              <h3 class="mb-2">Enable One Time Password</h3>
              <p>Verify Your Mobile Number for SMS</p>
            </div>
            <p>Enter your mobile phone number with country code and we will send you a verification code.</p>
            <form action="{{ route('reset.pass') }}" method="POST" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework">
              <div class="col-12 fv-plugins-icon-container">
                <label class="form-label" for="modalEnableOTPPhone">Phone Number</label>
                <div class="input-group has-validation">
                  <span class="input-group-text">IND (+62)</span>
                  <input type="text" 
                  id="modalEnableOTPPhone" 
                  name="telp" 
                  class="form-control phone-number-otp-mask" 
                  placeholder="8*** **** ****">
                </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                  Submit
                </button>
                <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">
                  Cancel
                </button>
              </div>
            <input type="hidden">
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
@endsection
