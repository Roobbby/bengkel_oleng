@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Transaction Details')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    @include('back.alert')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('transactions.index') }}" class="btn btn-dark float-right">
                    <span class="text">{{ __('Go Back') }}</span>
                </a>
            </h6>
        </div>
        <div class="card-body">
            <div class="card-responsive">
                <table class="table mt-3 table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Product</th>
                            <th>Quantity</th>
                            <th>Harga Awal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaction->transaction_details as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ number_format($item->base_price, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->base_total, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Order item not found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <h3>Total : {{ number_format($transaction->total_price, 0, ',' , '.') }}</h3>
            <button class="btn btn-success">Print</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush