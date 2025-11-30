const csrf = document.querySelector('input[name="_token"]')?.value;

function formatErrors(errors) {
    if (!errors) return "";
    if (typeof errors === "string") return errors;

    // If errors is an object (like Laravel validation errors)
    return Object.values(errors)
        .flat()
        .join("\n");
}

// Helper to open modal
function openModal(title, bodyHtml, footerHtml) {
    document.querySelector('#myModal .modal-title').innerHTML = title;
    document.querySelector('#myModal .modal-body').innerHTML = bodyHtml;
    document.querySelector('#myModal .modal-footer').innerHTML = footerHtml;

    const modal = new bootstrap.Modal(document.getElementById('myModal'));
    modal.show();
}

// Helper to confirm + perform API request
function confirmAction(title, message, apiCall) {
    Swal.fire({
        title,
        text: message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then(result => {
        if (result.isConfirmed) {
            apiCall()
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: title,
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
                .catch(err => {
                    console.error(err);
                    Swal.fire({ icon: "error", title: "Error", text: "Unexpected error occurred." });
                });
        }
    });
}

// ===============================
// ADD EVENT (News & Events)
// ===============================
document.getElementById('addEventBtn').addEventListener('click', () => {
    openModal(
        "Add News & Event",
        `
            <form id="eventForm" autocomplete="off">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="event_name" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Image</label>
                    <input type="file" id="event_image" class="form-control" accept="image/*" required>
                </div>

                <div class="form-group mt-2">
                    <label>Date</label>
                    <input type="date" id="event_date" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Description</label>
                    <textarea id="event_description" class="form-control" rows="5"></textarea>
                </div>
            </form>
        `,
        `
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="saveEvent">Save</button>
        `
    );

    document.getElementById('saveEvent').addEventListener('click', () => {
        const formData = new FormData();
        formData.append("name", document.getElementById('event_name').value);
        formData.append("date", document.getElementById('event_date').value);
        formData.append("description", document.getElementById('event_description').value);
        formData.append("image", document.getElementById('event_image').files[0]);

        confirmAction("Add Event?", "Do you want to add this event?", () =>
            fetch("/api/event", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf },
                body: formData
            })
        );
    });
});

// ===============================
// EDIT EVENT
// ===============================
document.querySelectorAll('.edit-event-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.eventId;

        openModal(
            "Edit Event",
            `
                <form id="editEventForm" autocomplete="off">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="event_name" class="form-control" value="${btn.dataset.eventName}" required>
                    </div>

                    <div class="form-group mt-2">
                        <label>Replace Image (optional)</label>
                        <input type="file" id="event_image" class="form-control" accept="image/*">
                        <img src="${btn.dataset.eventImage}" width="80" class="mt-2" />
                    </div>

                    <div class="form-group mt-2">
                        <label>Date</label>
                        <input type="date" id="event_date" class="form-control" value="${btn.dataset.eventDate}" required>
                    </div>

                    <div class="form-group mt-2">
                        <label>Description</label>
                        <textarea id="event_description" class="form-control" rows="5">${btn.dataset.eventDescription || ""}</textarea>
                    </div>
                </form>
            `,
            `
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button class="btn btn-success" id="updateEvent">Update</button>
            `
        );

        document.getElementById('updateEvent').addEventListener('click', () => {
            const formData = new FormData();
            formData.append("name", document.getElementById('event_name').value);
            formData.append("date", document.getElementById('event_date').value);
            formData.append("description", document.getElementById('event_description').value);

            const img = document.getElementById('event_image').files[0];
            if (img) formData.append("image", img);
            formData.append('_method', 'PUT');
            confirmAction("Update Event?", "Do you want to save changes?", () =>
                fetch(`/api/event/${id}`, {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": csrf },
                    body: formData
                })
            );
        });
    });
});

// ===============================
// DELETE EVENT
// ===============================
document.querySelectorAll('.delete-event-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.eventId;

        confirmAction("Delete Event?", "This action cannot be undone.", () =>
            fetch(`/api/event/${id}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": csrf }
            })
        );
    });
});

// ===============================
// ADD ANNOUNCEMENT
// ===============================
document.getElementById('addAnnouncementBtn').addEventListener('click', () => {
    openModal(
        "Add Announcement",
        `
            <form id="announcementForm" autocomplete="off">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="announcement_name" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Date</label>
                    <input type="date" id="announcement_date" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Description</label>
                    <textarea id="announcement_description" class="form-control" rows="5"></textarea>
                </div>
            </form>
        `,
        `
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="saveAnnouncement">Save</button>
        `
    );

    document.getElementById('saveAnnouncement').addEventListener('click', () => {
        const payload = {
            name: document.getElementById('announcement_name').value,
            date: document.getElementById('announcement_date').value,
            description: document.getElementById('announcement_description').value,
        };

        confirmAction("Add Announcement?", "Do you want to add this announcement?", () =>
            fetch("/api/announcement", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf
                },
                body: JSON.stringify(payload)
            })
        );
    });
});

// ===============================
// EDIT ANNOUNCEMENT
// ===============================
document.querySelectorAll('.edit-announcemnet-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.announcemnetId;

        openModal(
            "Edit Announcement",
            `
                <form autocomplete="off">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="announcement_name" class="form-control" value="${btn.dataset.announcemnetName}">
                    </div>

                    <div class="form-group mt-2">
                        <label>Date</label>
                        <input type="date" id="announcement_date" class="form-control" value="${btn.dataset.announcemnetDate}">
                    </div>

                    <div class="form-group mt-2">
                        <label>Description</label>
                        <textarea id="announcement_description" class="form-control" rows="5">${btn.dataset.announcemnetDescription}</textarea>
                    </div>
                </form>
            `,
            `
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button class="btn btn-success" id="updateAnnouncement">Update</button>
            `
        );

        document.getElementById('updateAnnouncement').addEventListener('click', () => {
            const payload = {
                name: document.getElementById('announcement_name').value,
                date: document.getElementById('announcement_date').value,
                description: document.getElementById('announcement_description').value,
            };

            confirmAction("Update Announcement?", "Do you want to save changes?", () =>
                fetch(`/api/announcement/${id}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf
                    },
                    body: JSON.stringify(payload)
                })
            );
        });
    });
});

// ===============================
// DELETE ANNOUNCEMENT
// ===============================
document.querySelectorAll('.delete-announcemnet-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.announcemnetId;

        confirmAction("Delete Announcement?", "This action cannot be undone.", () =>
            fetch(`/api/announcement/${id}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": csrf }
            })
        );
    });
});
