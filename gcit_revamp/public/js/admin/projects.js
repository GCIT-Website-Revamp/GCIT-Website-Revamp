const csrf = document.querySelector('input[name="_token"]').value;

// Helper to format validation errors
function formatErrors(errors) {
    if (!errors) return "";
    if (typeof errors === "string") return errors;

    // If errors is an object (like Laravel validation errors)
    return Object.values(errors)
        .flat()
        .join("\n");
}

// =====================
// Add Project Modal Logic
// =====================
document.getElementById('addProjectBtn').addEventListener('click', function () {
    document.querySelector('#myModal .modal-title').textContent = 'Add New Project';

    document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="addProjectForm" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="name">Project Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>

            <div class="form-group">
                <label for="guide">Guide</label>
                <select class="form-control" id="guide" name="guide" required>
                    <option value="">-- Select guide --</option>
                </select>
            </div>

            <div class="form-group">
                <label for="developers">Developers (Add developers separated by comma)</label>
                <textarea class="form-control" id="developers" name="developers" rows="2" required></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Project Poster</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="additional_image">Additional Images (Optional)</label>
                <input type="file" class="form-control" id="additional_images" name="additional_images[]" accept="image/*" multiple>
            </div>

            <div class="form-group" style="margin-left:19px;">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="display" name="display" value="true">
                    Display in the site (Project Page)
                </label>
            </div>
            <div class="form-group" style="margin-left:19px;">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="highlight" name="highlight" value="true">
                    Display in highlights (Home Page)
                </label>
            </div>
        </form>
    `;

    // Init CKEditor
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => window.ictEditorInstance = editor)
        .catch(err => console.error(err));

    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="addProject">Add Project</button>
    `;

    let teams = [];

    // Fetch teams from API
    fetch('/api/team')
        .then(res => res.json())
        .then(data => {
            teams = (data.data || []).filter(team => team.type === "Academic");

            const guideSelect = document.getElementById('guide');
            if (guideSelect) {
                guideSelect.innerHTML = '<option value="">-- Select guide --</option>';
                teams.forEach(team => {
                    const opt = document.createElement('option');
                    opt.value = team.id;
                    opt.textContent = team.name;
                    guideSelect.appendChild(opt);
                });
            }
        })
        .catch(err => {
            console.error('Error fetching teams:', err);
            Swal.fire({ icon: "error", title: "Error", text: "Failed to load teams." });
        });
    
    document.getElementById('addProject').addEventListener('click', function () {
        const form = document.getElementById('addProjectForm');
        const formData = new FormData(form);
        formData.append('description', window.ictEditorInstance.getData());

        Swal.fire({
            title: "Add Project?",
            text: "Do you want to create this project?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create"
        }).then(result => {
            if (result.isConfirmed) {
                fetch('/api/project', {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": csrf },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Project Added",
                            text: data.message || "Project created successfully!"
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
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong!"
                    });
                });
            }
        });
    });

    new bootstrap.Modal(document.getElementById('myModal')).show();
});

// =====================
// Edit Project Modal Logic
// =====================
document.querySelectorAll('.edit-project-btn').forEach(button => {
    button.addEventListener('click', function () {
        const { id, name, year, guide, developers, description, image } = this.dataset;

        document.querySelector('#myModal .modal-title').textContent = 'Edit Project';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="editProjectForm" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <label>Project Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="${name}" required>
                </div>

                <div class="form-group">
                    <label>Year</label>
                    <input type="number" class="form-control" id="year" name="year" value="${year}" required>
                </div>

                <div class="form-group">
                    <label for="guide">Guide</label>
                    <select class="form-control" id="guide" name="guide" required>
                        <option value="">-- Select guide --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Developers</label>
                     <textarea class="form-control" id="developers" name="developers" rows="3" required>${developers ?? ""}</textarea>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="description" name="description" rows="6" required>${description ?? ""}</textarea>
                </div>

                <div class="form-group">
                    <label>Current Poster</label><br>
                    <img src="${image}" width="120" class="mb-2 rounded">
                </div>

                <div class="form-group">
                    <label>Replace Poster (optional)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Additional Images</label>

                    <!-- Scrollable horizontally -->
                    <div id="additionalImagesContainer" 
                        style="white-space: nowrap; overflow-x: auto; padding: 5px; border: 1px solid #ddd; border-radius: 5px; max-width: 100%;">

                    </div>
                </div>

                <div class="form-group">
                    <label>Add More Images</label>
                    <input type="file" class="form-control" multiple id="additional_images" name="additional_images[]" accept="image/*">
                </div>

                <div class="form-group" style="margin-left:19px;">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="display" name="display" value="true" ${this.dataset.display == "true" ? "checked" : ""}>
                        Display in the site (Project Page)
                    </label>
                </div>
                <div class="form-group" style="margin-left:19px;">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="highlight" name="highlight" value="true" ${this.dataset.highlight == "true" ? "checked" : ""}>
                        Display in highlights (Home Page)
                    </label>
                </div>
            </form>
        `;
        // Init CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => window.ictEditorInstance = editor)
            .catch(err => console.error(err));

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="updateProject">Update</button>
        `;

        const images = JSON.parse(this.dataset.images || "[]");
        const container = document.getElementById("additionalImagesContainer");

        images.forEach(img => {
            const wrapper = document.createElement("div");
            wrapper.style.display = "inline-block";
            wrapper.style.position = "relative";
            wrapper.style.marginRight = "10px";

            wrapper.innerHTML = `
                <img src="/storage/${img.image_path}" width="120" height="80" class="rounded" style="border:1px solid #ccc;">
                <button type="button" class="btn btn-danger btn-sm delete-additional-image" 
                        data-image-id="${img.id}"
                        style="
                            position:absolute; 
                            top:0; right:0; 
                            border-radius:50%; 
                            padding:2px 6px; 
                            font-size:12px;">
                    ×
                </button>
            `;

            container.appendChild(wrapper);
        });
        // Fetch teams and populate guide select, pre-select current guide
        fetch('/api/team')
            .then(res => res.json())
            .then(data => {
                const teams = (data.data || []).filter(team => team.type === "Academic");
                const guideSelect = document.getElementById('guide');

                if (!guideSelect) return;

                guideSelect.innerHTML = '<option value="">-- Select guide --</option>';

                teams.forEach(team => {
                    const opt = document.createElement('option');
                    opt.value = team.id;       // or team.id
                    opt.textContent = team.name;

                    // preselect if matches current guide
                    if (guide && guide == team.id) {
                        opt.selected = true;
                    }

                    guideSelect.appendChild(opt);
                });
            })
            .catch(err => {
                console.error('Error fetching teams:', err);
                Swal.fire({ icon: "error", title: "Error", text: "Failed to load teams." });
            });

        document.getElementById('updateProject').addEventListener('click', function () {
            const form = document.getElementById('editProjectForm');
            const formData = new FormData(form);
            formData.append('description', window.ictEditorInstance.getData());
            formData.append("_method", 'PUT');

            Swal.fire({
                title: "Update Project?",
                text: "Are you sure you want to update this project?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update"
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`/api/project/${id}`, {
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": csrf },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Updated!",
                                text: data.message || "Project updated successfully!"
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
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something went wrong!"
                        });
                    });
                }
            });
        });

        document.querySelectorAll('.delete-additional-image').forEach(btn => {
            btn.addEventListener('click', function () {
                const imageId = this.dataset.imageId;

                Swal.fire({
                    title: "Delete image?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                }).then(result => {
                    if (result.isConfirmed) {

                        fetch(`/api/project-image/${imageId}`, {
                            method: "DELETE",
                            headers: { "X-CSRF-TOKEN": csrf }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.parentElement.remove(); // remove from UI
                            } else {
                                Swal.fire({ icon: "error", title: "Failed", text: data.message });
                            }
                        });
                    }
                });
            });
        });

        new bootstrap.Modal(document.getElementById('myModal')).show();
    });
});

// =====================
// Delete Project Button
// =====================
document.querySelectorAll('.delete-project-btn').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.dataset.projectId;

        Swal.fire({
            title: "Delete Project?",
            text: "This project will be permanently deleted.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete"
        }).then(result => {
            if (result.isConfirmed) {
                fetch(`/api/project/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? "success" : "error",
                        title: data.success ? "Deleted!" : "Failed",
                        text: data.message || ""
                    });

                    if (data.success) {
                        setTimeout(() => location.reload(), 1500);
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong!"
                    });
                });
            }
        });
    });
});
