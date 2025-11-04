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
   <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
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
                    <h4>General</h4>
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
                        <li><a href="tables.html"><i class="fa fa-table white_color"></i> <span>Tables</span></a></li>
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
                        <li><a href="settings.html"><i class="fa fa-cog white_color"></i> <span>Settings</span></a>
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
                           <h2>Widgets</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row column1">
                     <div class="col-md-6 col-lg-4">
                        <div class="full white_shd margin_bottom_30">
                           <div class="info_people">
                              <div class="p_info_img">
                                 <img src="images/layout_img/msg2.png" alt="#" />
                              </div>
                              <div class="user_info_cont">
                                 <h4>Smith</h4>
                                 <p>developer@gmail.com</p>
                                 <p class="p_status">Developer</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-4">
                        <div class="full white_shd margin_bottom_30">
                           <div class="info_people">
                              <div class="p_info_img">
                                 <img src="images/layout_img/msg3.png" alt="#" />
                              </div>
                              <div class="user_info_cont">
                                 <h4>David</h4>
                                 <p>developer@gmail.com</p>
                                 <p class="p_status">Developer</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-4">
                        <div class="full white_shd margin_bottom_30">
                           <div class="info_people">
                              <div class="p_info_img">
                                 <img src="images/layout_img/msg4.png" alt="#" />
                              </div>
                              <div class="user_info_cont">
                                 <h4>John</h4>
                                 <p>developer@gmail.com</p>
                                 <p class="p_status">Tester</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
                  <!-- row -->
                  <div class="row margin_bottom_30">
                     <div class="col-md-12 col-lg-4 widget_progress_section margin_bottom_30">
                        <div class="white_shd full">
                           <div class="widget_progress_bar">
                              <p class="progress_no">73%</p>
                              <p class="progress_head">Sed ut perspi ciatis unde</p>
                              <div class="progress_bar">
                                 <!-- Skill Bars -->
                                 <span class="skill" style="width:73%;">Lorem ipsum dolor sit amet <span
                                       class="info_valume">73%</span></span>
                                 <div class="progress skill-bar ">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped"
                                       role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"
                                       style="width: 73%;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-4 widget_progress_section margin_bottom_30">
                        <div class="white_shd full">
                           <div class="widget_progress_bar">
                              <p class="progress_no">90%</p>
                              <p class="progress_head">Sed ut perspi ciatis unde</p>
                              <div class="progress_bar">
                                 <!-- Skill Bars -->
                                 <span class="skill" style="width:90%;">Lorem ipsum dolor sit amet <span
                                       class="info_valume">90%</span></span>
                                 <div class="progress skill-bar ">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped"
                                       role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"
                                       style="width: 90%;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-4 widget_progress_section margin_bottom_30">
                        <div class="white_shd full">
                           <div class="widget_progress_bar">
                              <p class="progress_no">85%</p>
                              <p class="progress_head">Sed ut perspi ciatis unde</p>
                              <div class="progress_bar">
                                 <!-- Skill Bars -->
                                 <span class="skill" style="width:85%;">Lorem ipsum dolor sit amet <span
                                       class="info_valume">85%</span></span>
                                 <div class="progress skill-bar ">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped"
                                       role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"
                                       style="width: 85%;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
                  <!-- row -->
                  <div class="row column1 social_media_section">
                     <div class="col-md-6 col-lg-3">
                        <div class="full socile_icons fb margin_bottom_30">
                           <div class="social_icon">
                              <i class="fa fa-facebook"></i>
                           </div>
                           <div class="social_cont">
                              <ul>
                                 <li>
                                    <span><strong>35k</strong></span>
                                    <span>Friends</span>
                                 </li>
                                 <li>
                                    <span><strong>128</strong></span>
                                    <span>Feeds</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full socile_icons tw margin_bottom_30">
                           <div class="social_icon">
                              <i class="fa fa-twitter"></i>
                           </div>
                           <div class="social_cont">
                              <ul>
                                 <li>
                                    <span><strong>584k</strong></span>
                                    <span>Followers</span>
                                 </li>
                                 <li>
                                    <span><strong>978</strong></span>
                                    <span>Tweets</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full socile_icons linked margin_bottom_30">
                           <div class="social_icon">
                              <i class="fa fa-linkedin"></i>
                           </div>
                           <div class="social_cont">
                              <ul>
                                 <li>
                                    <span><strong>758+</strong></span>
                                    <span>Contacts</span>
                                 </li>
                                 <li>
                                    <span><strong>365</strong></span>
                                    <span>Feeds</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full socile_icons google_p margin_bottom_30">
                           <div class="social_icon">
                              <i class="fa fa-google-plus"></i>
                           </div>
                           <div class="social_cont">
                              <ul>
                                 <li>
                                    <span><strong>450</strong></span>
                                    <span>Followers</span>
                                 </li>
                                 <li>
                                    <span><strong>57</strong></span>
                                    <span>Circles</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row column4 graph">
                     <div class="col-md-4">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Message</h2>
                              </div>
                           </div>
                           <div class="full progress_bar_inner">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="msg_section">
                                       <div class="msg_list_main">
                                          <ul class="msg_list">
                                             <li>
                                                <span><img src="images/layout_img/msg2.png" class="img-responsive"
                                                      alt="#" /></span>
                                                <span>
                                                   <span class="name_user">John Smith</span>
                                                   <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                                   <span class="time_ago">12 min ago</span>
                                                </span>
                                             </li>
                                             <li>
                                                <span><img src="images/layout_img/msg3.png" class="img-responsive"
                                                      alt="#" /></span>
                                                <span>
                                                   <span class="name_user">John Smith</span>
                                                   <span class="msg_user">On the other hand, we denounce.</span>
                                                   <span class="time_ago">12 min ago</span>
                                                </span>
                                             </li>
                                             <li>
                                                <span><img src="images/layout_img/msg2.png" class="img-responsive"
                                                      alt="#" /></span>
                                                <span>
                                                   <span class="name_user">John Smith</span>
                                                   <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                                   <span class="time_ago">12 min ago</span>
                                                </span>
                                             </li>
                                             <li>
                                                <span><img src="images/layout_img/msg3.png" class="img-responsive"
                                                      alt="#" /></span>
                                                <span>
                                                   <span class="name_user">John Smith</span>
                                                   <span class="msg_user">On the other hand, we denounce.</span>
                                                   <span class="time_ago">12 min ago</span>
                                                </span>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Calendar</h2>
                              </div>
                           </div>
                           <div class="full progress_bar_inner">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="full">
                                       <div class="ui calendar" id="example14"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Update</h2>
                              </div>
                           </div>
                           <div class="full progress_bar_inner">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="msg_list_main">
                                       <ul class="msg_list">
                                          <li>
                                             <span>
                                                <span class="name_user">Herman Beck</span>
                                                <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">John Smith</span>
                                                <span class="msg_user">On the other hand, we denounce.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">John Smith</span>
                                                <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">John Smith</span>
                                                <span class="msg_user">On the other hand, we denounce.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Daily feed</h2>
                              </div>
                           </div>
                           <div class="full progress_bar_inner">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="msg_list_main">
                                       <ul class="msg_list">
                                          <li>
                                             <span>
                                                <span class="name_user">Herman Beck</span>
                                                <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">John Smith</span>
                                                <span class="msg_user">On the other hand, we denounce.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">John Smith</span>
                                                <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">Sales</span>
                                                <span class="msg_user">On the other hand, we denounce.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Last Comments</h2>
                              </div>
                           </div>
                           <div class="full progress_bar_inner">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="msg_list_main">
                                       <ul class="msg_list">
                                          <li>
                                             <span>
                                                <span class="name_user">Herman Beck</span>
                                                <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">John Smith</span>
                                                <span class="msg_user">On the other hand, we denounce.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">John Smith</span>
                                                <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
                                          <li>
                                             <span>
                                                <span class="name_user">John Smith</span>
                                                <span class="msg_user">On the other hand, we denounce.</span>
                                                <span class="time_ago">12 min ago</span>
                                             </span>
                                          </li>
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
            <!-- end dashboard inner -->
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
   <script src="{{ asset('js/admin/semantic.min.js') }}"></script>
</body>

</html>