// GLOBAL CSRF TOKEN FROM META
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
// Add Admin Modal Logic
// =====================
document.getElementById('addAdminBtn').addEventListener('click', function () {

    document.querySelector('#myModal .modal-title').textContent = 'Add Admin';

    // NO @csrf here — JS handles CSRF
    document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="addAdminForm" autocomplete="off">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="contact_no">Contact Number</label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" required>
            </div>

            <input type="hidden" name="enabled" value="true">
        </form>
    `;

    document.querySelector('#myModal .modal-footer').innerHTML = `
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-success" id="addAdmin">Register</button>
    `;

    // Handle Add admin with JSON
    document.getElementById('addAdmin').addEventListener('click', function () {

        // let form = document.getElementById('addAdminForm');
        // let formData = new FormData(form);
        const payload = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            contact_no: document.getElementById('contact_no').value,
            enabled: true,
            role: 'Admin'
        };
        Swal.fire({
            title: "Register Admin?",
            text: "Do you want to create this new admin account?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create"
        }).then(result => {
            if (result.isConfirmed) {
                Loader.show();
                fetch('/api/users', {
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
                                title: "Registered",
                                text: data.message || "Admin Added successfully!"
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
            }
        });
    });

    // Show modal
    var modalEl = document.getElementById('myModal');
    var bsModal = new bootstrap.Modal(modalEl);
    bsModal.show();
});


// =============================
// Enable / Disable User Button
// =============================
document.querySelectorAll('.toggle-user-form').forEach(formEl => {

    formEl.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(formEl);
        const action = formEl.action;
        const button = formEl.querySelector("button");
        const actionText = button.textContent.trim();
        const userName = formEl.dataset.username;

        Swal.fire({
            title: `${actionText} User?`,
            text: `Do you want to ${actionText.toLowerCase()} ${userName}?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: `Yes, ${actionText}`,
            cancelButtonText: 'Cancel',
            cancelButtonColor: "#d33",
            confirmButtonColor: actionText === "Disable" ? "#F48423" : "#349901",
        }).then(result => {
            if (result.isConfirmed) {
                Loader.show();
                fetch(action, {
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
                            Swal.fire({
                                icon: "success",
                                title: `${actionText}d`,
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
                    .finally(() => Loader.hide());
            }
        });
    });
});