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
                                    <h2>Calendar</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row column1">
                            COMING SOON!
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