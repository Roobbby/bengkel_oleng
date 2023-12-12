@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Category')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">


    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-2">
                    <h1 class="h3 mb-0">{{ __('edit category')}}</h1>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @include('back.alert')
                    @method('put')
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-2">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
