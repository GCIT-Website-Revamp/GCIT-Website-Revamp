const csrf = document.querySelector('input[name="_token"]').value;

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

// =====================
// Add Service Modal Logic
// =====================
document.getElementById('addFintechBtn')?.addEventListener('click', function () {
    document.querySelector('#myModal .modal-title').textContent = 'Add Fintech Information';

    document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="addFintechForm" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="7" required></textarea>
            </div>
            <div class="form-group">
                <label>Roles</label>
                <div id="roles-container">
                    <!-- Roles will be added dynamically -->
                </div>
                <button type="button" class="btn btn-primary mt-2" id="addRoleBtn">Add Role</button>
            </div>
        </form>
    `;

    ClassicEditor
        .create(document.querySelector('#description'), {
            ckfinder: {
                uploadUrl: '/ckeditor/upload?_token=' + csrf
            },
            image: {
                upload: {
                    types: ['jpeg', 'png', 'jpg', 'gif', 'webp']
                }
            }
        })
        .then(editor => window.ictEditorInstance = editor)
        .catch(err => console.error(err));

    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="addService">Add</button>
    `;

    let teams = [];

    // Fetch teams from API
    fetch('/api/team')
        .then(res => res.json())
        .then(data => {
            teams = (data.data || [])
            .sort((a, b) => a.name.localeCompare(b.name));
            // Add initial role row after fetching teams
            addRoleRow();
        })
        .catch(err => {
            console.error('Error fetching teams:', err);
            Swal.fire({ icon: "error", title: "Error", text: "Failed to load teams." });
        });

    // Function to create a role row
    const createRoleRow = () => {
        const options = teams.map(team => `<option value="${team.id}">${team.name}</option>`).join('');
        return `
            <div class="role-row d-flex gap-2 align-items-center mb-2">
                <input type="text" class="form-control role-name me-3" placeholder="Role Name" required>
                <select class="form-control role-team mx-3" required>
                    <option value="">Assign Role</option>
                    ${options}
                </select>
                <button type="button" class="btn btn-danger remove-role ms-2">Remove</button>
            </div>
        `;
    };

    const addRoleRow = () => {
        const container = document.getElementById('roles-container');
        container.insertAdjacentHTML('beforeend', createRoleRow());
    };

    document.getElementById('addRoleBtn').addEventListener('click', addRoleRow);

    // Handle Remove Role buttons
    document.getElementById('roles-container').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-role')) {
            e.target.closest('.role-row').remove();
        }
    });

    // Handle Add Service with FormData
    document.getElementById('addService').addEventListener('click', function () {
        const roles = Array.from(document.querySelectorAll('.role-row')).map(row => ({
            name: row.querySelector('.role-name').value,
            team_id: row.querySelector('.role-team').value
        }));

        const payload = {
            name: document.getElementById('name').value,
            description: window.ictEditorInstance.getData(),
            roles
        };

        Swal.fire({
            title: "Add Information?",
            text: "Do you want to create this new information?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create"
        }).then(result => {
            if (result.isConfirmed) {
                Loader.show();
                fetch('/api/fintech', {
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
                                title: "Added",
                                text: data.message || ""
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
                    .catch(error => {
                        console.error('Error:', error);
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

    // Show modal
    var modalEl = document.getElementById('myModal');
    var bsModal = new bootstrap.Modal(modalEl);
    bsModal.show();
});

// =============================
// Edit Service Button
// =============================
document.getElementById('editFintechBtn')?.addEventListener('click', function () {
        const fintechId = this.dataset.fintechId;
        const fintechName = this.dataset.fintechName;
        const fintechDescription = this.dataset.fintechDescription;
        const fintechRoles = JSON.parse(this.dataset.fintechRoles || "[]");

        document.querySelector('#myModal .modal-title').textContent = 'Edit Info';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="editServiceForm" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" id="name" name="name" value="${fintechName}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="7" required>${fintechDescription}</textarea>
                </div>
                <div class="form-group">
                    <label>Roles</label>
                    <div id="edit-roles-container"></div>
                    <button type="button" class="btn btn-primary mt-2" id="editAddRoleBtn">Add Role</button>
                </div>
            </form>
        `;

        ClassicEditor
            .create(document.querySelector('#description'), {
            ckfinder: {
                uploadUrl: '/ckeditor/upload?_token=' + csrf
            },
            image: {
                upload: {
                    types: ['jpeg', 'png', 'jpg', 'gif', 'webp']
                }
            }
        })
            .then(editor => window.ictEditorInstance = editor)
            .catch(err => console.error(err));

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="updateService">Update</button>
        `;

        let teams = [];

        // Fetch teams first
        fetch('/api/team')
            .then(res => res.json())
            .then(data => {
                teams = (data.data || [])
                .sort((a, b) => a.name.localeCompare(b.name));

                const renderRoleRow = (role = {}) => {
                    const options = teams.map(t => `
                        <option value="${t.id}" ${t.id == role.team_id ? "selected" : ""}>${t.name}</option>
                    `).join('');

                    return `
                        <div class="role-row d-flex gap-2 align-items-center mb-2">
                            <input type="text" class="form-control role-name me-3" value="${role.name || ""}" placeholder="Role Name" required>
                            <select class="form-control role-team mx-3" required>
                                <option value="">Assign Role</option>
                                ${options}
                            </select>
                            <button type="button" class="btn btn-danger remove-role ms-2">Remove</button>
                        </div>
                    `;
                };

                const container = document.getElementById('edit-roles-container');

                // Load existing roles
                fintechRoles.forEach(role => {
                    container.insertAdjacentHTML('beforeend', renderRoleRow(role));
                });

                // Add new role
                document.getElementById('editAddRoleBtn').addEventListener('click', () => {
                    container.insertAdjacentHTML('beforeend', renderRoleRow());
                });

                // Remove role
                container.addEventListener('click', e => {
                    if (e.target.classList.contains('remove-role')) {
                        e.target.closest('.role-row').remove();
                    }
                });

                // Submit Update
                document.getElementById('updateService').addEventListener('click', function () {
                    const roles = [...document.querySelectorAll('#edit-roles-container .role-row')].map(row => ({
                        name: row.querySelector('.role-name').value,
                        team_id: row.querySelector('.role-team').value
                    }));
                    const payload = {
                        name: document.getElementById('name').value,
                        description: window.ictEditorInstance.getData(),
                        roles
                    };

                    Swal.fire({
                        title: "Update?",
                        text: "Do you want to update this info?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, update"
                    }).then(result => {
                        if (result.isConfirmed) {
                            Loader.show();
                            fetch(`/api/fintech/${fintechId}`, {
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
                                            title: "Updated",
                                            text: data.message || ""
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
                                .catch(error => {
                                    console.error('Error:', error);
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

            });

        // Show modal
        var modalEl = document.getElementById('myModal');
        var bsModal = new bootstrap.Modal(modalEl);
        bsModal.show();
    });

// =============================
// Delete Service Button
// =============================
document.querySelectorAll('.delete-service-btn').forEach(button => {
    button.addEventListener('click', function () {
        const serviceId = this.dataset.serviceId;
        const serviceName = this.dataset.serviceName;

        Swal.fire({
            title: "Delete Service?",
            text: `Are you sure you want to delete "${serviceName}"? This action cannot be undone.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.isConfirmed) {
                Loader.show();
                fetch(`/api/service/${serviceId}`, {
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
                                title: "Deleted",
                                text: data.message || "Service Deleted successfully!"
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
                    .catch(error => {
                        console.error('Error:', error);
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
});