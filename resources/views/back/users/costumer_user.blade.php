@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Data Costumer')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        @include('back.alert')
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h3 class="m-0 font-weight-bold text-primary">
                    Data Costumers
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-transaction" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $datas)
                            <tr data-entry-id="{{ $datas->id }}">
                        
                                <td>{{ $loop->iteration }}</td>
                   
                                <td>{{ $datas->name }}</td>
                          
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form onclick="return confirm('are you sure ? ')" class="d-inline" action="" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                            </tr>
                            @endforelse      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    
@endpush