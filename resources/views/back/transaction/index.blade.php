@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Transaction List')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        @include('back.alert')
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h3 class="m-0 font-weight-bold text-primary">
                    Data Transaksi
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-transaction" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                <th>Kode Transaksi</th>
                                <th>Name</th>
                                <th>Total Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr data-entry-id="{{ $transaction->id }}">
                        
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $transaction->created_at->format('d-m-Y') }}(
                                    {{ $transaction->created_at->format('h-i-s') }}
                                    )
                                </td>
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td class="text-end">
                                    {{  $transaction->total_price  }}
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form onclick="return confirm('are you sure ? ')" class="d-inline" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
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