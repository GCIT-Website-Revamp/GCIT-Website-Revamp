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
   <link rel="stylesheet" href="{{ asset('css/admin/bootstrap-select.css') }}" />
   <link rel="stylesheet" href="{{ asset('css/admin/perfect-scrollbar.css') }}" />
   <link rel="stylesheet" href="{{ asset('css/admin/custom.css') }}" />
   <link rel="stylesheet" href="{{ asset('css/admin/font-awesome.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('css/admin/flaticon.css') }}" />
   <link rel="stylesheet" href="{{ asset('css/admin/semantic.min.css') }}" />
   <style>
      /* Additional custom styles for academics page */
      .table-responsive-sm {
         overflow-x: auto;
      }

      .table td,
      .table th {
         vertical-align: middle;
      }

      .action-buttons {
         display: flex;
         gap: 8px;
         flex-wrap: wrap;
      }

      .action-buttons .btn {
         flex: 1;
         min-width: 70px;
      }

      .modal-content {
         border-radius: 8px;
         overflow: hidden;
      }

      .modal-header {
         background-color: #f8f9fa;
         border-bottom: 1px solid #dee2e6;
      }

      .modal-footer {
         border-top: 1px solid #dee2e6;
      }

      @media (max-width: 768px) {
         .action-buttons {
            flex-direction: column;
         }

         .table-responsive-sm {
            font-size: 0.875rem;
         }

         .d-flex.justify-content-between {
            flex-direction: column;
            gap: 15px;
         }
      }
   </style>
</head>

<body class="inner_page widgets">
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
                     <a href="teams"><i class="fa fa-users white_color"></i> <span>Teams</span></a>
                  </li>
                  <li>
                     <a href="contact">
                        <i class="fa fa-paper-plane white_color"></i> <span>Contacts</span></a>
                  </li>
                  <li class="active">
                     <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                           class="fa fa-briefcase white_color"></i> <span>Non-Academic</span></a>
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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       Log Out
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
                           <h2>Projects</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>Projects</h2>
                              </div>
                              <div>
                                 <button id="addProjectBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#myModal" aria-haspopup="true" aria-controls="myModal">
                                    <i class="fa fa-plus-circle mx-2 mb-2 mt-2"></i> Add Project
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
                                       <th>Name</th>
                                       <th>Image</th>
                                       <th>Description</th>
                                       <th>Year</th>
                                       <th>Action</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse ($projects as $index => $project)
                                       <tr>
                                          <td style="max-width: 10px;">
                                             {{ $projects->firstItem() + $index ?? $loop->iteration }}</td>
                                          <td style="max-width: 40px;">{{ $project->name }}</td>
                                          <td style="max-width: 80px;"><img src="{{ asset('storage/' . $project->image) }}"
                                                alt="Project Image" width="80"></td>
                                          <td style="max-width: 340px;">{{ $project->description ?? '—' }}</td>
                                          <td style="max-width: 40px;">{{ $project->year }}</td>
                                          <td style="max-width: 80px;">
                                             <div class="action-buttons">
                                                <button class="btn btn-success edit-project-btn"
                                                   data-id="{{ $project->id }}" data-name="{{ $project->name }}"
                                                   data-year="{{ $project->year }}" data-guide="{{ $project->guide }}"
                                                   data-developers="{{ $project->developers }}"
                                                   data-description="{{ $project->description }}"
                                                   data-image="{{ asset('storage/' . $project->image) }}">Edit</button>
                                                <button type="button" class="btn btn-danger delete-project-btn"
                                                   data-project-id="{{ $project->id }}">
                                                   Delete
                                                </button>
                                             </div>
                                          </td>
                                       </tr>
                                    @empty
                                       <tr>
                                          <td colspan="5" class="text-center">No projects found.</td>
                                       </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3 text-center">
                     {{ $projects->links() }}
                  </div>
               </div>
            </div>
            <!-- end dashboard inner -->
         </div>
      </div>
      <div class="modal fade" id="myModal">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title">Modal Heading</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
                  Modal body..
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery -->
   <script src="{{ asset('js/admin/jquery.min.js') }}"></script>
   <script src="{{ asset('js/admin/popper.min.js') }}"></script>
   <script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
   <script src="{{ asset('js/admin/animate.js') }}"></script>
   <script src="{{ asset('js/admin/bootstrap-select.js') }}"></script>
   <script src="{{ asset('js/admin/owl.carousel.js') }}"></script>
   <script src="{{ asset('js/admin/Chart.min.js') }}"></script>
   <script src="{{ asset('js/admin/Chart.bundle.min.js') }}"></script>
   <script src="{{ asset('js/admin/utils.js') }}"></script>
   <script src="{{ asset('js/admin/analyser.js') }}"></script>
   <script src="{{ asset('js/admin/perfect-scrollbar.min.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="{{ asset('js/admin/custom.js') }}"></script>
   <script src="{{ asset('js/admin/semantic.min.js') }}"></script>
   <script src="{{ asset('js/admin/logout.js') }}"></script>
   <script src="{{ asset('js/admin/projects.js') }}"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
</body>

</html>