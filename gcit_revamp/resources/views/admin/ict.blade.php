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
                                    <h2>ICT</h2>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="col-md-12">
                            <div class="white_shd full margin_bottom_30">
                                <div class="full graph_head">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="heading1 margin_0">
                                            <h2>ICT Information</h2>
                                        </div>
                                        <div>
                                            @if ($ict)
                                                <button id="editICTBtn" type="button" class="btn btn-success"
                                                    data-bs-toggle="modal" data-bs-target="#myModal"
                                                    data-ict-id="{{ $ict->id }}"
                                                    data-ict-description="{{ $ict->description }}">
                                                    <i class="fa fa-pencil mx-2 mb-2 mt-2"></i> Edit
                                                </button>
                                            @else
                                                <button id="addICTBtn" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#myModal">
                                                    <i class="fa fa-plus-circle mx-2"></i> Add
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="table_section padding_infor_info">
                                    <div id="admissionView" style="color:black">
                                        @if ($ict)
                                            {!! $ict->description !!}
                                        @else
                                            <p>No ICT information added yet.</p>
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
        window.Loader = {
            show() {
                document.getElementById('global-loader')?.style.setProperty('display', 'flex');
            },
            hide() {
                document.getElementById('global-loader')?.style.setProperty('display', 'none');
            }
        };
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

            // ===============================
            // Handle Add ICT Button
            // ===============================
            document.getElementById("addICTBtn")?.addEventListener("click", function () {
                // Set modal title
                document.querySelector('#myModal .modal-title').textContent = 'Add ICT Information';

                // Modal body (CKEditor text area)
                document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="ictForm">
                <div class="form-group">
                    <label for="ictEditor">ICT Description</label>
                    <textarea class="form-control" id="ictEditor" name="description" rows="15" required></textarea>
                </div>
            </form>
        `;

                // Modal footer (no Delete button)
                document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="saveICT">Save</button>
        `;

                // OPEN Modal
                let modal = new bootstrap.Modal(document.getElementById('myModal'));
                modal.show();

                // Init CKEditor
                ClassicEditor
                    .create(document.querySelector('#ictEditor'))
                    .then(editor => window.ictEditorInstance = editor)
                    .catch(err => console.error(err));

                // Save Handler
                document.getElementById("saveICT").addEventListener("click", function () {
                    const payload = {
                        description: window.ictEditorInstance.getData()
                    };
                    Swal.fire({
                        title: "Add ICT Information?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Save",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                    }).then(result => {
                        if (!result.isConfirmed) return;
                        Loader.show();
                        fetch(`/api/ict`, {
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
                                        title: "ICT Information Added",
                                        text: data.message || "ICT Information Added successfully!"
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
                            })
                            .finally(() => Loader.hide());
                    });
                });
            });

            // ===============================
            // Handle Edit ICT Button
            // ===============================
            document.getElementById("editICTBtn")?.addEventListener("click", function () {
                const ictId = this.dataset.ictId;
                const description = this.dataset.ictDescription;

                document.querySelector('#myModal .modal-title').textContent = 'Edit ICT Information';

                document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="ictEditForm">
                <div class="form-group">
                    <label for="ictEditor">ICT Description</label>
                    <textarea class="form-control" id="ictEditor" name="description" rows="15">${description}</textarea>
                </div>
            </form>
        `;

                // Modal footer buttons (now includes DELETE)
                document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" id="deleteICT">Delete</button>
            <button type="button" class="btn btn-success" id="updateICT">Update</button>
        `;

                let modal = new bootstrap.Modal(document.getElementById('myModal'));
                modal.show();

                // Initialize CKEditor
                ClassicEditor
                    .create(document.querySelector('#ictEditor'))
                    .then(editor => window.ictEditorInstance = editor)
                    .catch(error => console.error('CKEditor error:', error));

                // =======================
                // Update Handler
                // =======================
                document.getElementById("updateICT").addEventListener("click", () => {
                    const payload = {
                        description: window.ictEditorInstance.getData()
                    };

                    Swal.fire({
                        title: "Update ICT Information?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Update",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                    }).then(result => {
                        if (!result.isConfirmed) return;
                        Loader.show();
                        fetch(`/api/ict/${ictId}`, {
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
                                        title: "ICT Information Updated",
                                        text: data.message || "ICT Information Updated successfully!"
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
                            .finally(() => Loader.hide());
                    });
                });

                // =======================
                // Delete Handler
                // =======================
                document.getElementById("deleteICT").addEventListener("click", () => {
                    Swal.fire({
                        title: "Delete ICT Information?",
                        text: "This action cannot be undone.",
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonColor: "#d33",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Delete"
                    }).then(result => {
                        if (!result.isConfirmed) return;
                        Loader.show();
                        fetch(`/api/ict/${ictId}`, {
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
                                        title: "ICT Information Deleted",
                                        text: data.message || "ICT Information Deleted successfully!"
                                    });
                                    setTimeout(() => location.reload(), 1200);
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Failed",
                                        text: formatErrors(data.errors || data.message)
                                    });
                                }
                            })
                            .finally(() => Loader.hide());
                    });
                });
            });
        });
    </script>
</body>

</html>