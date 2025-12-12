// =====================================
// CSRF Token
// =====================================
const csrf = document.querySelector('input[name="_token"]')?.value;

function formatErrors(errors) {
    if (!errors) return "";
    if (typeof errors === "string") return errors;
    return Object.values(errors).flat().join("\n");
}

// =====================================
// ADD CLUB
// =====================================
document.getElementById('addClubBtn').addEventListener('click', function () {

    document.querySelector('#myModal .modal-title').textContent = 'Add New Club';

    document.querySelector('#myModal .modal-body').innerHTML = `
    <form id="addClubForm" autocomplete="off">
        <div class="form-group">
            <label>Club Name</label>
            <input type="text" class="form-control" id="club_name" required>
        </div>

        <div class="form-group">
            <label>Logo</label>
            <input type="file" class="form-control" id="clubLogo" accept="image/*" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="club_description"></textarea>
        </div>

        <div class="form-group">
            <label>Roles</label>
            <div id="roles-container"></div>
            <button type="button" class="btn btn-primary mt-2" id="addRoleBtn">Add Role</button>
        </div>
    </form>
    `;

    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" id="addClub">Add Club</button>
    `;

    ClassicEditor
        .create(document.querySelector('#club_description'))
        .then(editor => window.clubEditor = editor);

    let teams = [];

    fetch('/api/team')
        .then(res => res.json())
        .then(data => {
            teams = data.data || [];
            addRoleRow();
        });

    const createRoleRow = () => `
        <div class="role-row d-flex gap-2 mb-2">
            <input type="text" class="form-control role-name me-3" placeholder="Role Name" required>
            <select class="form-control role-team mx-3" required>
                <option value="">Assign Role</option>
                ${teams.map(t => `<option value="${t.id}">${t.name}</option>`).join("")}
            </select>
            <button type="button" class="btn btn-danger remove-role">Remove</button>
        </div>
    `;

    const addRoleRow = () =>
        document.getElementById("roles-container")
            .insertAdjacentHTML("beforeend", createRoleRow());

    document.getElementById("addRoleBtn").addEventListener("click", addRoleRow);

    document.getElementById("roles-container").addEventListener("click", e => {
        if (e.target.classList.contains("remove-role")) {
            e.target.closest(".role-row").remove();
        }
    });

    document.getElementById("addClub").addEventListener("click", function () {

        const logoInput = document.getElementById("clubLogo");
        if (!logoInput.files.length) {
            Swal.fire("Error", "Club logo is required", "error");
            return;
        }

        const formData = new FormData();
        formData.append("name", document.getElementById("club_name").value);
        formData.append("description", window.clubEditor.getData());
        formData.append("logo", logoInput.files[0]);

        const roles = [...document.querySelectorAll('.role-row')].map(row => ({
            name: row.querySelector('.role-name').value,
            team_id: row.querySelector('.role-team').value
        }));

        roles.forEach((role, index) => {
            formData.append(`roles[${index}][name]`, role.name);
            formData.append(`roles[${index}][team_id]`, role.team_id);
        });

        Swal.fire({
            title: "Add Club?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Create Club",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then(result => {
            if (result.isConfirmed) {
                fetch("/api/club", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Success", data.message, "success");
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        Swal.fire("Failed", formatErrors(data.errors || data.message), "error");
                    }
                });
            }
        });
    });

    new bootstrap.Modal(document.getElementById('myModal')).show();
});

// =====================================
// EDIT CLUB
// =====================================
document.querySelectorAll('.edit-club-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        const clubId = this.dataset.clubId;
        const clubName = this.dataset.clubName;
        const clubDescription = this.dataset.clubDescription;
        const clubLogo = this.dataset.clubLogo;
        const clubRoles = JSON.parse(this.dataset.clubRoles || "[]");

        document.querySelector('#myModal .modal-title').textContent = 'Edit Club';

        document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="editClubForm" autocomplete="off">
            <div class="form-group">
                <label>Club Name</label>
                <input type="text" class="form-control" id="edit_club_name" value="${clubName}" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="edit_club_description">${clubDescription}</textarea>
            </div>

            <div class="form-group">
                <label>Current Logo</label><br>
                <img src="${clubLogo}" width="80" class="mb-2"><br>
                <input type="file" class="form-control" id="edit_club_logo" accept="image/*">
                <small class="text-muted">Upload only if you want to replace the logo</small>
            </div>

            <div class="form-group">
                <label>Roles</label>
                <div id="edit-roles-container"></div>
                <button type="button" class="btn btn-primary mt-2" id="editAddRoleBtn">Add Role</button>
            </div>
        </form>
        `;

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="updateClubBtn">Update Club</button>
        `;

        ClassicEditor
            .create(document.querySelector('#edit_club_description'))
            .then(editor => window.clubEditor = editor);

        let teams = [];

        fetch('/api/team')
            .then(res => res.json())
            .then(data => {
                teams = data.data || [];

                const renderRoleRow = (role = {}) => `
                    <div class="role-row d-flex gap-2 mb-2">
                        <input type="text" class="form-control role-name me-3" value="${role.name || ""}" required>
                        <select class="form-control role-team mx-3" required>
                            <option value="">Assign Role</option>
                            ${teams.map(t => `
                                <option value="${t.id}" ${t.id == role.team_id ? "selected" : ""}>${t.name}</option>
                            `).join("")}
                        </select>
                        <button type="button" class="btn btn-danger remove-role">Remove</button>
                    </div>
                `;

                const container = document.getElementById("edit-roles-container");
                clubRoles.forEach(r => container.insertAdjacentHTML("beforeend", renderRoleRow(r)));

                document.getElementById("editAddRoleBtn")
                    .addEventListener("click", () =>
                        container.insertAdjacentHTML("beforeend", renderRoleRow())
                    );

                container.addEventListener("click", e => {
                    if (e.target.classList.contains("remove-role")) {
                        e.target.closest(".role-row").remove();
                    }
                });

                document.getElementById("updateClubBtn").addEventListener("click", function () {

                    const formData = new FormData();
                    formData.append("name", document.getElementById("edit_club_name").value);
                    formData.append("description", window.clubEditor.getData());
                    formData.append("_method", "PUT");

                    const logoInput = document.getElementById("edit_club_logo");
                    if (logoInput.files.length) {
                        formData.append("logo", logoInput.files[0]);
                    }

                    const roles = [...document.querySelectorAll('#edit-roles-container .role-row')].map(row => ({
                        name: row.querySelector('.role-name').value,
                        team_id: row.querySelector('.role-team').value
                    }));

                    roles.forEach((role, index) => {
                        formData.append(`roles[${index}][name]`, role.name);
                        formData.append(`roles[${index}][team_id]`, role.team_id);
                    });

                    Swal.fire({
                        title: "Update Club?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Update Club",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                    }).then(result => {
                        if (result.isConfirmed) {
                            fetch(`/api/club/${clubId}`, {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": csrf,
                                    "Accept": "application/json"
                                },
                                body: formData
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire("Updated", data.message, "success");
                                    setTimeout(() => location.reload(), 1200);
                                } else {
                                    Swal.fire("Failed", formatErrors(data.errors || data.message), "error");
                                }
                            });
                        }
                    });
                });
            });

        new bootstrap.Modal(document.getElementById('myModal')).show();
    });
});

// =====================================
// DELETE CLUB
// =====================================
document.querySelectorAll('.delete-club-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        const clubId = this.dataset.clubId;
        const clubName = this.dataset.clubName;

        Swal.fire({
            title: `Delete ${clubName}?`,
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Delete",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
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
                        Swal.fire("Deleted", data.message, "success");
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        Swal.fire("Failed", formatErrors(data.errors || data.message), "error");
                    }
                });
            }
        });
    });
});
