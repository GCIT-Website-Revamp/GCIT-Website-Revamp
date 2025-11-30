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
                <input type="text" class="form-control" id="guide" name="guide" required>
            </div>

            <div class="form-group">
                <label for="developers">Developers</label>
                <textarea class="form-control" id="developers" name="developers" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Project Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
        </form>
    `;

    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="addProject">Add Project</button>
    `;

    document.getElementById('addProject').addEventListener('click', function () {
        const form = document.getElementById('addProjectForm');
        const formData = new FormData(form);

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
                    <label>Guide</label>
                    <input type="text" class="form-control" id="guide" name="guide" value="${guide ?? ""}" required>
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
                    <label>Current Image</label><br>
                    <img src="${image}" width="120" class="mb-2 rounded">
                </div>

                <div class="form-group">
                    <label>Replace Image (optional)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
            </form>
        `;

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="updateProject">Update</button>
        `;

        document.getElementById('updateProject').addEventListener('click', function () {
            const form = document.getElementById('editProjectForm');
            const formData = new FormData(form);
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
