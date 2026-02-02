// =====================================
// CSRF Token
// =====================================
const csrf = document.querySelector('input[name="_token"]')?.value;
window.Loader = {
    show() {
        document.getElementById('global-loader')?.style.setProperty('display', 'flex');
    },
    hide() {
        document.getElementById('global-loader')?.style.setProperty('display', 'none');
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const teamSearchInput = document.getElementById('teamSearch');
    if (!teamSearchInput) return;

    const teamTableBody = teamSearchInput
        .closest('.white_shd')
        .querySelector('table tbody');

    const originalTeamRows = teamTableBody.innerHTML;

    teamSearchInput.addEventListener('input', function () {
        const query = this.value.trim();

        // Restore original table when empty
        if (query.length === 0) {
            teamTableBody.innerHTML = originalTeamRows;
            return;
        }
        Loader.show();
        fetch(`/api/team-search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;

                teamTableBody.innerHTML = '';

                if (!data.data.length) {
                    teamTableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center">No matching team members found</td>
                        </tr>
                    `;
                    return;
                }

                data.data.forEach((team, index) => {
                    // Format departments for display (assuming departments are stored as comma-separated string)
                    const departments = team.departments || team.department || '';
                    const departmentDisplay = departments.split(',').map(dept => 
                        `<span class="badge bg-primary me-1">${dept.trim()}</span>`
                    ).join('');
                    
                    teamTableBody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${team.name}</td>
                            <td>
                                <img src="/storage/${team.image}" width="80" class="rounded">
                            </td>
                            <td>${team.description || '-'}</td>
                            <td style="max-width: 80px;">
                                <button class="btn btn-success edit-btn"
                                    data-id="${team.id}"
                                    data-name="${team.name}"
                                    data-type="${team.type}"
                                    data-departments="${team.departments ?? []}"
                                    data-title="${team.title || ''}"
                                    data-qualifications="${team.qualification || ''}"
                                    data-description="${team.description || ''}"
                                    data-image="/storage/${team.image}">
                                    Edit
                                </button>

                                <button class="btn btn-danger delete-btn"
                                    data-id="${team.id}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(err => console.error('Team search error:', err))
            .finally(() => Loader.hide());
    });
});

function formatErrors(errors) {
    if (!errors) return "";
    if (typeof errors === "string") return errors;

    // If errors is an object (like Laravel validation errors)
    return Object.values(errors)
        .flat()
        .join("\n");
}

// Department options array
const DEPARTMENT_OPTIONS = [
    'AI Department', 
    'Blockchain Department',
    'Cyber Security Department',
    'Fullstack Department',
    'Interactive Design & Development',
    'Faculty Leadership Team'
];

function generateDepartmentCheckboxes(selectedDepartments = []) {
    let selectedArray = [];

    if (Array.isArray(selectedDepartments)) {
        selectedArray = selectedDepartments;
    } else if (typeof selectedDepartments === 'string') {
        selectedArray = selectedDepartments
            .split(',')
            .map(d => d.trim())
            .filter(Boolean);
    }

    return DEPARTMENT_OPTIONS.map(department => `
        <div class="form-check mb-2">
            <input class="form-check-input department-checkbox"
                   type="checkbox"
                   value="${department}"
                   id="dept-${department.replace(/\s+/g, '-').toLowerCase()}"
                   ${selectedArray.includes(department) ? 'checked' : ''}>
            <label class="form-check-label" for="dept-${department.replace(/\s+/g, '-').toLowerCase()}">
                ${department}
            </label>
        </div>
    `).join('');
}

// Helper function to get selected departments
function getSelectedDepartments() {
    return Array.from(
        document.querySelectorAll('.department-checkbox:checked')
    ).map(cb => cb.value);
}

// =====================================
// Add Team
// =====================================
document.getElementById('addTeamBtn').addEventListener('click', function () {
    document.querySelector('#myModal .modal-title').textContent = 'Add New Team';

    document.querySelector('#myModal .modal-body').innerHTML = `
    <form id="teamForm" autocomplete="off">
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

        <div class="form-group" id="departmentGroup" style="display:none;">
            <label>Departments</label>
            <div class="border rounded p-3 bg-light" id="departmentCheckboxes">
                ${generateDepartmentCheckboxes()}
            </div>
            <small class="form-text text-muted">Select one or more departments</small>
        </div>

        <!-- Title field (hidden initially) -->
        <div class="form-group" id="titleGroup" style="display:none;">
            <label for="teamTitle">Title</label>
            <input type="text" class="form-control" id="teamTitle">
        </div>

        <div class="form-group" id="qualificationsGroup" style="display:none;">
            <label for="teamQualifications">Qualifications</label>
            <textarea class="form-control" id="teamQualifications" rows="2"></textarea>
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
    attachTypeToggle();
    // SAVE TEAM
    document.getElementById('saveTeamBtn').addEventListener('click', () => saveOrUpdateTeam(false));
});

// =====================================
// Edit Team
// =====================================
document.addEventListener('click', function (e) {
    const editBtn = e.target.closest('.edit-btn');
    if (editBtn) {
        const id = editBtn.dataset.id;
        const name = editBtn.dataset.name;
        const type = editBtn.dataset.type;
        const description = editBtn.dataset.description;
        const image = editBtn.dataset.image;
        let departments = [];
        try {
            departments = JSON.parse(editBtn.dataset.departments || '[]');
        } catch (e) {
            departments = [];
        }

        document.querySelector('#myModal .modal-title').textContent = 'Edit Team';

        document.querySelector('#myModal .modal-body').innerHTML = `
    <form id="teamForm" autocomplete="off">
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

        <div class="form-group" id="departmentGroup" style="display:${type === "Academic" ? "block" : "none"};">
            <label>Departments</label>
            <div class="border rounded p-3 bg-light" id="departmentCheckboxes">
                ${generateDepartmentCheckboxes(departments)}
            </div>
            <small class="form-text text-muted">Select one or more departments</small>
        </div>

        <div class="form-group" id="titleGroup" style="display:${type === "Academic" ? "block" : "none"};">
            <label>Title</label>
            <input type="text" class="form-control" id="teamTitle" value="${editBtn.dataset.title || ''}">
        </div>

        <div class="form-group" id="qualificationsGroup" style="display:${type === "Academic" ? "block" : "none"};">
            <label for="teamQualifications">Qualifications</label>
            <textarea class="form-control" id="teamQualifications" rows="2">${editBtn.dataset.qualifications || ''}</textarea>
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
        attachTypeToggle();
        document.getElementById('updateTeamBtn').addEventListener('click', () => saveOrUpdateTeam(true, `${id}`));
    }
});

// =====================================
// Save or Update Team Helper
// =====================================
function saveOrUpdateTeam(isEdit = false, id = null) {
    const formData = new FormData();
    formData.append("name", document.getElementById("teamName").value);
    formData.append("description", document.getElementById("teamDescription").value);
    formData.append("type", document.getElementById("teamType").value);
    
    // Get selected departments (only for Academic type)
    formData.append("category", JSON.stringify(getSelectedDepartments()));
    
    formData.append("title", document.getElementById("teamTitle").value);
    formData.append("qualification", document.getElementById("teamQualifications").value);
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
            Loader.show();
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
                })
                .finally(() => Loader.hide());
        }
    });
}

// =====================================
// Delete Team (with fetch + confirmation)
// =====================================
document.addEventListener('click', function (e) {
    const deleteBtn = e.target.closest('.delete-btn');
    const id = deleteBtn.dataset.id;

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
            Loader.show();
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
                })
                .finally(() => Loader.hide());
        }
    });
});

function attachTypeToggle() {
    const typeSelect = document.getElementById("teamType");
    const titleGroup = document.getElementById("titleGroup");
    const departmentGroup = document.getElementById("departmentGroup");
    const qualifications = document.getElementById("qualificationsGroup");

    if (!typeSelect) return; // safety

    typeSelect.addEventListener("change", function () {
        if (this.value === "Academic") {
            titleGroup.style.display = "block";
            departmentGroup.style.display = "block";
            qualifications.style.display = "block";
        } else {
            titleGroup.style.display = "none";
            document.getElementById("teamTitle").value = "";
            departmentGroup.style.display = "none";
            // Uncheck all checkboxes for non-academic
            document.querySelectorAll('.department-checkbox').forEach(cb => cb.checked = false);
            qualifications.style.display = "none";
            document.getElementById("teamQualifications").value = "";
        }
    });
}