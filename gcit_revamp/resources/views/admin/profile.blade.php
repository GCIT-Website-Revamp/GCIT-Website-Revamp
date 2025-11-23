<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
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

   <style>
      .password-wrapper {
         position: relative;
      }

      .toggle-eye {
         position: absolute;
         right: 12px;
         top: 50%;
         transform: translateY(-50%);
         cursor: pointer;
         width: 22px;
         height: 22px;
         opacity: 0.6;
         transition: opacity 0.2s;
         margin-top: 1rem; /* Adjusted for better positioning */
         z-index: 10; /* Ensure it's above the input */
      }

      .toggle-eye:hover {
         opacity: 1;
      }

      .eye-open,
      .eye-closed {
         display: none;
      }

      .eye-open.active,
      .eye-closed.active {
         display: block;
      }

      /* Ensure form groups have proper spacing */
      .form-group {
         position: relative;
         margin-bottom: 1rem;
      }
   </style>
</head>

<body class="inner_page profile_page">
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="dashboard"><img class="logo_icon img-responsive" src="{{ asset('images/logo/logo1.png') }}"
                                    alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="logo_section">
                                <a href="dashboard"><img class="img-responsive" src="{{ asset('images/logo/logo2.png') }}"
                                        alt="#" /></a>
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
                            <a href="teams"><i
                                    class="fa fa-users white_color"></i> <span>Teams</span></a>
                        </li>
                        <li>
                            <a href="contact">
                                <i class="fa fa-paper-plane white_color"></i> <span>Contacts</span></a>
                        </li>
                        <li class="active">
                            <a href="#additional_page" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="fa fa-briefcase white_color"></i> <span>Non-Academic</span></a>
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
                                       <span>Log Out</span> <i class="fa fa-sign-out"></i>
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
                           <h2>Profile</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row column1">
                     <div class="col-md-2"></div>
                     <div class="col-md-8">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Admin Profile</h2>
                              </div>
                           </div>
                           <div class="full price_table padding_infor_info">
                              <div class="row">
                                 <!-- user profile section -->
                                 <!-- profile image -->
                                 <div class="col-lg-12">
                                    <div class="full dis_flex center_text">
                                       <div class="profile_contant">
                                          <div class="contact_inner">
                                             <h3>{{Auth::user()->name}}</h3>
                                             <ul class="list-unstyled">
                                                <li><i class="fa fa-envelope-o"></i> : {{Auth::user()->email}}</li>
                                                <li><i class="fa fa-phone"></i> : {{Auth::user()->contact_no}}</li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- profile contant section -->
                                    <div class="full inner_elements margin_top_30">
                                       <div class="tab_style2">
                                          <div class="tabbar">
                                             <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                   <a class="nav-item nav-link active" id="nav-profile-tab"
                                                      data-toggle="tab" href="#update_profile" role="tab"
                                                      aria-selected="true">Update Profile</a>
                                                   <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab"
                                                      href="#reset_password" role="tab" aria-selected="false">Update
                                                      Password</a>
                                                </div>
                                             </nav>
                                             <div class="tab-content" id="nav-tabContent">

                                                <!-- Update Profile Form -->
                                                <div class="tab-pane fade show active" id="update_profile"
                                                   role="tabpanel" aria-labelledby="nav-profile-tab">
                                                   <div class="full dis_flex center_text">
                                                      <div class="col-md-8 offset-md-2">
                                                         <form
                                                            action="{{ route('updateUser', ['user' => Auth::user()->id]) }}"
                                                            method="POST" class="updateUserForm">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                               <label for="name">Full Name</label>
                                                               <input type="text" class="form-control" id="name"
                                                                  name="name" value="{{ Auth::user()->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="email">Email</label>
                                                               <input type="email" class="form-control" id="email"
                                                                  name="email" value="{{ Auth::user()->email }}"
                                                                  required>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="contact_no">Contact Number</label>
                                                               <input type="text" class="form-control" id="contact_no"
                                                                  name="contact_no"
                                                                  value="{{ Auth::user()->contact_no }}">
                                                            </div>
                                                            <button type="submit" class="btn btn-success mt-2">Update
                                                               Profile</button>
                                                         </form>
                                                      </div>
                                                   </div>
                                                </div>

                                                <!-- Reset Password Form -->
                                                <div class="tab-pane fade" id="reset_password" role="tabpanel"
                                                   aria-labelledby="nav-password-tab">
                                                   <div class="full dis_flex center_text">
                                                      <div class="col-md-8 offset-md-2">
                                                         <form action="{{ route('updatePassword') }}" method="POST"
                                                            class="updatePasswordForm">
                                                            @csrf

                                                            <!-- Current Password -->
                                                            <div class="form-group password-wrapper">
                                                               <label for="current_password">Current Password</label>
                                                               <input type="password" class="form-control"
                                                                  id="current_password" name="current_password"
                                                                  required>
                                                               <div class="toggle-eye toggle-password">
                                                                  <!-- Open eye SVG -->
                                                                  <svg class="eye-open active" fill="none"
                                                                     viewBox="0 0 24 24" width="100%" height="100%">
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z" />
                                                                     <circle cx="12" cy="12" r="3" stroke="#000"
                                                                        stroke-width="1.5" />
                                                                  </svg>
                                                                  <!-- Closed eye SVG -->
                                                                  <svg class="eye-closed" fill="none"
                                                                     viewBox="0 0 24 24" width="100%" height="100%">
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z" />
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M4 4l16 16" />
                                                                  </svg>
                                                               </div>
                                                            </div>

                                                            <!-- New Password -->
                                                            <div class="form-group password-wrapper">
                                                               <label for="new_password">New Password</label>
                                                               <input type="password" class="form-control"
                                                                  id="new_password" name="new_password" required>
                                                               <div class="toggle-eye toggle-password">
                                                                  <svg class="eye-open active" fill="none"
                                                                     viewBox="0 0 24 24" width="100%" height="100%">
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z" />
                                                                     <circle cx="12" cy="12" r="3" stroke="#000"
                                                                        stroke-width="1.5" />
                                                                  </svg>
                                                                  <svg class="eye-closed" fill="none"
                                                                     viewBox="0 0 24 24" width="100%" height="100%">
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z" />
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M4 4l16 16" />
                                                                  </svg>
                                                               </div>
                                                            </div>

                                                            <!-- Confirm New Password -->
                                                            <div class="form-group password-wrapper">
                                                               <label for="confirm_password">Confirm New
                                                                  Password</label>
                                                               <input type="password" class="form-control"
                                                                  id="confirm_password" name="new_password_confirmation"
                                                                  required>
                                                               <div class="toggle-eye toggle-password">
                                                                  <svg class="eye-open active" fill="none"
                                                                     viewBox="0 0 24 24" width="100%" height="100%">
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z" />
                                                                     <circle cx="12" cy="12" r="3" stroke="#000"
                                                                        stroke-width="1.5" />
                                                                  </svg>
                                                                  <svg class="eye-closed" fill="none"
                                                                     viewBox="0 0 24 24" width="100%" height="100%">
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z" />
                                                                     <path stroke="#000" stroke-width="1.5"
                                                                        d="M4 4l16 16" />
                                                                  </svg>
                                                               </div>
                                                            </div>

                                                            <button type="submit" class="btn btn-success mt-2">Update
                                                               Password</button>
                                                         </form>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end user profile section -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2"></div>
                     </div>
                     <!-- end row -->
                  </div>
               </div>
               <!-- end dashboard inner -->
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
   <script src="{{ asset('js/admin/semantic.min.js') }}"></script>
   <script src="{{ asset('js/admin/logout.js') }}"></script>
   <script src="{{ asset('js/admin/profile.js') }}"></script>
</body>

</html>