@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Pos Management')
@section('content')

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
                            <input type="number" value="" name="accept" class="form-control received" id="acceptInput">
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
                            <button type="button" value="{{ $cat->id }}">
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
                                <img src="image/item/{{ $product->image }}" width="45px" height="45px" alt="test" />
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
    $(document).ready(function() {
        function getCarts() {
                $.ajax({
                    type: 'get',
                    url: "carts",
                    dataType: "json",
                    success: function(response) {
                        let total = 0;
                        $('tbody').html("");
                        $.each(response.carts, function(key, product) {
                            total += product.price * product.quantity
                            $('tbody').append(`
                            <tr>
                                <td>${product.name}</td>
                                <td class="d-flex">
                                <select class="form-control qty">
                                    ${Array.from({ length: product.stock }, (_, index) => (
                                        `<option ${product.quantity == index + 1 ? 'selected' : ''} value="${index + 1}">
                                            ${index + 1}
                                        </option>`
                                    )).join('')}
                                </select>
                                
                                <input type="hidden" class="cartId" value="${product.id}" />
                                <button type="button" class="btn btn-danger btn-sm delete" style="font-size: 12px; padding: 5px 5px;" value="${product.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                </td>
                                
                            <td class="text-right">
                                ${product.quantity * product.price}
                            </td>
                            </tr>
                            `)
                        });

                        const test = $('.total').attr('value', `${total}`);
                    }
                })
            }

            getCarts()

            $(document).on('change', 'input[name="total"], input[name="diskon"], input[name="accept"]', function() {
                const total = parseFloat($('input[name="total"]').val()) || 0;
                const diskon = parseFloat($('input[name="diskon"]').val()) || 0;
                const subTotal = total - diskon;

                $('input[name="subtotal"]').val(formatRupiah(subTotal));

                if ($(this).attr('name') === 'accept') {
                    const received = parseFloat($('input[name="accept"]').val());

                    let change = Math.max(received - subTotal, 0);

                    $('input[name="return"]').val(formatRupiah(change));
                } else {
                    $('input[name="accept"]').val(formatRupiah('')).trigger('change');
                    $('input[name="return"]').val(formatRupiah(''));
                }
            });

        // Fungsi untuk mengubah angka menjadi format rupiah
        function formatRupiah(angka) {
        var number_string = angka.toString().replace(/[^0-9]/g, ''),
            split = number_string.split('.'),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + '.' + split[1] : rupiah;
        return rupiah;
        }


        $(document).ready(function () {
            $('.amount-btn').on('click', function () {

                var amountValue = $(this).val();
                
                $('input[name="accept"]').val(amountValue).trigger('change');
            });
        });


        $(document).on('change', '.qty', function() {
            const qty = $(this).val();
            const cartId = $(this).closest('td').find('.cartId').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'put',
                url: `carts/${cartId}`,
                data: {
                    qty
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 400) {
                        alert(response.message);
                    }
                    getCarts()
                }
            })
        })

        $(document).on('click', '.delete', function() {
                const cartId = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'delete',
                    url: `carts/${cartId}`,
                    success: function(response) {
                        if (response.status === 400) {
                            alert(response.message);
                        }
                        getCarts()
                    }
                })
            })

            $(document).on('click', '.item', function() {
                const productId = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    url: `carts`,
                    data: {
                        productId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 400) {
                            alert(response.message);
                        }
                        getCarts()
                    }
                })

            })
        })
       
    </script>
    
@endpush
