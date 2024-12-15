@extends('back.auth.layout.auth_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Register Costumer')

@section('content')
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="#" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                            fill="#7367F0" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                            fill="#161616" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                            fill="#161616" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                            fill="#7367F0" />
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-body fw-bold ms-1">Bengkel Oleng</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">Adventure starts here 🚀</h4>
                        <p class="mb-4">Make your app management easy and fun!</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('register.online.store') }}"
                            method="POST">
                            @include('back.alert')
                            @csrf
                            <input type="hidden" name="role" value=3 readonly>
                            <input type="hidden" name="role" value=1 readonly>
                            <div class="mb-3">
                                <label for="sapaan" class="form-label">Sapaan</label>
                                <select name="sapaan" class="select2 form-select">
                                    <option selected="" disabled="">Pilih Sapaan mu</option>
                                    <option value="Pak">Pak</option>
                                    <option value="Bu">Bu</option>
                                    <option value="Mas">Mas</option>
                                    <option value="Mbak">Mbak</option>
                                    <option value="Kak">Kak</option>
                                    <option value="Dek">Dek</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="panggilan" class="form-label">Panggilan</label>
                                <input type="text" class="form-control" id="panggilan" name="panggilan"
                                    placeholder="Massukan Panggilan" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Massukan Nama" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text">+62</span>
                                    <input type="text" class="form-control phone-number-mask" id="telp"
                                        name="telp" placeholder="Massukan Nomer WhatsApp" autofocus pattern="[0-9]*" />
                                </div>
                                <div id="checkWhatsApp"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Massukan Email" />
                                    <span class="input-group-text">@</span>
                                </div>
                                <div id="checkEmail"></div>
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />

                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password_confirm">Confrim Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirm" class="form-control"
                                        name="password_confirm"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />

                                </div>
                                <div id="password-error" class="text-danger"></div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms" id="acceptTerms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        I agree to
                                        <a href="javascript:void(0);">privacy policy & terms</a>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100" type="submit" id="registerButton">Sign
                                up</button>

                        </form>

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ route('login') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection
@push('script-auth')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Script untuk validasi nomor --}}
    <script>
        document.getElementById('telp').addEventListener('input', function(e) {
            // Menghapus karakter selain angka dari nilai input
            this.value = this.value.replace(/\D/g, '');

            // Validasi nomor seluler WhatsApp
            var inputValue = this.value;
            if (inputValue.startsWith('0') || inputValue.startsWith('6') || inputValue.startsWith('2')) {
                inputValue = inputValue.slice(1);
            }
            // Memperbarui nilai input dengan nomor yang sudah divalidasi
            this.value = inputValue;
        });
    </script>
    {{-- script untuk nomer whatsapp --}}
    <script>
        $(document).ready(function() {
            $('#telp').on('keyup', function() {
                var telp = $(this).val();

                // Hapus pesan jika input kosong
                if (telp === '') {
                    $('#checkWhatsApp').empty();
                    return;
                }

                $.ajax({
                    url: '{{ route('checkWhatsApp') }}',
                    type: 'POST',
                    crossDomain: true,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'telp': telp
                    },
                    success: function(response) {
                        if (response.available) {
                            $('#checkWhatsApp').html(
                                '<p class="text-success">WhatsApp tersedia.</p>');
                        } else {
                            $('#checkWhatsApp').html(
                                '<p class="text-danger">WhatsApp sudah terpakai.</p>');
                        }
                    }
                });
            });
        });
    </script>
    {{-- script untuk Email --}}
    <script>
        $(document).ready(function() {
            $('#email').on('keyup', function() {
                var email = $(this).val();

                // Hapus pesan jika input kosong
                if (email === '') {
                    $('#checkEmail').empty();
                    return;
                }

                $.ajax({
                    url: '{{ route('checkEmail') }}',
                    type: 'POST',
                    crossDomain: true,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'email': email
                    },
                    success: function(response) {
                        if (response.available) {
                            $('#checkEmail').html(
                                '<p class="text-success">Email tersedia.</p>');
                        } else {
                            $('#checkEmail').html(
                                '<p class="text-danger">Email sudah terpakai.</p>');
                        }
                    }
                });
            });
        });
    </script>
    {{-- script untuk validasi checkbox dan submit --}}
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
    {{-- script untuk password dan confrim password --}}
    <script>
        $(document).ready(function() {
            $('#password_confirm').on('input', function() {
                var password = $('#password').val();
                var confirmPassword = $(this).val();
                var errorDiv = $('#password-error');

                if (password === confirmPassword) {
                    errorDiv.text('');
                } else {
                    errorDiv.text('Password Tidak Cocok');
                }
            });
        });
    </script>
@endpush
