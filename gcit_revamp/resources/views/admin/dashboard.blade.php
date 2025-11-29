<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>GCIT Admin</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/logo/logo1.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/admin/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/colors.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/semantic.min.css') }}" />
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="dashboard"><img class="logo_icon img-responsive"
                                    src="{{ asset('images/logo/logo1.png') }}" alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="logo_section">
                                <a href="dashboard"><img class="img-responsive"
                                        src="{{ asset('images/logo/logo2.png') }}" alt="#" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <ul class="list-unstyled components">
                        <li class="active">
                            <a href="dashboard"><i class="fa fa-dashboard white_color"></i> <span>Dashboard</span></a>
                        </li>
                        <li><a href="projects"><i class="fa fa-folder-open white_color"></i> <span>Projects</span></a>
                        </li>
                        <li>
                            <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-graduation-cap white_color"></i> <span>Student Services</span></a>
                            <ul class="collapse list-unstyled" id="element">
                                <li><a href="admission">> <span>Admission</span></a></li>
                                <li><a href="clubs">> <span>Clubs</span></a></li>
                                <li><a href="ict">> <span>ICT</span></a></li>
                                <li><a href="student-welfare">> <span>Student Welfare</span></a></li>
                            </ul>
                        </li>
                        <li><a href="academics"><i class="fa fa-book white_color"></i> <span>Academics</span></a></li>
                        <li>
                            <a href="teams"><i class="fa fa-users white_color"></i> <span>Teams</span></a>
                        </li>
                        <li>
                            <a href="contact">
                                <i class="fa fa-paper-plane white_color"></i> <span>Contacts</span></a>
                        </li>
                        <li class="active">
                            <a href="#additional_page" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="fa fa-briefcase white_color"></i>
                                <span>Non-Academic</span></a>
                            <ul class="collapse list-unstyled" id="additional_page">
                                <li>
                                    <a href="overview">> <span>Institutional Overview</span></a>
                                </li>
                                <li>
                                    <a href="services">> <span>Other Services</span></a>
                                </li>
                                <li>
                                    <a href="calendar">> <span>Calendar</span></a>
                                </li>
                            </ul>
                        </li>
                        </li>
                        <li><a href="users"><i class="fa fa-user white_color"></i> <span>Users</span></a>
                        </li>
                        <li><a href="updates"><i class="fa fa-calendar white_color"></i> <span>Updates</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                    class="fa fa-bars"></i></button>
                            <div class="right_topbar">
                                <div class="icon_info">
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown"><span
                                                    class="name_user">{{ Auth::user()->name }}</span></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="profile">My Profile</a>
                                                <a class="dropdown-item logout-btn" href="#">
                                                    Log Out
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Dashboard</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row column1">
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30">
                                    <div class="couter_icon">
                                        <div>
                                            <i class="fa fa-users dark_blue_color"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no">{{ $userCount }}</p>
                                            <p class="head_couter">Users</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30">
                                    <div class="couter_icon">
                                        <div>
                                            <i class="fa fa-clock-o dark_blue_color"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no">{{ $clubCount }}</p>
                                            <p class="head_couter">Clubs</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30">
                                    <div class="couter_icon">
                                        <div>
                                            <i class="fa fa-cloud-download dark_blue_color"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no">{{ $courseCount }}</p>
                                            <p class="head_couter">Courses</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30">
                                    <div class="couter_icon">
                                        <div>
                                            <i class="fa fa-comments-o dark_blue_color"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no">{{ $moduleCount }}</p>
                                            <p class="head_couter">Modules</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row column1">
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30">
                                    <div class="couter_icon">
                                        <div>
                                            <i class="fa fa-user dark_blue_color"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no">{{ $projectCount }}</p>
                                            <p class="head_couter">Projects</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30">
                                    <div class="couter_icon">
                                        <div>
                                            <i class="fa fa-clock-o dark_blue_color"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no">{{ $acadTeamCount }}</p>
                                            <p class="head_couter">Academic Staff</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30">
                                    <div class="couter_icon">
                                        <div>
                                            <i class="fa fa-cloud-download dark_blue_color"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no">{{ $nacadTeamCount }}</p>
                                            <p class="head_couter">Non-Academic Staff</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="full counter_section margin_bottom_30">
                                    <div class="couter_icon">
                                        <div>
                                            <i class="fa fa-comments-o dark_blue_color"></i>
                                        </div>
                                    </div>
                                    <div class="counter_no">
                                        <div>
                                            <p class="total_no">{{ $serviceCount }}</p>
                                            <p class="head_couter">Services</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- graph -->
                        <!-- <div class="row column2 graph margin_bottom_30">
                            <div class="col-md-l2 col-lg-12">
                                <div class="white_shd full">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>Extra Area Chart</h2>
                                        </div>
                                    </div>
                                    <div class="full graph_revenue">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="content">
                                                    <div class="area_chart">
                                                        <canvas height="120" id="canvas"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- end graph -->
                        <div class="row column3">
                            <!-- testimonial -->
                            <div class="col-md-6">
                                <div class="dark_bg full margin_bottom_30" style="height: 352px;">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>Teams</h2>
                                        </div>
                                    </div>
                                    <div class="full graph_revenue">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($teams && $teams->count() > 0)
                                                    <div class="content testimonial">
                                                        <div id="testimonial_slider" class="carousel slide"
                                                            data-ride="carousel">
                                                            <!-- Wrapper for carousel items -->
                                                            <div class="carousel-inner">
                                                                @foreach ($teams as $index => $team)
                                                                    <div
                                                                        class="item carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                        <div class="img-box">
                                                                            <img src="{{ asset('storage/' . $team->image) }}"
                                                                                alt="{{ $team->name }}">
                                                                        </div>

                                                                        <p class="testimonial">
                                                                            {{ $team->description }}
                                                                        </p>

                                                                        <p class="overview">
                                                                            <b>{{ $team->name }}</b>
                                                                        </p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- Carousel controls -->
                                                            <a class="carousel-control left carousel-control-prev"
                                                                href="#testimonial_slider" data-slide="prev">
                                                                <i class="fa fa-angle-left"></i>
                                                            </a>
                                                            <a class="carousel-control right carousel-control-next"
                                                                href="#testimonial_slider" data-slide="next">
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mt-5"
                                                        style="color: white; font-size: 20px; text-align:center;">No Teams
                                                        Added Yet</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end testimonial -->
                            <!-- progress bar -->
                            <div class="col-md-6">
                                <div class="dash_blog">
                                    <div class="dash_blog_inner">
                                        <div class="dash_head">
                                            <h3>Updates</h3>
                                        </div>
                                        <div class="task_list_main">
                                            <ul class="task_list">
                                                @if($events && $events->count() > 0)
                                                    @foreach ($events as $update)
                                                        <li>
                                                            <a href="#">{{ $update->name }}</a><br>
                                                            <strong>{{ $update->date }}</strong>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div class="mt-5"
                                                        style="color:#214162; font-size: 20px; text-align:center;">No Events
                                                        Added Yet</div>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('js/admin/jquery.min.js') }}"></script>
        <script src="{{ asset('js/admin/popper.min.js') }}"></script>
        <script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
        <!-- wow animation -->
        <script src="{{ asset('js/admin/animate.js') }}"></script>
        <!-- select country -->
        <script src="{{ asset('js/admin/bootstrap-select.js') }}"></script>
        <!-- owl carousel -->
        <script src="{{ asset('js/admin/owl.carousel.js') }}"></script>
        <!-- chart js -->
        <script src="{{ asset('js/admin/Chart.min.js') }}"></script>
        <script src="{{ asset('js/admin/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('js/admin/utils.js') }}"></script>
        <script src="{{ asset('js/admin/analyser.js') }}"></script>
        <!-- nice scrollbar -->
        <script src="{{ asset('js/admin/perfect-scrollbar.min.js') }}"></script>
        <script>
            var ps = new PerfectScrollbar('#sidebar');
        </script>
        <!-- custom js -->
        <script src="{{ asset('js/admin/custom.js') }}"></script>
        <script src="{{ asset('js/admin/chart_custom_style1.js') }}"></script>
        <script src="{{ asset('js/admin/logout.js') }}"></script>
</body>

</html>