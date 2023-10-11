<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/asset/assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/asset/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="/asset/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/asset/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/asset/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/asset/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/asset/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/asset/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/asset/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/asset/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/asset/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="/asset/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->

    <!-- Toastr styles -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <!-- End Toastr styles -->

    <!-- Page -->
    <link rel="stylesheet" href="/asset/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/asset/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/asset/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/asset/assets/js/config.js"></script>
   
  </head>

  <body>  
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Register Card -->
        
            <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-4 mt-2">
                <a href="index.html" class="app-brand-link gap-2">
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

            <div id="registrationForms" >
                <h4 class="mb-1 pt-2"> Register Sebagai </h4>

                <div class="divider my-4">
                    
                    <button id="adminButton" class="btn btn-primary waves-effect waves-light " data-role="admin">
                        <i class="fa-solid fa-user-tie"></i>Admin</button>
                    <button id="userButton" class="btn btn-primary waves-effect waves-light" data-role="user">
                        <i class="fa-solid fa-user"></i>User</button>
        
                
                    </div>
                <p class="mb-4">Make your app management easy and fun!</p>

                
                <form action="{{ route('register.store') }}" method="POST" id="adminForm" style="display: none;">
                    @csrf
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <input type="hidden" name="role" value="{{ $role }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input
                        type="text"
                        class="form-control"
                        name="name" required
                        id="username"
                        value="{{ old('name') }}"
                        placeholder="Enter your Admin name"
                        autofocus />
                        <div id="usernameAvailability"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="email"required
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                            />
                            <span class="input-group-text" id="basic-addon13">@</span>
                            <div id="email-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                        <input
                            type="text"
                            class="form-control"
                            name="password" required
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" 
                            />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terms" id="acceptTerms"/>
                        <label class="form-check-label" for="terms-conditions">
                            I agree to
                            <a href="javascript:void(0);">privacy policy & terms</a>
                        </label>
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100" type="submit" id="registerButton" >Sign up</button>
                    
                    <div class="divider my-1">
                        <div class="divider-text"></div>
                    </div>
                
                    <div class="d-flex justify-content-center">
                    <a href=""  type="submit" data-bs-toggle="modal" data-bs-target="#enableOTP" >
                        <i class="fa-brands fa-whatsapp"></i>
                        <small>Register WhatsApp</small>
                    </a>
                    </div>

                    <div class="divider my-1">
                        <div class="divider-text">or</div>
                    </div>
                
                </form>
                

                <form action="{{ route('register.store') }}" method="POST" id="userForm" style="display: none;">
                    @csrf
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <input type="hidden" name="role" value="{{ $role }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                        type="text"
                        class="form-control"
                        name="name" required
                        id="username"
                        placeholder="Enter your User Name"
                        value="{{ old('name') }}"
                        autofocus />
                        <div id="usernameAvailability"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="email" required
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                            />
                            <span class="input-group-text" id="basic-addon13">@</span>
                            <div id="email-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                        <input
                            type="text"
                            class="form-control"
                            name="password" required
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" 
                            />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terms" />
                        <label class="form-check-label" for="terms-conditions">
                            I agree to
                            <a href="javascript:void(0);">privacy policy & terms</a>
                        </label>
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100">Sign up</button>
                    <div id="error-messages" class="alert alert-danger" style="display: none;"></div>

                </form>
                    <br>
                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{ route('login')}}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                    
            </div>
            </div>
            <!-- Register Card -->
        </div>
        </div>
        </div>
    </div>

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
                    <input type="text" id="modalEnableOTPPhone" name="modalEnableOTPPhone" class="form-control phone-number-otp-mask" placeholder="8*** **** ****">
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
    
    <!-- / Content -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#username').on('keyup', function() {
                var username = $(this).val();

                // Hapus pesan jika input kosong
                if (username === '') {
                    $('#usernameAvailability').empty();
                    return;
                }

                $.ajax({
                    url: '{{ route('checkUsernameAvailability') }}', // Ganti dengan URL yang sesuai
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'username': username
                    }, 
                    success: function(response) {
                        if (response.available) {
                            $('#usernameAvailability').html(
                                '<p class="text-success">Username tersedia.</p>');
                        } else {
                            $('#usernameAvailability').html(
                                '<p class="text-danger">Username sudah terpakai.</p>');
                        }
                    }
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    // Fungsi untuk menampilkan formulir berdasarkan peran
    function showRegistrationForm(role) {
        // Sembunyikan semua formulir
        var adminForm = document.getElementById('adminForm');
        var userForm = document.getElementById('userForm');

        // Inisialisasi variabel roleValue
        var roleValue = '';

            if (role === 'admin') {
                adminForm.style.display = 'block';
                userForm.style.display = 'none';
                roleValue = 1; // role admin
            } else if (role === 'user') {
                adminForm.style.display = 'none';
                userForm.style.display = 'block';
                roleValue = 2; // role user
            }

            // Setel nilai input tersembunyi dengan nama "role" sebagai integer
            document.querySelector('#adminForm input[name="role"]').value = roleValue;
            document.querySelector('#userForm input[name="role"]').value = roleValue;
        }

        // Mengaitkan fungsi dengan tombol Admin dan User
        var adminButton = document.getElementById('adminButton');
        var userButton = document.getElementById('userButton');

        adminButton.addEventListener('click', function () {
            showRegistrationForm('admin'); // Ubah menjadi 'admin'
        });

        userButton.addEventListener('click', function () {
            showRegistrationForm('user'); // Ubah menjadi 'user'
        });
    });


    </script> 

    <script>
        $(document).ready(function() {
            var acceptTermsCheckbox = $('#acceptTerms');
            var registerButton = $('#registerButton');
    
            // Fungsi untuk memeriksa status checkbox
            function checkCheckboxStatus() {
                var isChecked = acceptTermsCheckbox.is(':checked');
                if (isChecked) {
                    registerButton.prop('disabled', false);
                } else {
                    registerButton.prop('disabled', true);
                }
            }
    
            // Panggil fungsi saat halaman dimuat
            checkCheckboxStatus();
    
            // Tambahkan event listener untuk checkbox
            acceptTermsCheckbox.on('change', function() {
                checkCheckboxStatus();
            });
        });
    </script>
    
    <script src="/asset/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/asset/assets/vendor/libs/popper/popper.js"></script>
    <script src="/asset/assets/vendor/js/bootstrap.js"></script>
    <script src="/asset/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/asset/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/asset/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="/asset/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="/asset/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/asset/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/asset/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="/asset/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="/asset/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <!-- Main JS -->
    <script src="/asset/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/asset/assets/js/pages-auth.js"></script>

    <!-- Toastr Script -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
      @if(Session::has('message'))
      var type = "{{ Session::get('alert-type','info') }}"
      switch(type){
      case 'info':
          toastr.info(" {{ Session::get('message') }} ");
          break;

      case 'success':
          toastr.success(" {{ Session::get('message') }} ");
          break;

      case 'warning':
          toastr.warning(" {{ Session::get('message') }} ");
          break;

      case 'error':
          toastr.error(" {{ Session::get('message') }} ");
          break;
      }
      @endif
    </script>
   
    <!-- End Toastr Script -->
  </body>
</html>
    
