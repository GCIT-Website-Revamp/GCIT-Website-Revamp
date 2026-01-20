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
                           <h2>Academics</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>Courses</h2>
                              </div>
                              <div>
                                 <button id="addCourseBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#myModal" aria-haspopup="true" aria-controls="myModal">
                                    <i class="fa fa-plus-circle mx-2 mb-2 mt-2"></i> Add Course
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
                                       <th>Course</th>
                                       <th>Description</th>
                                       <th>Structure</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse ($courses as $index => $course)
                                       <tr>
                                          <td>{{ $courses->firstItem() + $index ?? $loop->iteration }}</td>
                                          <td>{{ $course->name }}</td>
                                          <td style="max-width: 340px;">{!! Str::limit($course->description, 200) !!}</td>
                                          <td style="max-width: 340px;">{!! Str::limit($course->structure, 200) !!}</td>
                                          <td>
                                             <div class="action-buttons">
                                                <button type="button" class="btn btn-success edit-course-btn"
                                                   data-course-id="{{ $course->id }}"
                                                   data-course-name="{{ $course->name }}"
                                                   data-course-header="{{ $course->header }}"
                                                   data-course-header2="{{ $course->header2 }}"
                                                   data-course-type="{{ $course->type }}"
                                                   data-course-why="{{ $course->why }}"
                                                   data-course-what="{{ $course->what }}"
                                                   data-course-structure="{{ $course->structure }}"
                                                   data-course-career="{{ $course->career }}"
                                                   data-course-description="{{ $course->description }}"
                                                   data-course-image="{{ asset('storage/' . $course->image) }}">
                                                   Edit
                                                </button>
                                                <button type="button" class="btn btn-danger delete-course-btn"
                                                   data-course-id="{{ $course->id }}"
                                                   data-course-name="{{ $course->name }}">
                                                   Delete
                                                </button>
                                             </div>
                                          </td>
                                       </tr>
                                    @empty
                                       <tr>
                                          <td colspan="5" class="text-center">No courses found.</td>
                                       </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3 mb-0 text-center"  style="margin-bottom: 2px;">
                     {{ $courses->appends(['modules_page' => request('modules_page')])->links() }}
                  </div>
                  <!-- row -->
                  <div class="col-md-12 mt-0">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>Modules</h2>
                              </div>
                              <div class="d-flex">
                                 <input type="text" id="moduleSearch" class="form-control mx-2" placeholder="Search..." data-search-input>
                                 <button id="addModuleBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#myModal" aria-haspopup="true" aria-controls="myModal">
                                    <i class="fa fa-plus-circle mx-2 mb-2 mt-2"></i> Add Module
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
                                       <th>Module</th>
                                       <th>Description</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse ($modules as $index => $module)
                                       <tr>
                                          <td>{{ $modules->firstItem() + $index ?? $loop->iteration }}</td>
                                          <td>{{ $module->name }}</td>
                                          <td style="max-width: 470px;">{!! Str::limit($module->description, 200) !!}</td>
                                          <td>
                                             <div class="action-buttons">
                                                <button type="button" class="btn btn-success edit-module-btn"
                                                   data-module-id="{{ $module->id }}"
                                                   data-module-name="{{ $module->name }}"
                                                   data-module-description="{{ $module->description }}"
                                                   data-module-course-id="{{ json_encode($module->course_id) }}">
                                                   Edit
                                                </button>
                                                <button type="button" class="btn btn-danger delete-module-btn"
                                                   data-module-id="{{ $module->id }}"
                                                   data-module-name="{{ $module->name }}">
                                                   Delete
                                                </button>
                                             </div>
                                          </td>
                                       </tr>
                                    @empty
                                       <tr>
                                          <td colspan="6" class="text-center">No modules found.</td>
                                       </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3 text-center">
                     {{ $modules->appends(['courses_page' => request('courses_page')])->links() }}
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
   <script src="{{ asset('js/admin/academics.js') }}"></script>
</body>

</html>