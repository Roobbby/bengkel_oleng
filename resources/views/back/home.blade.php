@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('content')

    @include('back.alert')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"> Welcome {{ auth()->user()->name }} </h4>
        <h4 class="py-3 mb-4">
            Kamu Terdaftar Sebagai
            @if (auth()->user()->role == 0)
                Super Admin
            @elseif (auth()->user()->role == 1)
                Admin
            @elseif (auth()->user()->role == 2)
                User
            @else
                Role Tidak Dikenali
            @endif
        </h4>
        <h4 class="py-3 mb-4">
            Akun Anda
            @if (auth()->user()->status == 0)
                Belum Aktif Aktifkan Akun Anda terlebih dahulu
                <br>
                <a href="{{ route('profile') }}" class="btn rounded-pill btn-danger waves-effect waves-light">Aktifkan
                    Akun</a>
            @elseif (auth()->user()->status == 1)
                Aktif
            @else
                Status Tidak Dikenali
            @endif
        </h4>

    </div>


@endsection
