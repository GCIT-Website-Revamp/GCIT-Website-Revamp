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

<body class="inner_page tables_page">
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
                           <h2>Updates</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>News and Events</h2>
                              </div>
                              <div class="d-flex">
                                 <input type="text" id="eventSearch" class="form-control mx-2" placeholder="Search..." data-search-input>
                                 <button id="addEventBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#myModal" aria-haspopup="true" aria-controls="myModal">
                                    <i class="fa fa-plus-circle mx-2 mb-2 mt-2"></i> Add News & Event
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
                                       <th>Title</th>
                                       <th>Image</th>
                                       <th>Description</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse ($events as $index => $event)
                                       <tr>
                                          <td>{{ $events->firstItem() + $index ?? $loop->iteration }}</td>
                                          <td style="max-width: 80px;">{{ $event->name }}</td>
                                          <td style="max-width: 80px;"><img src="{{ asset('storage/' . $event->image) }}"
                                                alt="Event Image" width="80"></td>
                                          <td style="max-width: 250px;">{!! Str::limit($event->description, 450) !!}</td>
                                          <td style="max-width: 60px;">
                                             <div class="action-buttons">
                                                <button type="button" class="btn btn-success edit-event-btn"
                                                   data-event-id="{{ $event->id }}" data-event-name="{{ $event->name }}"
                                                   data-event-image="{{ asset('storage/' . $event->image) }}"
                                                   data-event-date="{{ $event->date }}" data-event-display="{{ $event->display }}"
                                                   data-event-category="{{ $event->category }}" data-event-highlight="{{ $event->highlight }}"
                                                   data-event-description="{{ $event->description }}" data-event-images='@json($event->images)'>
                                                   Edit
                                                </button>
                                                <button type="button" class="btn btn-danger delete-event-btn"
                                                   data-event-id="{{ $event->id }}">
                                                   Delete
                                                </button>
                                             </div>
                                          </td>
                                       </tr>
                                    @empty
                                       <tr>
                                          <td colspan="5" class="text-center">No events found.</td>
                                       </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3 text-center">
                     {{ $events->appends(['announcements_page' => request('announcements_page')])->links() }}
                  </div>
                  <!-- row -->
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>Announcements</h2>
                              </div>
                              <div class="d-flex">
                                 <input type="text" id="announcementSearch" class="form-control mx-2" placeholder="Search..." data-search-input>
                                 <button id="addAnnouncementBtn" type="button" class="btn btn-success"
                                    data-bs-toggle="modal" data-bs-target="#myModal" aria-haspopup="true"
                                    aria-controls="myModal">
                                    <i class="fa fa-plus-circle mx-2 mb-2 mt-2"></i> Add Announcement
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
                                       <th>Title</th>
                                       <th>Date</th>
                                       <th>Description</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse ($announcements as $index => $announcemnet)
                                       <tr>
                                          <td>{{ $announcements->firstItem() + $index ?? $loop->iteration }}</td>
                                          <td style="max-width:100px;">{{ $announcemnet->name }}</td>
                                          <td style="max-width:80px;">{{ $announcemnet->date }}</td>
                                          <td style="max-width:340px;">{!! Str::limit($announcemnet->description, 100) !!}</td>
                                          <td style="max-width:80px;">
                                             <div class="action-buttons">
                                                <button type="button" class="btn btn-success edit-announcemnet-btn"
                                                   data-announcemnet-id="{{ $announcemnet->id }}"
                                                   data-announcemnet-name="{{ $announcemnet->name }}"
                                                   data-announcemnet-description="{{ $announcemnet->description }}"
                                                   data-announcemnet-date="{{ $announcemnet->date }}"
                                                   data-announcemnet-category="{{ $announcemnet->category }}"
                                                   data-announcemnet-display="{{ $announcemnet->display }}">
                                                   Edit
                                                </button>
                                                <button type="button" class="btn btn-danger delete-announcemnet-btn"
                                                   data-announcemnet-id="{{ $announcemnet->id }}">
                                                   Delete
                                                </button>
                                             </div>
                                          </td>
                                       </tr>
                                    @empty
                                       <tr>
                                          <td colspan="6" class="text-center">No announcements found.</td>
                                       </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3 text-center">
                     {{ $announcements->appends(['events_page' => request('events_page')])->links() }}
                  </div>
               </div>
            </div>
            <!-- end dashboard inner -->
         </div>
      </div>
      <!-- model popup -->
      <!-- The Modal -->
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
               <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- end model popup -->
   </div>
   <!-- jQuery -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
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
   <script src="{{ asset('js/admin/updates.js') }}"></script>
</body>

</html>
