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

      /* CKEditor content styling */
      .ck-content {
         color: #333 !important;
         line-height: 1.6;
      }

      .ck-content ol,
      .ck-content ul {
         padding-left: 25px !important;
         margin-bottom: 1rem !important;
      }

      .ck-content ol {
         list-style-type: decimal !important;
      }

      .ck-content ul {
         list-style-type: disc !important;
      }

      .ck-content li {
         margin-bottom: 0.25rem !important;
         color: #333 !important;
         display: list-item !important;
      }

      /* Admission view styling */
      #admissionView {
         color: #333;
         line-height: 1.6;
      }

      #admissionView ol,
      #admissionView ul {
         padding-left: 25px;
         margin-bottom: 1rem;
      }

      #admissionView ol {
         list-style-type: decimal;
      }

      #admissionView ul {
         list-style-type: disc;
      }

      #admissionView li {
         margin-bottom: 0.25rem;
         display: list-item;
      }

      #admissionView p {
         margin-bottom: 1rem;
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
                           <h2>Admission</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="heading1 margin_0">
                                 <h2>Admission</h2>
                              </div>
                              <div>
                                 @if ($admission)
                                    <button id="editAdmissionBtn" type="button" class="btn btn-success"
                                       data-bs-toggle="modal" data-bs-target="#myModal"
                                       data-admission-id="{{ $admission->id }}"
                                       data-admission-description="{{ $admission->description }}">
                                       <i class="fa fa-pencil mx-2 mb-2 mt-2"></i> Edit
                                    </button>
                                 @else
                                    <button id="addAdmissionBtn" class="btn btn-success" data-bs-toggle="modal"
                                       data-bs-target="#myModal">
                                       <i class="fa fa-plus-circle mx-2"></i> Add
                                    </button>
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="table_section padding_infor_info">
                           <div id="admissionView" style="color:black">
                              @if ($admission)
                                 {!! $admission->description !!}
                              @else
                                 <p>No admission information added yet.</p>
                              @endif
                           </div>
                        </div>
                     </div>
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
   <script>
      function formatErrors(errors) {
         if (!errors) return "";
         if (typeof errors === "string") return errors;

         // If errors is an object (like Laravel validation errors)
         return Object.values(errors)
            .flat()
            .join("\n");
      }
      document.addEventListener("DOMContentLoaded", () => {
         const csrf = document.querySelector('input[name="_token"]')?.value;
         document.getElementById("addAdmissionBtn")?.addEventListener("click", function () {
            // Set modal title
            document.querySelector('#myModal .modal-title').textContent = 'Add Admission Information';

            // Modal body (CKEditor text area)
            document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="welfareForm">
                <div class="form-group">
                    <label for="admissionEditor">Admission Description</label>
                    <textarea class="form-control" id="admissionEditor" name="description" rows="15" required></textarea>
                </div>
            </form>
        `;

            // Modal footer (no Delete button)
            document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="saveAdmission">Save</button>
        `;

            // OPEN Modal
            let modal = new bootstrap.Modal(document.getElementById('myModal'));
            modal.show();

            // Init CKEditor
            ClassicEditor
               .create(document.querySelector('#admissionEditor'))
               .then(editor => window.ictEditorInstance = editor)
               .catch(err => console.error(err));

            // Save Handler
            document.getElementById("saveAdmission").addEventListener("click", function () {
               const payload = {
                  description: window.ictEditorInstance.getData()
               };
               Swal.fire({
                  title: "Add Admission Information?",
                  icon: "question",
                  showCancelButton: true,
                  confirmButtonText: "Save",
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
               }).then(result => {
                  if (!result.isConfirmed) return;

                  fetch(`/api/admission`, {
                     method: "POST",
                     headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                     },
                     body: JSON.stringify(payload)
                  })
                     .then(res => res.json())
                     .then(data => {
                        if (data.success) {
                           Swal.fire({
                              icon: "success",
                              title: "Admission Information Added",
                              text: data.message || "Admission Information Added successfully!"
                           });
                           setTimeout(() => location.reload(), 1500);
                        } else {
                           Swal.fire({
                              icon: "error",
                              title: "Failed",
                              text: formatErrors(data.errors || data.message)
                           });
                        }
                     })
                     .catch(() => {
                        Swal.fire("Error", "Something went wrong!", "error");
                     });
               });
            });
         });

         // ===============================
         // Handle Edit ICT Button
         // ===============================
         document.getElementById("editAdmissionBtn")?.addEventListener("click", function () {
            const admissionId = this.dataset.admissionId;
            const description = this.dataset.admissionDescription;

            document.querySelector('#myModal .modal-title').textContent = 'Edit Admission Information';

            document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="admissionEditForm">
                <div class="form-group">
                    <label for="admissionEditor">Admission Description</label>
                    <textarea class="form-control" id="admissionEditor" name="description" rows="15">${description}</textarea>
                </div>
            </form>
        `;

            // Modal footer buttons (now includes DELETE)
            document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" id="deleteAdmission">Delete</button>
            <button type="button" class="btn btn-success" id="updateAdmission">Update</button>
        `;

            let modal = new bootstrap.Modal(document.getElementById('myModal'));
            modal.show();

            // Initialize CKEditor
            ClassicEditor
               .create(document.querySelector('#admissionEditor'))
               .then(editor => window.ictEditorInstance = editor)
               .catch(error => console.error('CKEditor error:', error));

            // =======================
            // Update Handler
            // =======================
            document.getElementById("updateAdmission").addEventListener("click", () => {
               const payload = {
                  description: window.ictEditorInstance.getData()
               };

               Swal.fire({
                  title: "Update Admission Information?",
                  icon: "question",
                  showCancelButton: true,
                  confirmButtonText: "Update",
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
               }).then(result => {
                  if (!result.isConfirmed) return;

                  fetch(`/api/admission/${admissionId}`, {
                     method: "PUT",
                     headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                     },
                     body: JSON.stringify(payload)
                  })
                     .then(res => res.json())
                     .then(data => {
                        if (data.success) {
                           Swal.fire({
                              icon: "success",
                              title: "Admission Information Updated",
                              text: data.message || "Admission Information Updated successfully!"
                           });
                           setTimeout(() => location.reload(), 1500);
                        } else {
                           Swal.fire({
                              icon: "error",
                              title: "Failed",
                              text: formatErrors(data.errors || data.message)
                           });
                        }
                     });
               });
            });

            // =======================
            // Delete Handler
            // =======================
            document.getElementById("deleteAdmission").addEventListener("click", () => {
               Swal.fire({
                  title: "Delete Admission Information?",
                  text: "This action cannot be undone.",
                  icon: "warning",
                  showCancelButton: true,
                  cancelButtonColor: "#d33",
                  confirmButtonColor: "#3085d6",
                  confirmButtonText: "Delete"
               }).then(result => {
                  if (!result.isConfirmed) return;

                  fetch(`/api/admission/${admissionId}`, {
                     method: "DELETE",
                     headers: {
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                     }
                  })
                     .then(res => res.json())
                     .then(data => {
                        if (data.success) {
                           Swal.fire({
                              icon: "success",
                              title: "Admission Information Deleted",
                              text: data.message || "Admission Information Deleted successfully!"
                           });
                           setTimeout(() => location.reload(), 1200);
                        } else {
                           Swal.fire({
                              icon: "error",
                              title: "Failed",
                              text: formatErrors(data.errors || data.message)
                           });
                        }
                     });
               });
            });
         });
      });
   </script>
</body>

</html>