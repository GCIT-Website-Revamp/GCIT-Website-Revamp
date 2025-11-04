<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
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

<body class="inner_page widgets">
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="index.html"><img class="logo_icon img-responsive" src="{{ asset('images/logo/logo1.png') }}"
                                    alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="logo_section">
                                <a href="index.html"><img class="img-responsive" src="{{ asset('images/logo/logo2.png') }}"
                                        alt="#" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <ul class="list-unstyled components">
                        <li class="active">
                            <a href="dashboard"><i class="fa fa-dashboard white_color"></i> <span>Dashboard</span></a>
                            <!-- <ul class="collapse list-unstyled" id="dashboard">
                                <li>
                                    <a href="dashboard1">> <span>Default Dashboard</span></a>
                                </li>
                                <li>
                                    <a href="dashboard2">> <span>Dashboard style 2</span></a>
                                </li>
                            </ul> -->
                        </li>
                        <li><a href="widgets"><i class="fa fa-clock-o white_color"></i> <span>Widgets</span></a>
                        </li>
                        <li>
                            <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-diamond white_color"></i> <span>Elements</span></a>
                            <ul class="collapse list-unstyled" id="element">
                                <li><a href="general_elements.html">> <span>General Elements</span></a></li>
                                <li><a href="media_gallery.html">> <span>Media Gallery</span></a></li>
                                <li><a href="icons.html">> <span>Icons</span></a></li>
                                <li><a href="invoice.html">> <span>Invoice</span></a></li>
                            </ul>
                        </li>
                        <li><a href="academics"><i class="fa fa-graduation-cap white_color"></i> <span>Academics</span></a></li>
                        <li>
                            <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-object-group white_color"></i> <span>Apps</span></a>
                            <ul class="collapse list-unstyled" id="apps">
                                <li><a href="email.html">> <span>Email</span></a></li>
                                <li><a href="calendar.html">> <span>Calendar</span></a></li>
                                <li><a href="media_gallery.html">> <span>Media Gallery</span></a></li>
                            </ul>
                        </li>
                        <li><a href="price.html"><i class="fa fa-briefcase white_color"></i> <span>Pricing
                                    Tables</span></a></li>
                        <li>
                            <a href="contact.html">
                                <i class="fa fa-paper-plane white_color"></i> <span>Contact</span></a>
                        </li>
                        <li class="active">
                            <a href="#additional_page" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="fa fa-clone white_color"></i> <span>Additional
                                    Pages</span></a>
                            <ul class="collapse list-unstyled" id="additional_page">
                                <li>
                                    <a href="profile.html">> <span>Profile</span></a>
                                </li>
                                <li>
                                    <a href="project.html">> <span>Projects</span></a>
                                </li>
                                <li>
                                    <a href="login.html">> <span>Login</span></a>
                                </li>
                                <li>
                                    <a href="404_error.html">> <span>404 Error</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="map.html"><i class="fa fa-map white_color"></i> <span>Map</span></a></li>
                        <li><a href="charts.html"><i class="fa fa-bar-chart-o white_color"></i> <span>Charts</span></a>
                        </li>
                        <li><a href="users"><i class="fa fa-users white_color"></i> <span>Users</span></a>
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
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <span>Log Out</span> <i class="fa fa-sign-out mx-3"></i>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
                           <h2>Users</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row align-items-center mb-3">
                     <div class="col-md-6 col-lg-4">
                        <div class="heading1 margin_0">
                           <h2>Community Stats</h2>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-8 d-flex justify-content-end">
                        <button id="updateStatsBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
                           data-bs-target="#myModal" aria-haspopup="true" aria-controls="myModal">
                           <i class="fa fa-refresh mx-2 mb-2 mt-2"></i> Update Stats
                        </button>
                     </div>
                  </div>
                  <div class="row column1">
                     <div class="col-md-6 col-lg-4">
                        <div class="full white_shd margin_bottom_30">
                           <div class="info_people">
                              <div class="couter_icon">
                                 <div>
                                    <i class="fa fa-graduation-cap dark_blue_color"></i>
                                 </div>
                              </div>
                              <div class="user_info_cont">
                                 <h1>{{ $community->student }}</h1>
                                 <p class="p_status">Students</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-4">
                        <div class="full white_shd margin_bottom_30">
                           <div class="info_people">
                              <div class="couter_icon">
                                 <div>
                                    <i class="fa fa-book dark_blue_color"></i>
                                 </div>
                              </div>
                              <div class="user_info_cont">
                                 <h1>{{ $community->acad }}</h1>
                                 <p class="p_status">Academic Staff</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-4">
                        <div class="full white_shd margin_bottom_30">
                           <div class="info_people">
                              <div class="couter_icon">
                                 <div>
                                    <i class="fa fa-cog dark_blue_color"></i>
                                 </div>
                              </div>
                              <div class="user_info_cont">
                                 <h1>{{ $community->nAcad }}</h1>
                                 <p class="p_status">Non-Academic Staff</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
                  <!-- row -->
                  <!-- row -->
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>Admin List</h2>
                              </div>
                              <div>
                                 <button id="addAdminBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#myModal" aria-haspopup="true" aria-controls="myModal">
                                    <i class="fa fa-user-plus mx-2 mb-2 mt-2"></i> Add Admin
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="table_section padding_infor_info">
                           <div class="table-responsive-sm">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Full Name</th>
                                       <th>Email</th>
                                       <th>Contact No.</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse ($users as $index => $user)
                                       <tr>
                                          <td>{{ $users->firstItem() + $index ?? $loop->iteration }}</td>
                                          <td>{{ $user->name }}</td>
                                          <td>{{ $user->email }}</td>
                                          <td>{{ $user->contact_no ?? '—' }}</td>
                                          <td>
                                             <form action="{{ route('toggleUser', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-{{ $user->enabled ? 'danger' : 'success' }}">
                                                   {{ $user->enabled ? 'Disable' : 'Enable' }}
                                                </button>
                                             </form>
                                          </td>
                                       </tr>
                                    @empty
                                       <tr>
                                          <td colspan="5" class="text-center">No users found.</td>
                                       </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3 text-center">
                     {{ $users->links() }}
                  </div>
               </div>
            </div>
            <!-- end dashboard inner -->
         </div>
      </div>
      <div class="modal fade" id="myModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h2 class="modal-title">Modal Heading</h2>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
                  Modal body..
               </div>
               <!-- Modal footer -->
               <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery -->
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
   <script>
      document.getElementById('updateStatsBtn').addEventListener('click', function () {
         // update modal content
         document.querySelector('#myModal .modal-title').textContent = 'Update Community Stats';
         document.querySelector('#myModal .modal-body').innerHTML = `<form id="communityForm"
                                                            action="{{ route('updateCommunity', ['community' => $community->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                               <label for="name">Number of Students</label>
                                                               <input type="text" class="form-control" id="student"
                                                                  name="student" value="{{ $community->student }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="email">Number of Academic Staff</label>
                                                               <input type="text" class="form-control" id="acad"
                                                                  name="acad" value="{{ $community->acad }}"
                                                                  required>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="contact_no">Number of Non-Academic Staff</label>
                                                               <input type="text" class="form-control" id="nAcad"
                                                                  name="nAcad"
                                                                  value="{{ $community->nAcad }}" required>
                                                            </div>
                                                         </form>`;
         document.querySelector('#myModal .modal-footer').innerHTML = `<button type="submit" class="btn btn-success mt-2" id="submitCommunityForm">Update
                                                               Stats</button>`;

         document.getElementById('submitCommunityForm').addEventListener('click', function () {
            document.getElementById('communityForm').submit();
         });
         // show modal using Bootstrap 5's Modal API
         var modalEl = document.getElementById('myModal');
         var bsModal = new bootstrap.Modal(modalEl);
         bsModal.show();
      });

      document.getElementById('addAdminBtn').addEventListener('click', function () {
         // update modal content
         document.querySelector('#myModal .modal-title').textContent = 'Add Admin';
         document.querySelector('#myModal .modal-body').innerHTML = `<form id="addAdminForm"
                                                            action="{{ route('createUser') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                               <label for="name">Name</label>
                                                               <input type="text" class="form-control" id="name"
                                                                  name="name" required>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="email">Email</label>
                                                               <input type="text" class="form-control" id="email"
                                                                  name="email"
                                                                  required>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="contact_no">Contact Number</label>
                                                               <input type="text" class="form-control" id="contact_no"
                                                                  name="contact_no" required>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="password">Password</label>
                                                               <input type="password" class="form-control" id="password"
                                                                  name="password" required>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="enabled"
                                                                  name="enabled" value="true">
                                                         </form>`;
         document.querySelector('#myModal .modal-footer').innerHTML = `<button type="submit" class="btn btn-success mt-2" id="addAdmin">Register</button>`;

         document.getElementById('addAdmin').addEventListener('click', function () {
            document.getElementById('addAdminForm').submit();
         });
         // show modal using Bootstrap 5's Modal API
         var modalEl = document.getElementById('myModal');
         var bsModal = new bootstrap.Modal(modalEl);
         bsModal.show();
      });
   </script>
</body>

</html>