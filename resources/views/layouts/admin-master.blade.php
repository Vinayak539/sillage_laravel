<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') || SILLAGE</title>

    <!-- Favicon -->

    <link rel="apple-touch-icon" sizes="57x57" href="{!! asset('assets/img/logo/favicon/apple-icon-57x57.png') !!}">
    <link rel="apple-touch-icon" sizes="60x60" href="{!! asset('assets/img/logo/favicon/apple-icon-60x60.png') !!}">
    <link rel="apple-touch-icon" sizes="72x72" href="{!! asset('assets/img/logo/favicon/apple-icon-72x72.png') !!}">
    <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('assets/img/logo/favicon/apple-icon-76x76.png') !!}">
    <link rel="apple-touch-icon" sizes="114x114" href="{!! asset('assets/img/logo/favicon/apple-icon-114x114.png') !!}">
    <link rel="apple-touch-icon" sizes="120x120" href="{!! asset('assets/img/logo/favicon/apple-icon-120x120.png') !!}">
    <link rel="apple-touch-icon" sizes="144x144" href="{!! asset('assets/img/logo/favicon/apple-icon-144x144.png') !!}">
    <link rel="apple-touch-icon" sizes="152x152" href="{!! asset('assets/img/logo/favicon/apple-icon-152x152.png') !!}">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! asset('assets/img/logo/favicon/apple-icon-180x180.png') !!}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{!! asset('assets/img/logo/favicon/android-icon-192x192.png') !!}">
    <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('assets/img/logo/favicon/favicon-32x32.png') !!}">
    <link rel="icon" type="image/png" sizes="96x96" href="{!! asset('assets/img/logo/favicon/favicon-96x96.png') !!}">
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('assets/img/logo/favicon/favicon-16x16.png') !!}">
    <link rel="manifest" href="{!! asset('assets/img/logo/favicon/manifest.json') !!}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{!! asset('assets/img/logo/favicon/ms-icon-144x144.png') !!}">
    <meta name="theme-color" content="#ffffff">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{!! asset('admin/css/app.min.css') !!}">

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{!! asset('admin/css/custom.css') !!}">
    <link rel='shortcut icon' type='image/x-icon' href="{!! asset('admin/img/favicon.ico') !!}" />
    <link rel="stylesheet" href="{!! asset('admin/bundles/select2/dist/css/select2.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/bundles/bootstrap-daterangepicker/daterangepicker.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/bundles/chocolat/dist/css/chocolat.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/css/components.css') !!}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="{!! asset('admin/bundles/summernote/summernote-bs4.css') !!}">
    
    @notifyCss
    @yield('extracss')
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    @if(auth('admin')->check())
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if (auth('admin')->user()->image_url)
                            <img alt="{{ auth('admin')->user()->name }}"
                                src="/storage/images/admins/{{ auth('admin')->user()->image_url }}"
                                class="user-img-radious-style">
                            <span class="d-sm-none d-lg-inline-block"></span>
                            @else
                            <img alt="Profile Photo" src="/admin/img/admin2.png" class="user-img-radious-style">
                            <span class="d-sm-none d-lg-inline-block"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello {{ auth('admin')->user()->name }}</div>
                            <a href="/adsillage753/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/adsillage753">
                            <img alt="SILLAGE-NICHE" src="/admin/img/logo1.png" class="header-logo" /> 
                            <!-- <span class="logo-name">SILLAGE</span> -->
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Manage Menu</li>
                        <li class="dropdown">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                                    data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown">
                                <i data-feather="layers"></i><span>Main catalogue</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('admin.categories.all') }}">Categories</a></li>
                                <li><a class="nav-link" href="{{ route('admin.brands.all') }}">Brands</a></li>
                                <li><a class="nav-link" href="{{ route('admin.colors.all') }}">Colours</a></li>
                                <li><a class="nav-link" href="{{ route('admin.materials.all') }}">Materials</a></li>
                                <li><a class="nav-link" href="{{ route('admin.units.all') }}">Units</a></li>
                                <li><a class="nav-link" href="{{ route('admin.conditions.all') }}">Conditions</a></li>
                                <li><a class="nav-link" href="{{ route('admin.gsts.all') }}">GST</a></li>
                                <li><a class="nav-link" href="{{ route('admin.sizes.all') }}">Sizes</a></li>
                                <li><a class="nav-link" href="{{ route('admin.warranties.all') }}">Warranties</a></li>
                                <li><a class="nav-link" href="{{ route('admin.sections.all') }}">Sections</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown">
                                <i data-feather="smartphone"></i><span>Orders</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('admin.orders.all') }}">Search Order</a></li>
                                <li><a class="nav-link" href="{{ route('admin.invoices.all') }}">Manage Invoice</a></li>
                                <li><a class="nav-link" href="{{ route('admin.reports.all') }}">Manage Reports</a></li>

                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.products.all') }}" class="nav-link"><i
                                    data-feather="smartphone"></i><span>Products</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.users.all') }}" class="nav-link"><i
                                    data-feather="users"></i><span>Users</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.sliders.all') }}" class="nav-link"><i
                                    data-feather="link-2"></i><span>Slider</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.home-offer-sliders.all') }}" class="nav-link"><i
                                    data-feather="monitor"></i><span>Home Offer Slider</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.reviews.all') }}" class="nav-link"><i
                                    data-feather="star"></i><span>Reviews</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.enquiries.all') }}" class="nav-link"><i
                                    data-feather="mail"></i><span>Enquiries</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.bulks.all') }}" class="nav-link"><i
                                    data-feather="mail"></i><span>Bulk Order</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.faqs.all') }}" class="nav-link"><i
                                    data-feather="message-square"></i><span>FAQ's</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.pages.all') }}" class="nav-link"><i
                                    data-feather="layout"></i><span>Pages</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.blogs.all') }}" class="nav-link"><i
                                    data-feather="image"></i><span>Blogs</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.subscribers.all') }}" class="nav-link"><i
                                    data-feather="users"></i><span>Subscribers</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.shops.all') }}" class="nav-link"><i
                                    data-feather="home"></i><span>Shops</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.offers.all') }}" class="nav-link">
                                <i data-feather="gift"></i>
                                <span>Offers</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.tickets.all') }}" class="nav-link">
                                <i data-feather="credit-card"></i>
                                <span>Raise Tickets</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('admin.return-tickets.all') }}" class="nav-link">
                                <i data-feather="credit-card"></i>
                                <span>Return & Refund Tickets</span>
                            </a>
                        </li>

                    </ul>

                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')

                <div class="settingSidebar">
                    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                    </a>
                    <div class="settingSidebar-body ps-container ps-theme-default">
                        <div class=" fade show active">
                            <div class="setting-panel-header">Setting Panel
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Select Layout</h6>
                                <div class="selectgroup layout-color w-50">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="1"
                                            class="selectgroup-input-radio select-layout" checked>
                                        <span class="selectgroup-button">Light</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="2"
                                            class="selectgroup-input-radio select-layout">
                                        <span class="selectgroup-button">Dark</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                <div class="selectgroup selectgroup-pills sidebar-color">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="1"
                                            class="selectgroup-input select-sidebar">
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-src-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="2"
                                            class="selectgroup-input select-sidebar" checked>
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-src-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Color Theme</h6>
                                <div class="theme-setting-options">
                                    <ul class="choose-theme list-unstyled mb-0">
                                        <li title="white" class="active">
                                            <div class="white"></div>
                                        </li>
                                        <li title="cyan">
                                            <div class="cyan"></div>
                                        </li>
                                        <li title="black">
                                            <div class="black"></div>
                                        </li>
                                        <li title="purple">
                                            <div class="purple"></div>
                                        </li>
                                        <li title="orange">
                                            <div class="orange"></div>
                                        </li>
                                        <li title="green">
                                            <div class="green"></div>
                                        </li>
                                        <li title="red">
                                            <div class="red"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="mini_sidebar_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Mini Sidebar</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="sticky_header_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Sticky Header</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                    <i class="fas fa-undo"></i> Restore Default
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="main-footer bg-dark">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') == '2021' ? '2021' : '2021 - ' . date('Y') }}
                    <div class="bullet"></div> SILLAGE - Designed & Developed By <a
                        href="https://www.sanjaresolutions.com" target="_blank">Sanjar E Solutions</a>
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{!! asset('admin/js/app.min.js') !!}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
    <!-- JS Libraies -->
    <!-- Template JS File -->
    <!-- Custom JS File -->
    <script src="{!! asset('admin/js/custom.js') !!}"></script>
    <script src="{!! asset('admin/js/jquery.validate.min.js') !!}"></script>
    <script src="{!! asset('admin/bundles/select2/dist/js/select2.full.min.js') !!}"></script>
    <script src="{!! asset('admin/js/scripts.js') !!}"></script>
    <script src="{!! asset('admin/bundles/bootstrap-daterangepicker/daterangepicker.js') !!}"></script>
    <script src="{!! asset('assets/js/jquery.lazyload.js') !!}"></script>
    <script src="{!! asset('admin/bundles/summernote/summernote-bs4.js') !!}"></script>

    <script>
        $(document).ready(function () {

            $(".lazy").Lazy({
                effect: 'fadeIn',
                visibleOnly: true,
            });
        });

    </script>
    @yield('extrajs')
    @include('notify::messages')
    @notifyJs
</body>

</html>