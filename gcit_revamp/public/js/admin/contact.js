const csrf = document.querySelector('input[name="_token"]').value;

document.querySelectorAll('.contact-row').forEach(btn => {
    btn.addEventListener('click', function () {

        const firstName = this.dataset.firstName || '';
        const lastName = this.dataset.lastName || '';
        const email = this.dataset.email || '';
        const contactNumber = this.dataset.contactNumber || '—';
        const type = this.dataset.type || '';
        const message = this.dataset.message || '';

        document.querySelector('#myModal .modal-title').textContent = 'Contact Details';

        document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="editClubForm" autocomplete="off">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" value="${firstName}" readOnly>
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" value="${lastName}" readOnly>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="${email}" readOnly>
            </div>

            <div class="form-group">
                <label>Contact Number</label>
                <input type="tel" class="form-control" value="${contactNumber}" readOnly>
            </div>

            <div class="form-group">
                <label>Type</label>
                <input type="text" class="form-control" value="${type}" readOnly>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="10" id="edit_club_description" readOnly>${message}</textarea>
            </div>

            
        </form>
        `;
        new bootstrap.Modal(document.getElementById('myModal')).show();
    });
});
// =====================
// Update Contact Status
// =====================
document.querySelectorAll('.edit-contact-btn').forEach(button => {
    button.addEventListener('click', function () {

        const contactId = this.dataset.contactId;
        const contactName = this.dataset.contactName;
        const contactEmail = this.dataset.contactEmail;
        const contactMessage = this.dataset.contactMessage;
        const contactStatus = this.dataset.contactStatus === "Read" ? "Unread" : "Read";

        Swal.fire({
            title: `Mark as Read?`,
            text: `Mark message from ${contactName} as Read?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update"
        }).then(result => {
            if (result.isConfirmed) {

                fetch(`/api/contact/${contactId}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json",
                    },
                    body: JSON.stringify({
                        status: contactStatus,
                        name: contactName,
                        email: contactEmail,
                        message: contactMessage
                    })
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? "success" : "error",
                        title: data.success ? "Updated!" : "Failed",
                        text: data.message
                    });

                    if (data.success) {
                        setTimeout(() => location.reload(), 1200);
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


// =====================
// Delete Contact Logic
// =====================
document.querySelectorAll('.delete-contact-btn').forEach(button => {
    button.addEventListener('click', function () {

        const contactId = this.dataset.contactId;

        Swal.fire({
            title: "Delete Contact?",
            text: "This message will be permanently deleted.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete"
        }).then(result => {
            if (result.isConfirmed) {

                fetch(`/api/contact/${contactId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json",
                    }
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? "success" : "error",
                        title: data.success ? "Deleted!" : "Failed",
                        text: data.message
                    });

                    if (data.success) {
                        setTimeout(() => location.reload(), 1200);
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
