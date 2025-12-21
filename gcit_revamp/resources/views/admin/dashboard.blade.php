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
    @include('layout.loader')
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            @include('layout.sidebar')
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                @include('layout.topbar')
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

                        <div class="row">
                            {{-- LEFT: STATS --}}
                            <div class="col-lg-5">
                                <div class="row column1">
                                    <div class="col-md-6">
                                        <a href="users">
                                            <div class="full counter_section margin_bottom_30">
                                                <div class="couter_icon">
                                                    <div><i class="fa fa-users dark_blue_color"></i></div>
                                                </div>
                                                <div class="counter_no">
                                                    <div>
                                                        <p class="total_no">{{ $userCount }}</p>
                                                        <p class="head_couter">Users</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="clubs">
                                            <div class="full counter_section margin_bottom_30">
                                                <div class="couter_icon">
                                                    <div><i class="fa fa-clock-o dark_blue_color"></i></div>
                                                </div>
                                                <div class="counter_no">
                                                    <div>
                                                        <p class="total_no">{{ $clubCount }}</p>
                                                        <p class="head_couter">Clubs</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="academics">
                                            <div class="full counter_section margin_bottom_30">
                                                <div class="couter_icon">
                                                    <div><i class="fa fa-book dark_blue_color"></i></div>
                                                </div>
                                                <div class="counter_no">
                                                    <div>
                                                        <p class="total_no">{{ $courseCount }}</p>
                                                        <p class="head_couter">Courses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="academics">
                                            <div class="full counter_section margin_bottom_30">
                                                <div class="couter_icon">
                                                    <div><i class="fa fa-bookmark dark_blue_color"></i></div>
                                                </div>
                                                <div class="counter_no">
                                                    <div>
                                                        <p class="total_no">{{ $moduleCount }}</p>
                                                        <p class="head_couter">Modules</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="row column1">
                                    <div class="col-md-6">
                                        <a href="projects">
                                            <div class="full counter_section margin_bottom_30">
                                                <div class="couter_icon">
                                                    <div><i class="fa fa-folder dark_blue_color"></i></div>
                                                </div>
                                                <div class="counter_no">
                                                    <div>
                                                        <p class="total_no">{{ $projectCount }}</p>
                                                        <p class="head_couter">Projects</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="teams">
                                            <div class="full counter_section margin_bottom_30">
                                                <div class="couter_icon">
                                                    <div><i class="fa fa-graduation-cap dark_blue_color"></i></div>
                                                </div>
                                                <div class="counter_no">
                                                    <div>
                                                        <p class="total_no">{{ $acadTeamCount }}</p>
                                                        <p class="head_couter">Staffs</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="updates">
                                            <div class="full counter_section margin_bottom_30">
                                                <div class="couter_icon">
                                                    <div><i class="fa fa-calendar dark_blue_color"></i></div>
                                                </div>
                                                <div class="counter_no">
                                                    <div>
                                                        <p class="total_no">{{ $events }}</p>
                                                        <p class="head_couter">Events</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="services">
                                            <div class="full counter_section margin_bottom_30">
                                                <div class="couter_icon">
                                                    <div><i class="fa fa-gears dark_blue_color"></i></div>
                                                </div>
                                                <div class="counter_no">
                                                    <div>
                                                        <p class="total_no">{{ $serviceCount }}</p>
                                                        <p class="head_couter">Services</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- RIGHT: ACTION LOGS --}}
                            <div class="col-lg-7">
                                <div class="full margin_bottom_30">
                                    <div class="heading1 margin_0">
                                        <h2>Action Logs</h2>
                                    </div>

                                    <div class="table-responsive-sm" style="width:100%;">
                                        <table class="table w-100">
                                            <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Time</th>
                                                    <th>User</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($logs as $index => $log)
                                                    <tr>
                                                        <td style="max-width: 340px;">{{ $log->description }}</td>
                                                        <td>{{ $log->created_at }}</td>
                                                        <td>{{ $log->causer?->name }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">No logs found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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