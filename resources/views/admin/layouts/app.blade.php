<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title') | Dashboard </title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{ route('customer#index') }}" target="_blank">
                    <img src="{{ asset('admin/images/icon/onlineshoptext.png') }}" alt="ONLINE SHOP Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{ route('auth#dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin#categorylist') }}">
                                <i class="fas fa-list"></i>Category</a>
                        </li>
                        <li>
                            <a href="{{ route('admin#productlist') }}">
                                <i class="fas fa-list"></i>Products</a>
                        </li>
                        <li>
                            <a href="{{ route('admin#orderlist') }}">
                                <i class="fa fa-bars"></i>Orders</a>
                        </li>

                        <li>
                            <a href="{{ route('admin#reviewindex') }}">
                                <i class="fa fa-star"></i>Reviews</a>
                        </li>


                        <li class="has-sub">
                            <a class="js-arrow open" href="#">
                                <i class="fa fa-globe"></i>Region</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list" style="">
                                <li>
                                    <a href="{{ route('admin#countrylist') }}"> <i class="fa fa-map-marker"></i>Countries</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin#statelist') }}"><i class="fas fa-flag"></i> State</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin#townshiplist') }}"><i class="fa fa-building"></i> Township</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="customerList.html">
                                <i class="fas fa-chart-bar"></i>Customers</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if(Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('images/Mavator.png') }}" alt="{{ Auth::user()->name }}" />
                                                @elseif(Auth::user()->gender == 'female')
                                                <img src="{{ asset('images/Favator.png') }}" alt="{{ Auth::user()->name }}" />
                                                @else
                                                <img src="{{ asset('images/avator.png') }}" alt="{{ Auth::user()->name }}" />
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}" />
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if(Auth::user()->image == null)
                                                            @if (Auth::user()->gender == 'male')
                                                            <img src="{{ asset('images/Mavator.png') }}" alt="{{ Auth::user()->name }}" />
                                                            @elseif(Auth::user()->gender == 'female')
                                                            <img src="{{ asset('images/Favator.png') }}" alt="{{ Auth::user()->name }}" />
                                                            @else
                                                            <img src="{{ asset('images/avator.png') }}" alt="{{ Auth::user()->name }}" />
                                                            @endif
                                                        @else
                                                            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}e" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#profile') }}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#list') }}">
                                                        <i class="fa fa-users"></i>Admin List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#passwordchange') }}">
                                                        <i class="zmdi zmdi-lock"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <i class="zmdi zmdi-power"></i><input type="submit" value="Logout" style="background: none;">
                                                </form>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <script>
        // image_input = document.querySelector("#image_input");
        // image_input.onchange = function(e){
        //     if(e.target.files.length>0){
        //         src=URL.createObjectURL(e.target.files[0]);
        //         image = document.querySelector(".image-container img");
        //         image.src= src;
        //     }
        // }

    </script>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/selec') }}t2.min.js">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

</body>
    @yield('scriptsource')
</html>
<!-- end document-->