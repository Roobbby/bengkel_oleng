<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Halaman POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-OSmF5CvqPJX8rSvxfXgLOtMz5jgC+3QWR4CTj2+RFXq4i0yBiZLOL7nJuKAY+fxM" crossorigin="anonymous">


    <link rel="stylesheet" href="/asset/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/asset/assets/vendor/fonts/fontawesome.css" />
    <!-- ================== BEGIN core-css ================== -->
    <link href="asset/assets/css/vendor.min.css" rel="stylesheet">
    <link href="asset/assets/css/app.min.css" rel="stylesheet">
    <!-- ================== END core-css ================== -->


</head>

<body class='pace-top'>
    <!-- BEGIN #app -->
    <div id="app" class="app app-content-full-height app-without-sidebar app-without-header">
        <!-- BEGIN #content -->
        <div id="content" class="app-content p-0">
            <!-- BEGIN pos -->
            <div class="pos pos-with-menu pos-with-sidebar" id="pos">
                <div class="pos-container">
                    <!-- BEGIN pos-menu -->
                    <div class="pos-menu">
                        <!-- BEGIN logo -->
                        <div class="logo">
                            <a href="{{ route('dashboard.user') }}">
                                <div class="logo-img"><i class="fas fa-chevron-circle-left fa-lg"></i></div>
                                <div class="logo-text">Kembali</div>
                            </a>
                        </div>
                        <!-- END logo -->
                        <!-- BEGIN nav-container -->
                        <div class="nav-container">
                            <div class="h-100" data-scrollbar="true" data-skip-mobile="true">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#" data-filter="all">
                                            <i class="fas fa-globe"></i>Semua Product
                                        </a>
                                    </li>
                                    @php
                                        $categoryIcons = [
                                            0 => 'fas fa-car-side',
                                            1 => 'fas fa-wrench',
                                            2 => 'fas fa-tools',
                                        ];

                                        $uniqueCategories = $listproduk->sortBy('id_category')->unique('id_category');
                                    @endphp

                                    @foreach ($uniqueCategories as $category)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"
                                                data-filter="{{ $category->id_category }}">
                                                <i class="{{ $categoryIcons[$category->id_category] }}"></i>
                                                {{ $category->category }}
                                            </a>
                                        </li>
                                    @endforeach



                                </ul>
                            </div>
                        </div>
                        <!-- END nav-container -->
                    </div>
                    <!-- END pos-menu -->

                    <!-- BEGIN pos-content -->
                    <div class="pos-content">
                        <div class="pos-content-container h-100">
                            <div class="row gx-4">
                                @php
                                    $groupedProducts = $listproduk->groupBy('id_category');
                                @endphp

                                @foreach ($uniqueCategories as $category)
                                    @foreach ($groupedProducts[$category->id_category] as $item)
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 pb-4"
                                            data-type="{{ $item->id_category }}">
                                            <a href="#" class="pos-product" data-bs-toggle="modal"
                                                data-bs-target="#modalPosItem" data-product-id="{{ $item->id }}">

                                                <div class="img"
                                                    style="background-image: url({{ asset('image/item/' . $item->cover) }})">
                                                </div>
                                                <div class="info">
                                                    <div class="title">{{ $item->nama_barang }}</div>
                                                    <div class="title">{!! Str::limit($item->deskripsi, 10, '...') !!}</div>
                                                    <div class="price">{{ $item->stok }}</div>
                                                    <div class="price">Rp{{ $item->harga }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
                <!-- END pos-content -->

                <!-- BEGIN pos-sidebar -->
                <div class="pos-sidebar" id="pos-sidebar">
                    <div class="h-100 d-flex flex-column p-0">
                        <!-- BEGIN pos-sidebar-header -->
                        <div class="pos-sidebar-header">
                            <div class="back-btn">
                                <button type="button" data-toggle-class="pos-mobile-sidebar-toggled"
                                    data-toggle-target="#pos" class="btn">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                            </div>
                            <div class="icon"><i class="fa fa-plate-wheat"></i></div>
                            <div class="title">Table 01</div>
                            <div class="order small">Order: <span class="fw-semibold">#0056</span></div>
                        </div>
                        <!-- END pos-sidebar-header -->


                        <!-- BEGIN pos-sidebar-body -->
                        <div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">
                            <!-- BEGIN #newOrderTab -->
                            <div class="tab-pane fade h-100 show active" id="newOrderTab">
                                <!-- BEGIN pos-order -->
                                <div class="pos-order">
                                    <div class="pos-order-product">
                                        <div class="img" style="background-image: url(assets/img/pos/product-2.jpg)">
                                        </div>
                                        <div class="flex-1">
                                            <div class="h6 mb-1">Grill Pork Chop</div>
                                            <div class="small">$12.99</div>
                                            <div class="small mb-2">- size: large</div>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-secondary btn-sm"><i
                                                        class="fa fa-minus"></i></a>
                                                <input type="text"
                                                    class="form-control w-50px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center"
                                                    value="01">
                                                <a href="#" class="btn btn-secondary btn-sm"><i
                                                        class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pos-order-price d-flex flex-column">
                                        <div class="flex-1">$12.99</div>
                                        <div class="text-end">
                                            <a href="#" class="btn btn-default btn-sm"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END pos-order -->
                                <!-- BEGIN pos-order -->

                                <!-- END pos-order -->

                            </div>
                            <!-- END #orderHistoryTab -->

                            <!-- BEGIN #orderHistoryTab -->

                            <!-- END #orderHistoryTab -->
                        </div>
                        <!-- END pos-sidebar-body -->

                        <!-- BEGIN pos-sidebar-footer -->
                        <div class="pos-sidebar-footer">
                            <div class="d-flex align-items-center mb-2">
                                <div>Qyt</div>
                                <div class="flex-1 text-end h6 mb-0">1</div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div>Subtotal</div>
                                <div class="flex-1 text-end h6 mb-0">$30.98</div>
                            </div>

                            <hr class="opacity-1 my-10px">
                            <div class="d-flex align-items-center mb-2">
                                <div>Total</div>
                                <div class="flex-1 text-end h4 mb-0">$33.10</div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex">
                                    <a href="#"
                                        class="btn btn-default w-70px me-10px d-flex align-items-center justify-content-center">
                                        <span>
                                            <i class="fa fa-bell fa-lg my-10px d-block"></i>
                                            <span class="small fw-semibold">Service</span>
                                        </span>
                                    </a>
                                    <a href="#"
                                        class="btn btn-default w-70px me-10px d-flex align-items-center justify-content-center">
                                        <span>
                                            <i class="fa fa-receipt fa-fw fa-lg my-10px d-block"></i>
                                            <span class="small fw-semibold">Bill</span>
                                        </span>
                                    </a>
                                    <a href="#"
                                        class="btn btn-theme flex-fill d-flex align-items-center justify-content-center">
                                        <span>
                                            <i class="fa fa-cash-register fa-lg my-10px d-block"></i>
                                            <span class="small fw-semibold">Submit Order</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END pos-sidebar-footer -->
                    </div>
                </div>
                <!-- END pos-sidebar -->
            </div>
        </div>
        <!-- END pos -->

        <!-- BEGIN pos-mobile-sidebar-toggler -->
        <a href="#" class="pos-mobile-sidebar-toggler" data-toggle-class="pos-mobile-sidebar-toggled"
            data-toggle-target="#pos">
            <i class="fa fa-shopping-bag"></i>
            <span class="badge">5</span>
        </a>
        <!-- END pos-mobile-sidebar-toggler -->
    </div>
    <!-- END #content -->

    <!-- BEGIN theme-panel -->
    <div class="theme-panel">
        <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i
                class="fa fa-cog"></i></a>
        <div class="theme-panel-content">
            <ul class="theme-list clearfix">
                <li><a href="javascript:;" class="bg-red" data-theme="theme-red" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Red" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-pink" data-theme="theme-pink" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Pink" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-orange" data-theme="theme-orange" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Orange" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-yellow" data-theme="theme-yellow" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Yellow" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-lime" data-theme="theme-lime" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Lime" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-green" data-theme="theme-green" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Green" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-teal" data-theme="theme-teal" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Teal" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-cyan" data-theme="theme-cyan" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Aqua" data-original-title="" title="">&nbsp;</a></li>
                <li class="active"><a href="javascript:;" class="bg-blue" data-theme=""
                        data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-container="body" data-bs-title="Default" data-original-title=""
                        title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-purple" data-theme="theme-purple" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Purple" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-indigo" data-theme="theme-indigo" data-click="theme-selector"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                        data-bs-title="Indigo" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-gray-600" data-theme="theme-gray-600"
                        data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-container="body" data-bs-title="Gray" data-original-title=""
                        title="">&nbsp;</a></li>
            </ul>
            <hr class="mb-0">
            <div class="row mt-10px pt-3px">
                <div class="col-9 control-label text-body-emphasis fw-bold">
                    <div>Dark Mode <span class="badge bg-theme text-theme-color ms-1 position-relative py-4px px-6px"
                            style="top: -1px">NEW</span></div>
                    <div class="lh-sm fs-13px fw-semibold">
                        <small class="text-body-emphasis opacity-50">
                            Adjust the appearance to reduce glare and give your eyes a break.
                        </small>
                    </div>
                </div>
                <div class="col-3 d-flex">
                    <div class="form-check form-switch ms-auto mb-0 mt-2px">
                        <input type="checkbox" class="form-check-input" name="app-theme-dark-mode"
                            id="appThemeDarkMode" value="1">
                        <label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END theme-panel -->
    <!-- BEGIN btn-scroll-top -->
    <a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
    <!-- END btn-scroll-top -->
    </div>
    <!-- END #app -->

    <!-- BEGIN #modalPosItem -->
    {{-- <div class="modal modal-pos fade" id="modalPosItem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <a href="#" data-bs-dismiss="modal" class="btn-close position-absolute top-0 end-0 m-4"></a>
                <div class="modal-pos-product">
                    <div class="modal-pos-product-img">
                        <div class="img" style="background-image: url(assets/img/pos/product-1.jpg)"></div>
                    </div>
                    <div class="modal-pos-product-info">
                        <div class="fs-4 fw-semibold">Grill Chicken Chop</div>
                        <div class="text-body text-opacity-50 mb-2">
                            chicken, egg, mushroom, salad
                        </div>
                        <div class="fs-3 fw-bold mb-3">$10.99</div>
                        <div class="d-flex mb-3">
                            <a href="#" class="btn btn-secondary"><i class="fa fa-minus"></i></a>
                            <input type="text" class="form-control w-50px fw-bold mx-2 text-center" name="qty"
                                value="1">
                            <a href="#" class="btn btn-secondary"><i class="fa fa-plus"></i></a>
                        </div>
                        <hr class="opacity-1">
                        <div class="mb-2">
                            <div class="fw-bold">Size:</div>
                            <div class="option-list">
                                <div class="option">
                                    <input type="radio" id="size3" name="size" class="option-input"
                                        checked>
                                    <label class="option-label" for="size3">
                                        <span class="option-text">Small</span>
                                        <span class="option-price">+0.00</span>
                                    </label>
                                </div>
                                <div class="option">
                                    <input type="radio" id="size1" name="size" class="option-input">
                                    <label class="option-label" for="size1">
                                        <span class="option-text">Large</span>
                                        <span class="option-price">+3.00</span>
                                    </label>
                                </div>
                                <div class="option">
                                    <input type="radio" id="size2" name="size" class="option-input">
                                    <label class="option-label" for="size2">
                                        <span class="option-text">Medium</span>
                                        <span class="option-price">+1.50</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="fw-bold">Add On:</div>
                            <div class="option-list">
                                <div class="option">
                                    <input type="checkbox" name="addon[sos]" value="true" class="option-input"
                                        id="addon1">
                                    <label class="option-label" for="addon1">
                                        <span class="option-text">More BBQ sos</span>
                                        <span class="option-price">+0.00</span>
                                    </label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="addon[ff]" value="true" class="option-input"
                                        id="addon2">
                                    <label class="option-label" for="addon2">
                                        <span class="option-text">Extra french fries</span>
                                        <span class="option-price">+1.00</span>
                                    </label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="addon[ms]" value="true" class="option-input"
                                        id="addon3">
                                    <label class="option-label" for="addon3">
                                        <span class="option-text">Mushroom soup</span>
                                        <span class="option-price">+3.50</span>
                                    </label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="addon[ms]" value="true" class="option-input"
                                        id="addon4">
                                    <label class="option-label" for="addon4">
                                        <span class="option-text">Lemon Juice (set)</span>
                                        <span class="option-price">+2.50</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr class="opacity-1">
                        <div class="row">
                            <div class="col-4">
                                <a href="#" class="btn btn-default fw-semibold mb-0 d-block py-3"
                                    data-bs-dismiss="modal">Cancel</a>
                            </div>
                            <div class="col-8">
                                <a href="#"
                                    class="btn btn-theme fw-semibold d-flex justify-content-center align-items-center py-3 m-0">Add
                                    to cart <i class="fa fa-plus ms-2 my-n3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END #modalPosItem -->
    <script>
        $('.nav-link').on('click', function() {
            var filterValue = $(this).data('filter');

        });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
    var handleProductClick = function () {
        $(document).on('click', '.pos-product', function (e) {
            e.preventDefault();

            var productId = $(this).data('product-id');
            var productData = getProductData(productId);

            // Tambahkan data produk ke dalam tabel 01
            appendToTable(productData);
        });
    };

    var getProductData = function (productId) {
        // Logika untuk mendapatkan data produk berdasarkan productId
        // Anda mungkin perlu membuat endpoint di backend untuk mengambil data produk
        // atau menggunakan data yang sudah ada di halaman
        // Misalnya, menggunakan Ajax untuk mengambil data dari server.

        // Contoh penggunaan data yang sudah ada di halaman:
                var getProductData = function (productId) {
            // ... (logika untuk mendapatkan data produk)

            console.log('Product Data:', productData);

            return productData;
        };

        var appendToTable = function (productData) {
            // ... (logika untuk menambahkan data produk ke dalam tabel)

            console.log('Appending to Table:', productData);
        };

        var productElement = $('.pos-content [data-type="' + productId + '"]');
        var productName = productElement.find('.title').text();
        var productDescription = productElement.find('.desc').text();
        var productPrice = productElement.find('.price').text();

        return {
            id: productId,
            name: productName,
            description: productDescription,
            price: productPrice,
        };
    };

    var appendToTable = function (productData) {
        // Logika untuk menambahkan data produk ke dalam tabel 01
        // Buat elemen HTML baru sesuai dengan struktur yang diinginkan
        var newOrderItem = '<div class="pos-order">' +
            '<div class="pos-order-product">' +
            '<div class="img" style="background-image: url(assets/img/pos/product-2.jpg)"></div>' +
            '<div class="flex-1">' +
            '<div class="h6 mb-1">' + productData.name + '</div>' +
            '<div class="small">' + productData.price + '</div>' +
            '<div class="small mb-2">' + productData.description + '</div>' +
            '<div class="d-flex">' +
            '<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></a>' +
            '<input type="text" class="form-control w-50px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center" value="01">' +
            '<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="pos-order-price d-flex flex-column">' +
            '<div class="flex-1">' + productData.price + '</div>' +
            '<div class="text-end">' +
            '<a href="#" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('.pos-sidebar-body #newOrderTab').append(newOrderItem);
    };

    handleProductClick();
});

    </script>
    <!-- ================== BEGIN core-js ================== -->
    <script src="asset/assets/js/vendor.min.js"></script>
    <script src="asset/assets/js/app.min.js"></script>

    <!-- ================== END core-js ================== -->

    <!-- ================== BEGIN page-js ================== -->
    <script src="asset/assets/js/demo/pos-customer-order.demo.js"></script>
    <!-- ================== END page-js ================== -->

</body>

</html>
