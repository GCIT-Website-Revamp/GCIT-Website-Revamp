const csrf = document.querySelector('input[name="_token"]').value;

window.Loader = {
    show() {
        document.getElementById('global-loader')?.style.setProperty('display', 'flex');
    },
    hide() {
        document.getElementById('global-loader')?.style.setProperty('display', 'none');
    }
};
// =====================================
// Project Search (Live Search)
// =====================================
document.addEventListener('DOMContentLoaded', () => {

    const projectSearchInput = document.getElementById('projectSearch');
    if (!projectSearchInput) return;

    const projectTableBody = projectSearchInput
        .closest('.white_shd')
        .querySelector('table tbody');

    // Save original rows to restore later
    const originalProjectRows = projectTableBody.innerHTML;

    projectSearchInput.addEventListener('input', function () {
        const query = this.value.trim();

        // Restore original table when input is empty
        if (query.length === 0) {
            projectTableBody.innerHTML = originalProjectRows;
            return;
        }
        Loader.show();
        fetch(`/api/project-search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;

                projectTableBody.innerHTML = '';

                if (!data.data.length) {
                    projectTableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center">No matching projects found</td>
                        </tr>
                    `;
                    return;
                }

                data.data.forEach((project, index) => {
                    projectTableBody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>

                            <td style="max-width:40px;">${project.name}</td>

                            <td style="max-width:80px;">
                                <img src="/storage/${project.image}" width="80">
                            </td>

                            <td style="max-width:340px;">
                                ${project.description ? project.description.substring(0, 200) + '...' : '-'}
                            </td>

                            <td>${project.year}</td>

                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-success edit-project-btn"
                                        data-id="${project.id}"
                                        data-name="${project.name}"
                                        data-year="${project.year}"
                                        data-guide="${project.guide}"
                                        data-display="${project.display}"
                                        data-highlight="${project.highlight}"
                                        data-developers="${project.developers || ''}"
                                        data-description="${project.description || ''}"
                                        data-image="/storage/${project.image}"
                                        data-images='${JSON.stringify(project.images || [])}'>
                                        Edit
                                    </button>

                                    <button class="btn btn-danger delete-project-btn"
                                        data-project-id="${project.id}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(err => {
                console.error('Project search error:', err);
            })
            .finally(() => Loader.hide());
    });
});

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
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="" disabled selected>Select Type</option>
                    <option value="Start-Up">Start-Up</option>
                    <option value="Capstone Project">Capstone Project</option>
                </select>
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
                    Hide in the site (Project Page)
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
            teams = (data.data || []).filter(team => team.type === "Academic")
            .sort((a, b) => a.name.localeCompare(b.name));

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
        formData.append("display", document.getElementById("display").checked ? "true" : "false");
        formData.append("highlight", document.getElementById("highlight").checked ? "true" : "false");

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
                Loader.show();
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
                    })
                    .finally(() => Loader.hide());
            }
        });
    });

    new bootstrap.Modal(document.getElementById('myModal')).show();
});

// =====================
// Edit Project Modal Logic
// =====================
document.addEventListener('click', function (e) {
    const editBtn = e.target.closest('.edit-project-btn');
    if (editBtn) {
        const { id, name, year, guide, developers, description, image, type } = editBtn.dataset;

        document.querySelector('#myModal .modal-title').textContent = 'Edit Project';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="editProjectForm" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <label>Project Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="${name}" required>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" id="type" name="type">
                        <option value="" disabled selected>Select Type</option>
                        <option value="Start-Up" ${type === "Start-Up" ? "selected" : ""}>Start-Up</option>
                        <option value="Capstone Project" ${type === "Capstone Project" ? "selected" : ""}>Capstone Project</option>
                    </select>
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
                        <input type="checkbox" class="form-check-input" id="display" name="display" value="true" ${editBtn.dataset.display == "true" ? "checked" : ""}>
                        Hide in the site (Project Page)
                    </label>
                </div>
                <div class="form-group" style="margin-left:19px;">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="highlight" name="highlight" value="true" ${editBtn.dataset.highlight == "true" ? "checked" : ""}>
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

        const images = JSON.parse(editBtn.dataset.images || "[]");
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
                const teams = (data.data || []).filter(team => team.type === "Academic")
                .sort((a, b) => a.name.localeCompare(b.name));
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
            formData.append("display", document.getElementById("display").checked ? "true" : "false");
            formData.append("highlight", document.getElementById("highlight").checked ? "true" : "false");
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
                    Loader.show();
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
                        })
                        .finally(() => Loader.hide());
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
                        Loader.show()
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
                            })
                            .finally(() => Loader.hide());
                    }
                });
            });
        });

        new bootstrap.Modal(document.getElementById('myModal')).show();
    }
});

// =====================
// Delete Project Button
// =====================
document.addEventListener('click', function (e) {
    const deleteBtn = e.target.closest('.delete-project-btn');
    if (deleteBtn) {
        const id = deleteBtn.dataset.projectId;

        Swal.fire({
            title: "Delete Project?",
            text: "This project will be permanently deleted.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete"
        }).then(result => {
            Loader.show();
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
                    })
                    .finally(() => Loader.hide());
            }
        });
    }
});
