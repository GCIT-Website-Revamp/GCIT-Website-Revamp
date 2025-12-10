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
            <form id="eventForm" autocomplete="off" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="event_name" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Main Event Image</label>
                    <input type="file" id="event_image" name="image" class="form-control" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label>Additional Images (Optional)</label>
                    <input type="file" id="additional_images" class="form-control" name="additional_images[]" accept="image/*" multiple>
                </div>

                <div class="form-group mt-2">
                    <label>Date</label>
                    <input type="date" id="event_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" id="category">
                        <option value="Events">Events</option>
                        <option value="News">News</option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Description</label>
                    <textarea id="event_description" class="form-control" rows="5"></textarea>
                </div>

                <div class="form-group" style="margin-left:19px;">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="display" value="true">
                    Display in the site (Event Page)
                    </label>
                </div>
                <div class="form-group" style="margin-left:19px;">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="highlight" value="true">
                    Display in highlights (Home Page)
                    </label>
                </div>
            </form>
        `,
        `
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="saveEvent">Save</button>
        `
    );

    ClassicEditor.create(document.querySelector('#event_description')).then(e => window.ictEditorInstance = e);

    document.getElementById('saveEvent').addEventListener('click', () => {
        const form = document.getElementById("eventForm");
        const formData = new FormData(form);

        formData.append("name", document.getElementById("event_name").value);
        formData.append("date", document.getElementById("event_date").value);
        formData.append("category", document.getElementById("category").value);
        formData.append("description", window.ictEditorInstance.getData());
        formData.append("display", document.getElementById("display").checked ? "true" : "false");
        formData.append("highlight", document.getElementById("highlight").checked ? "true" : "false");

        // multiple images added automatically by FormData

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
        const images = JSON.parse(btn.dataset.eventImages || "[]");

        openModal(
            "Edit Event",
            `
                <form id="editEventForm" autocomplete="off" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="event_name" class="form-control" value="${btn.dataset.eventName}">
                    </div>

                    <div class="form-group mt-2">
                        <label>Replace Image (optional)</label>
                        <input type="file" id="event_image" class="form-control" accept="image/*">
                        <img src="${btn.dataset.eventImage}" width="100" class="mt-2 rounded">
                    </div>

                    <div class="form-group">
                        <label>Additional Images</label>
                        <div id="eventAdditionalImages"
                            style="white-space:nowrap; overflow-x:auto; border:1px solid #ddd; padding:5px; border-radius:5px;">
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label>Add More Images</label>
                        <input type="file" multiple id="additional_images" name="additional_images[]" class="form-control" accept="image/*">
                    </div>

                    <div class="form-group mt-2">
                        <label>Date</label>
                        <input type="date" id="event_date" class="form-control" value="${btn.dataset.eventDate}">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="category">
                            <option value="Events" ${btn.dataset.eventCategory === "Events" ? "selected" : ""}>Events</option>
                            <option value="News" ${btn.dataset.eventCategory === "News" ? "selected" : ""}>News</option>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label>Description</label>
                        <textarea id="event_description" class="form-control">${btn.dataset.eventDescription || ""}</textarea>
                    </div>

                    <div class="form-group" style="margin-left:19px;">
                        <label class="form-check-label">
                        <input type="checkbox" id="display" class="form-check-input" ${btn.dataset.eventDisplay == "true" ? "checked" : ""}>
                        Display in the site (Event Page)
                        </label>
                    </div>

                    <div class="form-group" style="margin-left:19px;">
                        <label class="form-check-label">
                        <input type="checkbox" id="highlight" class="form-check-input" ${btn.dataset.eventHighlight == "true" ? "checked" : ""}>
                        Display in highlights (Home Page)
                        </label>
                    </div>

                </form>
            `,
            `
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button class="btn btn-success" id="updateEvent">Update</button>
            `
        );

        ClassicEditor.create(document.querySelector('#event_description')).then(e => window.ictEditorInstance = e);

        // ----- Show Additional Images -----
        const container = document.getElementById("eventAdditionalImages");
        images.forEach(img => {
            const wrap = document.createElement("div");
            wrap.style.display = "inline-block";
            wrap.style.position = "relative";
            wrap.style.marginRight = "10px";

            wrap.innerHTML = `
                <img src="/storage/${img.image_path}" width="120" class="rounded border">
                <button type="button" class="btn btn-danger btn-sm delete-event-image"
                        data-id="${img.id}"
                        style="position:absolute; top:0; right:0; border-radius:50%; padding:2px 6px;">×</button>
            `;

            container.appendChild(wrap);
        });

        // ----- Delete Additional Image -----
        document.querySelectorAll('.delete-event-image').forEach(delBtn => {
            delBtn.addEventListener('click', () => {
                const imgId = delBtn.dataset.id;

                Swal.fire({
                    title: "Delete image?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete",
                }).then(res => {
                    if (res.isConfirmed) {
                        fetch(`/api/event-image/${imgId}`, {
                            method: "DELETE",
                            headers: { "X-CSRF-TOKEN": csrf }
                        })
                        .then(r => r.json())
                        .then(resp => {
                            if (resp.success) delBtn.parentElement.remove();
                        });
                    }
                });
            });
        });

        // ----- Update Event -----
        document.getElementById('updateEvent').addEventListener('click', () => {
            const form = document.getElementById("editEventForm");
            const formData = new FormData(form);

            formData.append("name", document.getElementById("event_name").value);
            formData.append("date", document.getElementById("event_date").value);
            formData.append("description", window.ictEditorInstance.getData());
            formData.append("category", document.getElementById("category").value);
            formData.append("display", document.getElementById("display").checked ? "true" : "false");
            formData.append("highlight", document.getElementById("highlight").checked ? "true" : "false");
            formData.append("_method", "PUT");

            if (document.getElementById("event_image").files[0]) {
                formData.append("image", document.getElementById("event_image").files[0]);
            }

            confirmAction("Update Event?", "Save changes?", () =>
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

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category">
                        <option value="" disabled selected>Select Category</option>
                        <option value="Announcements">Announcements</option>
                        <option value="Tender">Tender</option>
                        <option value="Vacancy">Vacancy</option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Description</label>
                    <textarea id="announcement_description" class="form-control" rows="5"></textarea>
                </div>

                <div class="form-group" style="margin-left:19px;">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="display" name="display" value="true">
                    Display in the site
                </label>
            </form>
        `,
        `
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="saveAnnouncement">Save</button>
        `
    );

    ClassicEditor
        .create(document.querySelector('#announcement_description'))
        .then(editor => window.ictEditorInstance = editor)
        .catch(err => console.error(err));

    document.getElementById('saveAnnouncement').addEventListener('click', () => {
        const payload = {
            name: document.getElementById('announcement_name').value,
            date: document.getElementById('announcement_date').value,
            description:  window.ictEditorInstance.getData(),
            category: document.getElementById('category').value,
            display: document.getElementById('display').checked ? "true" : "false"
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

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category">
                            <option value="" disabled selected>Select Category</option>
                            <option value="Announcements" ${btn.dataset.announcemnetCategory === "Announcements" ? "selected" : ""}>Announcements</option>
                            <option value="Tender" ${btn.dataset.announcemnetCategory === "Tender" ? "selected" : ""}>Tender</option>
                            <option value="Vacancy" ${btn.dataset.announcemnetCategory === "Vacancy" ? "selected" : ""}>Vacancy</option>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label>Description</label>
                        <textarea id="announcement_description" class="form-control" rows="5">${btn.dataset.announcemnetDescription}</textarea>
                    </div>

                    <div class="form-group" style="margin-left:19px;">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="display" name="display" value="true"
                        ${btn.dataset.announcemnetDisplay == "true" ? "checked" : ""}>
                        Display in the site
                    </label>
                </form>
            `,
            `
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button class="btn btn-success" id="updateAnnouncement">Update</button>
            `
        );

        ClassicEditor
            .create(document.querySelector('#announcement_description'))
            .then(editor => window.ictEditorInstance = editor)
            .catch(err => console.error(err));

        document.getElementById('updateAnnouncement').addEventListener('click', () => {
            const payload = {
                name: document.getElementById('announcement_name').value,
                date: document.getElementById('announcement_date').value,
                description:  window.ictEditorInstance.getData(),
                category: document.getElementById('category').value,
                display: document.getElementById('display').checked ? "true" : "false"
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
