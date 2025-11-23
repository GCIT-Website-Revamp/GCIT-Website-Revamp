// =====================================
// CSRF Token
// =====================================
const csrf = document.querySelector('input[name="_token"]')?.value;

function formatErrors(errors) {
    if (!errors) return "";
    if (typeof errors === "string") return errors;

    // If errors is an object (like Laravel validation errors)
    return Object.values(errors)
        .flat()
        .join("\n");
}

// =====================================
// Add Team
// =====================================
document.getElementById('addTeamBtn').addEventListener('click', function () {
    document.querySelector('#myModal .modal-title').textContent = 'Add New Team';

    document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="teamForm">
            <div class="form-group">
                <label for="teamName">Name</label>
                <input type="text" class="form-control" id="teamName" required>
            </div>

            <div class="form-group">
                <label for="teamDescription">Description</label>
                <textarea class="form-control" id="teamDescription" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label for="teamType">Type</label>
                <select class="form-control" id="teamType">
                    <option value="" disabled selected>Select type</option>
                    <option value="Academic">Academic</option>
                    <option value="Non-Academic">Non-Academic</option>
                </select>
            </div>

            <div class="form-group">
                <label for="teamImage">Image</label>
                <input type="file" class="form-control" id="teamImage" accept="image/*" required>
            </div>
        </form>
    `;

    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" id="saveTeamBtn">Add</button>
    `;

    const modal = new bootstrap.Modal(document.getElementById('myModal'));
    modal.show();

    // SAVE TEAM
    document.getElementById('saveTeamBtn').addEventListener('click', () => saveOrUpdateTeam(false));
});

// =====================================
// Edit Team
// =====================================
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const name = this.dataset.name;
        const type = this.dataset.type;
        const description = this.dataset.description;
        const image = this.dataset.image;

        document.querySelector('#myModal .modal-title').textContent = 'Edit Team';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="teamForm">
                <div class="form-group">
                    <label>Team Name</label>
                    <input type="text" class="form-control" id="teamName" value="${name}">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="teamDescription">${description}</textarea>
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" id="teamType">
                        <option value="Academic" ${type === "Academic" ? "selected" : ""}>Academic</option>
                        <option value="Non-Academic" ${type === "Non-Academic" ? "selected" : ""}>Non-Academic</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="${image}" width="50" class="mb-2">
                    <input type="file" class="form-control" id="teamImage" accept="image/*">
                </div>
            </form>
        `;

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="updateTeamBtn">Update</button>
        `;

        const modal = new bootstrap.Modal(document.getElementById('myModal'));
        modal.show();

        document.getElementById('updateTeamBtn').addEventListener('click', () => saveOrUpdateTeam(true, `${id}`));
    });
});

// =====================================
// Save or Update Team Helper
// =====================================
function saveOrUpdateTeam(isEdit = false, id = null) {
    const formData = new FormData();
    formData.append("name", document.getElementById("teamName").value);
    formData.append("description", document.getElementById("teamDescription").value);
    formData.append("type", document.getElementById("teamType").value);
    if (isEdit) {
        formData.append("_method", "PUT");
    }
    const fileInput = document.getElementById("teamImage");
    if (fileInput.files[0]) formData.append("image", fileInput.files[0]);

    // Determine method and URL
    const url = isEdit ? `/api/team/${id}` : "/api/team";
    const actionText = isEdit ? "Update" : "Add";

    Swal.fire({
        title: `${actionText} Team?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: actionText,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
    }).then(result => {
        if (result.isConfirmed) {
            fetch(url, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf, "Accept": "application/json" },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: isEdit ? "Updated" : "Added",
                            text: data.message
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
                    console.error(err);
                    Swal.fire({ icon: "error", title: "Error", text: "Something went wrong!" });
                });
        }
    });
}

// =====================================
// Delete Team (with fetch + confirmation)
// =====================================
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;

        Swal.fire({
            title: "Are you absolutely sure?",
            text: "This team will be permanently deleted.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33"
        }).then(result => {
            if (result.isConfirmed) {
                fetch(`/api/team/${id}`, {
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
                                text: data.message || "Team Deleted successfully!"
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
                            text: "Something went wrong while deleting."
                        });
                    });
            }
        });
    });
});
