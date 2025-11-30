const csrf = document.querySelector('input[name="_token"]').value;

function formatErrors(errors) {
    if (!errors) return "";
    if (typeof errors === "string") return errors;

    // If errors is an object (like Laravel validation errors)
    return Object.values(errors)
        .flat()
        .join("\n");
}
// =====================
// Add Club Modal Logic
// =====================
document.getElementById('addClubBtn').addEventListener('click', function () {
    document.querySelector('#myModal .modal-title').textContent = 'Add New Club';

    // Modal body
    document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="addClubForm" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="club_name">Club Name</label>
                <input type="text" class="form-control" id="club_name" name="club_name" required>
            </div>
            <div class="form-group">
                <label for="club_description">Description</label>
                <textarea class="form-control" id="club_description" name="club_description" rows="5" required></textarea>
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

    // Modal footer
    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="addClub">Add Club</button>
    `;

    let teams = [];

    // Fetch teams from API
    fetch('/api/team')
        .then(res => res.json())
        .then(data => {
            teams = data.data || [];
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

    // Handle Add Club submission
    document.getElementById('addClub').addEventListener('click', function () {
        const clubName = document.getElementById('club_name').value;
        const clubDescription = document.getElementById('club_description').value;

        // Gather roles
        const roles = Array.from(document.querySelectorAll('.role-row')).map(row => ({
            name: row.querySelector('.role-name').value,
            team_id: row.querySelector('.role-team').value
        }));

        const payload = { name: clubName, description: clubDescription, roles };

        Swal.fire({
            title: "Add Club?",
            text: "Do you want to create this new club?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create"
        }).then(result => {
            if (result.isConfirmed) {
                fetch('/api/club', {
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
                                title: "New Club Added",
                                text: data.message || "New Club Added successfully!"
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
                        Swal.fire({ icon: "error", title: "Error", text: "Something went wrong!" });
                    });
            }
        });
    });

    // Show modal
    const modalEl = document.getElementById('myModal');
    const bsModal = new bootstrap.Modal(modalEl);
    bsModal.show();
});

// =====================
// Edit Club Logic
// =====================
document.querySelectorAll('.edit-club-btn').forEach(button => {
    button.addEventListener('click', function () {

        const clubId = this.dataset.clubId;
        const clubName = this.dataset.clubName;
        const clubDescription = this.dataset.clubDescription;
        const clubRoles = JSON.parse(this.dataset.clubRoles || "[]");

        document.querySelector('#myModal .modal-title').textContent = 'Edit Club';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="editClubForm" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <label>Club Name</label>
                    <input type="text" class="form-control" id="edit_club_name" value="${clubName}" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="edit_club_description" rows="5" required>${clubDescription}</textarea>
                </div>

                <div class="form-group">
                    <label>Roles</label>
                    <div id="edit-roles-container"></div>
                    <button type="button" class="btn btn-primary mt-2" id="editAddRoleBtn">Add Role</button>
                </div>
            </form>
        `;

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="updateClubBtn">Update Club</button>
        `;

        let teams = [];

        // Fetch teams first
        fetch('/api/team')
            .then(res => res.json())
            .then(data => {
                teams = data.data || [];

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
                clubRoles.forEach(role => {
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
                document.getElementById('updateClubBtn').addEventListener('click', () => {
                    const updatedName = document.getElementById('edit_club_name').value;
                    const updatedDescription = document.getElementById('edit_club_description').value;

                    const roles = [...document.querySelectorAll('#edit-roles-container .role-row')].map(row => ({
                        name: row.querySelector('.role-name').value,
                        team_id: row.querySelector('.role-team').value
                    }));

                    Swal.fire({
                        title: "Update Club?",
                        text: "Do you want to save changes?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Update",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                    }).then(result => {
                        if (result.isConfirmed) {
                            fetch(`/api/club/${clubId}`, {
                                method: "PUT",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": csrf
                                },
                                body: JSON.stringify({
                                    name: updatedName,
                                    description: updatedDescription,
                                    roles: roles
                                })
                            })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Updated",
                                            text: data.message || "Club Updated successfully!"
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
                        }
                    });
                });

            });

        // Show modal
        new bootstrap.Modal(document.getElementById('myModal')).show();
    });
});

// =====================
// Delete Club Logic
// =====================
document.querySelectorAll('.delete-club-btn').forEach(button => {
    button.addEventListener('click', function () {
        const clubId = this.dataset.clubId;
        const clubName = this.dataset.clubName;

        Swal.fire({
            title: `Delete ${clubName}?`,
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete"
        }).then(result => {
            if (result.isConfirmed) {
                fetch(`/api/club/${clubId}`, {
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
                                title: "Club Deleted",
                                text: data.message || "Club Deleted successfully!"
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
                    .catch(err => {
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

