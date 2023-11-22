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
          @include('back.alert')
          @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Sapaan</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"
                ><i class="ti ti-user-question"></i
              ></span>
                  <select
                    name="sapaan"
                    class="select2 form-select"
                    >
                    <option selected="" disabled="">Pilih Sapaan mu</option>
                    <option value="Pak">Pak</option>
                    <option value="Bu">Bu</option>
                    <option value="Mas">Mas</option>
                    <option value="Mbak">Mbak</option>
                    <option value="Kak">Kak</option>
                    <option value="Dek">Dek</option>
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
                name="panggilan"
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
                placeholder="Massukan Nama"
                aria-label="Massukan Nama"
                aria-describedby="basic-icon-default-fullname2"
                required/>
            </div>
          </div>
            
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-fullname">No Whatsapp</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"
                >+62</span>
              <input
                type="text"
                class="form-control"
                id="telp"
                name="telp"
                placeholder="Massukan Nomer Whatsapp"
                aria-label="Massukan Whatsapp"
                aria-describedby="basic-icon-default-fullname2"
                pattern="[0-9]*"
                required/>
            </div>
            <div id="checkWhatsApp"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">@</span>
              <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                placeholder="Email"
                aria-label="Email"
                aria-describedby="basic-icon-default-email2"
                required />
            </div>
            <div id="checkEmail"></div>
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
          <input type="hidden" name="status" value=0 readonly>
          <div>
            <button type="submit" class="btn rounded-pill btn-primary waves-effect waves-light">Tambah</button>
            
            <a href="{{ route('manage.user') }}" class="btn rounded-pill btn-danger waves-effect waves-light">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        $('#checkEmail').empty();
                        return;
                    }
    
                    $.ajax({
                        url: '{{ route('checkEmail') }}',
                        type: 'POST',
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
  @endsection