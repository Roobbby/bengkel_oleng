@extends('back.auth.layout.auth_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reset Password')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Reset Password -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4 mt-2">
              <a href="" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0"></path>
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0"></path>
                  </svg>
                </span>
                <span class="app-brand-text demo text-body fw-bold ms-1">Bengkel Oleng</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-1 pt-2">Reset Password 🔒</h4>
            <p class="mb-4">for <span class="fw-medium">0{{$user->telp}}</span></p>
            <form 
            class="fv-plugins-bootstrap5 fv-plugins-framework" action="" method="">
            @include('back.alert')
                @csrf 
                <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                    <label class="form-label" for="password">New Password</label>
                    <input type="text" name="telp" value="{{ optional($user)->telp }}" hidden>
                    <div class="input-group input-group-merge has-validation">
                        <input 
                        type="password" 
                        id="password" 
                        class="form-control" 
                        name="password"
                        placeholder="············" 
                        aria-describedby="password">
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                    <label class="form-label" for="confirm-password">Confirm Password</label>
                    <div class="input-group input-group-merge has-validation">
                        <input 
                        type="password" 
                        id="confirm-password" 
                        class="form-control" 
                        name="confirm_password"
                        placeholder="············" 
                        aria-describedby="password">
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <button class="btn btn-primary d-grid w-100 mb-3 waves-effect waves-light">
                    Set new password</button>
                <div class="text-center">
                    <a href="{{ route('login') }}">
                        <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                        Back to login
                    </a>
                </div>
            </form>            
          </div>
        </div>
        <!-- /Reset Password -->
      </div>
    </div>
  </div>
@endsection