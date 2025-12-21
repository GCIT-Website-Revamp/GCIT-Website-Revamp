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
         margin-top: 0.9rem;
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
                           <h2>Users</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>Admin List</h2>
                              </div>
                              @if (Auth::user()->role == 'Super Admin')
                                 <div>
                                    <button id="addAdminBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
                                       data-bs-target="#myModal" aria-haspopup="true" aria-controls="myModal">
                                       <i class="fa fa-user-plus mx-2 mb-2 mt-2"></i> Add Admin
                                    </button>
                                 </div>
                              @endif
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
                                       @if (Auth::user()->role == 'Super Admin')
                                          <th>Action</th>
                                       @endif
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse ($users as $index => $user)
                                       <tr>
                                          <td>{{ $users->firstItem() + $index ?? $loop->iteration }}</td>
                                          <td>{{ $user->name }}</td>
                                          <td>{{ $user->email }}</td>
                                          <td>{{ $user->contact_no ?? '—' }}</td>
                                          @if (Auth::user()->role == 'Super Admin')
                                             <td style="max-width:80px;">
                                                <form action="{{ route('toggleUser', $user->id) }}" method="POST"
                                                   class="toggle-user-form" data-username="{{ $user->name }}">
                                                   @csrf
                                                   @method('PUT')
                                                   <button type="submit"
                                                      class="btn btn-{{ $user->enabled ? 'orange' : 'success' }}">
                                                      {{ $user->enabled ? 'Disable' : 'Enable' }}
                                                   </button>
                                                </form>
                                             </td>
                                          @endif
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
   <script src="{{ asset('js/admin/logout.js') }}"></script>
   <script src="{{ asset('js/admin/user.js') }}"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="{{ asset('js/admin/custom.js') }}"></script>
   <script src="{{ asset('js/admin/chart_custom_style1.js') }}"></script>
</body>

</html>