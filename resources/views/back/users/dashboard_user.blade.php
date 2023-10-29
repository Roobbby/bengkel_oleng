@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div id="content" style="display: block;">
        <h4 class="py-3 mb-2"> Welcome {{ auth()->user()->name }} </h4>
        <h4 class="py-3 mb-2">
        Kamu Terdaftar Sebagai {{ auth()->user()->domain->domain_user}}
        Sebagai
        @if (auth()->user()->role == 2)
            User
        @else
            Role Tidak Dikenali
        @endif
        </h4>
    </div>
</div>
@endsection