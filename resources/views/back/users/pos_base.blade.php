@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Pos Management')
@section('content')
@push('styles')
    <style>
        .user-cart .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .amount-btn {
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            background: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .amount-btn:hover {
            background: linear-gradient(to right, #0056b3, #004085);
            transform: scale(1.05);
        }

        .item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 12px;
            background:rgb(154, 104, 193);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .item img {
            border-radius: 8px;
            margin-bottom: 5px;
        }

    </style>
@endpush
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('back.alert')
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="user-cart">
                    <div class="card">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th class="text-right">Harga</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="row mt-2">
                        <div class="col">Total:</div>
                        <div class="col text-right">
                            <input type="number" value="" name="total" readonly class="form-control total" id="totalInput">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">Dikurangi:</div>
                        <div class="col text-right">
                            <input type="number" value="" name="diskon" class="form-control received diskon" id="diskonInput">
                        </div>
                    </div>                    
                    <div class="row mt-2">
                        <div class="col">Subtotal:</div>
                        <div class="col text-right">
                            <input type="number" value="" name="subtotal" readonly class="form-control received" id="subtotalInput">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">Diterima:</div>
                        <div class="col text-right">
                            <input type="number" value="" name="accept" readonly class="form-control received" id="acceptInput">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col">Return:</div>
                        <div class="col text-right">
                            <input type="number" value="" name="return" readonly class="form-control return" id="returnInput">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-danger btn-block">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">
                                Pay
                            </button>
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    <button type="button" class="amount-btn" value="10000">10.000</button>
                    <button type="button" class="amount-btn" value="15000">15.000</button>
                    <button type="button" class="amount-btn" value="20000">20.000</button>
                    <button type="button" class="amount-btn" value="50000">50.000</button>
                    <button type="button" class="amount-btn" value="100000">100.000</button>

                </div>
            </div>
            <div class="col-md-6 col-lg-8 mb-4">
                <div class="row mb-2">
                    <label for=""> Pilih Kategori </label>
                    <div class="col">
                       @foreach ($category as $cat)
                            <button type="button" class="btn btn-primary btn-block" value="{{ $cat->id }}">
                                <span> {{ $cat->name }}</span>
                            </button>
                       @endforeach
                    </div>
                </div>
                <div class="order-product"
                    style="display: flex;column-gap: 0.5rem;flex-wrap: wrap;row-gap: .5rem;">
                    @foreach ($products as $product)
                        <button type="button" class="item" style="cursor: pointer; border: none; width: 15%; height: 15%;"
                            value="{{ $product->id }}">
                            @if ($product->image)
                                <img src="{{ $product->image ? asset('storage/item/' . $product->image) : asset('image/default_item.png') }}" width="45px" height="45px" alt="test" />
                            @endif
                            <h6 style="margin: 0;">{{ $product->name }}</h6>
                            <span>{{ number_format($product->price, 0 , ',' , '.') }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
    <script>
    $(document).ready(function () {
        function getCarts() {
            $.ajax({
                type: 'get',
                url: "carts",
                dataType: "json",
                success: function (response) {
                    let total = 0;
                    const tbody = $('tbody').empty();
                    
                    $.each(response.carts, function (key, product) {
                        total += product.price * product.quantity;
                        const stockOptions = Array.from({ length: product.stock }, (_, index) => (
                            `<option ${product.quantity == index + 1 ? 'selected' : ''} value="${index + 1}">
                                ${index + 1}
                            </option>`
                        )).join('');

                        tbody.append(`
                            <tr>
                                <td>${product.name}</td>
                                <td class="d-flex">
                                    <select class="form-control qty">${stockOptions}</select>
                                    <input type="hidden" class="cartId" value="${product.id}" />
                                    <button type="button" class="btn btn-danger btn-sm delete" style="font-size: 12px; padding: 5px 5px;" value="${product.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td class="text-right">${formatRupiah(product.quantity * product.price)}</td>
                            </tr>
                        `);
                    });

                    $('.total').val(formatRupiah(total));
                }
            });
        }

        getCarts();

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $(document).on('change keyup', 'input[name="diskon"], input[name="accept"]', function () {
            const total = parseFloat($('input[name="total"]').val().replace(/[^\d]/g, '') || '0');
            const diskon = parseFloat($('input[name="diskon"]').val().replace(/[^\d]/g, '') || '0');
            const subTotal = total - diskon;

            $('input[name="subtotal"]').val(formatRupiah(subTotal));

            if ($(this).attr('name') === 'accept') {
                const received = parseFloat($('input[name="accept"]').val() || '0');
                $('input[name="return"]').val(formatRupiah(Math.max(received - subTotal, 0)));
            } else {
                $('input[name="accept"], input[name="return"]').val('');
            }
        });

        $('.amount-btn').on('click', function () {
            let currentValue = parseInt($('input[name="accept"]').val().replace(/[^\d]/g, '') || '0');
            let addValue = parseInt($(this).val());

            let newValue = currentValue + addValue;
            $('input[name="accept"]').val(newValue).trigger('change');
        });

        $('input[name="accept"]').on('change', function () {
            let formattedValue = formatRupiah($(this).val());
            $(this).val(formattedValue);
        });


        $(document).on('change', '.qty', function () {
            const qty = $(this).val();
            const cartId = $(this).siblings('.cartId').val();

            $.ajax({
                type: 'put',
                url: `carts/${cartId}`,
                data: { qty },
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    if (response.status === 400) alert(response.message);
                    getCarts();
                }
            });
        });

        $(document).on('click', '.delete', function () {
            const cartId = $(this).val();

            $.ajax({
                type: 'delete',
                url: `carts/${cartId}`,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    if (response.status === 400) alert(response.message);
                    getCarts();
                }
            });
        });

        $(document).on('click', '.item', function () {
            const productId = $(this).val();

            $.ajax({
                type: 'post',
                url: "carts",
                data: { productId },
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    if (response.status === 400) alert(response.message);
                    getCarts();
                }
            });
        });
    });

       
    </script>
    
@endpush
