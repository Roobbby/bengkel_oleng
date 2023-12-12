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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



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

                                        $uniqueCategories = $product->sortBy('id_category')->unique('id_category');
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
                                    $groupedProducts = $product->groupBy('id_category');
                                @endphp

                                {{-- @foreach ($uniqueCategories as $category)
                                    @foreach ($groupedProducts[$category->id_category] as $item)
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 pb-4"
                                            data-type="{{ $item->id_category }}">
                                            <a href="#" class="pos-product" data-bs-toggle="modal"
                                                data-bs-target="#modalPosItem" data-product-id="{{ $item->id }}">

                                                <div class="img"
                                                    style="background-image: url({{ asset('image/item/' . $item->cover) }})">
                                                </div>
                                                <div class="info">
                                                    <div class="title" id="name">{{ $item->nama_barang }}</div>
                                                    <div class="title">{!! Str::limit($item->deskripsi, 10, '...') !!}</div>
                                                    <div class="price">{{ $item->stok }}</div>
                                                    <div class="price">Rp{{ $item->harga }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endforeach --}}
                                @foreach ($uniqueCategories as $category)
                                    @foreach ($groupedProducts[$category->id_category] as $item)
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 pb-4"
                                            data-type="{{ $item->id_category }}">
                                            <a href="#" class="pos-product" data-product-id="{{ $item->id }}">
                                                <div class="img"
                                                    style="background-image: url({{ asset('image/item/' . $item->cover) }})">
                                                </div>
                                                <div class="info product-name">
                                                    <div class="title">{{ $item->nama_barang }}</div>
                                                    <div class="text">{!! Str::limit($item->deskripsi, 10, '...') !!}</div>
                                                    <div class="stok">{{ $item->stok }}</div>
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

    <!-- END #modalPosItem -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.nav-link').on('click', function() {
            var filterValue = $(this).data('filter');

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
