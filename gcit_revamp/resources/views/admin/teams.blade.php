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
                           <h2>Staffs</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>Staff Details</h2>
                              </div>
                              <div class="d-flex">
                                 <input type="text" id="teamSearch" class="form-control mx-2" placeholder="Search..." data-search-input>
                                 <button id="addTeamBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#myModal" aria-haspopup="true" aria-controls="myModal">
                                    <i class="fa fa-plus-circle mx-2 mb-2 mt-2"></i> Add Team
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
                                       <th>Action</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse ($teams as $index => $team)
                                       <tr>
                                          <td>{{ $teams->firstItem() + $index ?? $loop->iteration }}</td>
                                          <td>{{ $team->name }}</td>
                                          <td><img src="{{ asset('storage/' . $team->image) }}" alt="team Image"
                                                width="80"></td>
                                          <td style="max-width: 340px;">{{ $team->description ?? '—' }}</td>
                                          <td style="max-width: 80px;">
                                             <div class="action-buttons">
                                                <button class="btn btn-success edit-btn" data-id="{{ $team->id }}"
                                                   data-name="{{ $team->name }}" data-service-id="{{ $team->service_id }}"
                                                   data-type="{{ $team->type }}" data-department="{{ $team->category }}"
                                                   data-title="{{ $team->title }}" data-qualifications="{{ $team->qualification }}"
                                                   data-description="{{ $team->description }}"
                                                   data-image="{{ asset('storage/' . $team->image) }}">Edit</button>
                                                <button type="button" class="btn btn-danger delete-btn"
                                                   data-id="{{ $team->id }}">
                                                   Delete
                                                </button>
                                             </div>
                                          </td>
                                       </tr>
                                    @empty
                                       <tr>
                                          <td colspan="5" class="text-center">No Teams found.</td>
                                       </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3 text-center">
                     {{ $teams->links() }}
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
                  <h4 class="modal-title">Modal Heading</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
                  Modal body..
               </div>
               <!-- Modal footer -->
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
   <script src="{{ asset('js/admin/teams.js') }}"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
</body>

</html>