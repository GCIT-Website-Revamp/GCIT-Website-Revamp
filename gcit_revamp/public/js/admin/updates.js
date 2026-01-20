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

    const eventSearchInput = document.getElementById('eventSearch');

    if (!eventSearchInput) {
        console.warn('eventSearch input not found');
        return;
    }

    const eventTableBody = eventSearchInput
        .closest('.white_shd')
        .querySelector('table tbody');

    const originalEventRows = eventTableBody.innerHTML;

    eventSearchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (query.length === 0) {
            eventTableBody.innerHTML = originalEventRows;
            return;
        }
        Loader.show();
        fetch(`/api/event-search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;

                eventTableBody.innerHTML = '';

                if (data.data.length === 0) {
                    eventTableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">No matching events found</td>
                    </tr>
                `;
                    return;
                }

                data.data.forEach((event, index) => {
                    eventTableBody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td style="max-width: 80px;">${event.name}</td>
                        <td style="max-width: 80px;">
                            <img src="/storage/${event.image}" width="80">
                        </td>
                        <td style="max-width:250px;">${event.description.substring(0, 200)}...</td>
                        <td style="max-width:60px;">
                            <div class="action-buttons">
                                <button type="button"
                                    class="btn btn-success edit-event-btn"
                                    data-event-id="${event.id}"
                                    data-event-name="${event.name}"
                                    data-event-image="/storage/${event.image}"
                                    data-event-date="${event.date}"
                                    data-event-display="${event.display}"
                                    data-event-category="${event.category}"
                                    data-event-highlight="${event.highlight}"
                                    data-event-description="${event.description.replace(/"/g, '&quot;')}"
                                    data-event-images='${JSON.stringify(event.images || [])}'>
                                    Edit
                                </button>

                                <button type="button"
                                    class="btn btn-danger delete-event-btn"
                                    data-event-id="${event.id}">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                });
            })
            .catch(err => console.error('Event search error:', err))
            .finally(() => Loader.hide());
    });

});

document.addEventListener('DOMContentLoaded', () => {

    const announcementSearchInput = document.getElementById('announcementSearch');

    if (!announcementSearchInput) {
        console.warn('announcementSearch input not found');
        return;
    }

    const announcementTableBody = announcementSearchInput
        .closest('.white_shd')
        .querySelector('table tbody');

    const originalAnnouncementRows = announcementTableBody.innerHTML;

    announcementSearchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (query.length === 0) {
            announcementTableBody.innerHTML = originalAnnouncementRows;
            return;
        }
        Loader.show();
        fetch(`/api/announcement-search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;

                announcementTableBody.innerHTML = '';

                if (data.data.length === 0) {
                    announcementTableBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center">No matching announcements found</td>
                        </tr>
                    `;
                    return;
                }

                data.data.forEach((announcement, index) => {
                    announcementTableBody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td style="max-width:100px;">${announcement.name}</td>
                            <td style="max-width:80px;">${announcement.date}</td>
                            <td style="max-width:340px;">${announcement.description.substring(0, 200)}</td>
                            <td style="max-width:80px;">
                                <div class="action-buttons">
                                    <button type="button"
                                        class="btn btn-success edit-announcemnet-btn"
                                        data-announcemnet-id="${announcement.id}"
                                        data-announcemnet-name="${announcement.name}"
                                        data-announcemnet-date="${announcement.date}"
                                        data-announcemnet-category="${announcement.category}"
                                        data-announcemnet-display="${announcement.display}"
                                        data-announcemnet-description="${announcement.description.replace(/"/g, '&quot;')}">
                                        Edit
                                    </button>

                                    <button type="button"
                                        class="btn btn-danger delete-announcemnet-btn"
                                        data-announcemnet-id="${announcement.id}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(err => console.error('Announcement search error:', err))
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
            Loader.show();
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
                })
                .finally(() => Loader.hide());
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
                    Hide in the site (Event Page)
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
document.addEventListener('click', function (e) {
    const editBtn = e.target.closest('.edit-event-btn');
    if (editBtn) {
        const id = editBtn.dataset.eventId;
        const images = JSON.parse(editBtn.dataset.eventImages || "[]");

        openModal(
            "Edit Event",
            `
                    <form id="editEventForm" autocomplete="off" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" id="event_name" class="form-control" value="${editBtn.dataset.eventName}">
                        </div>

                        <div class="form-group mt-2">
                            <label>Replace Image (optional)</label>
                            <input type="file" id="event_image" class="form-control" accept="image/*">
                            <img src="${editBtn.dataset.eventImage}" width="100" class="mt-2 rounded">
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
                            <input type="date" id="event_date" class="form-control" value="${editBtn.dataset.eventDate}">
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" id="category">
                                <option value="Events" ${editBtn.dataset.eventCategory === "Events" ? "selected" : ""}>Events</option>
                                <option value="News" ${editBtn.dataset.eventCategory === "News" ? "selected" : ""}>News</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label>Description</label>
                            <textarea id="event_description" class="form-control">${editBtn.dataset.eventDescription || ""}</textarea>
                        </div>

                        <div class="form-group" style="margin-left:19px;">
                            <label class="form-check-label">
                            <input type="checkbox" id="display" class="form-check-input" ${editBtn.dataset.eventDisplay == "true" ? "checked" : ""}>
                            Hide in the site (Event Page)
                            </label>
                        </div>

                        <div class="form-group" style="margin-left:19px;">
                            <label class="form-check-label">
                            <input type="checkbox" id="highlight" class="form-check-input" ${editBtn.dataset.eventHighlight == "true" ? "checked" : ""}>
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
                        Loader.show();
                        fetch(`/api/event-image/${imgId}`, {
                            method: "DELETE",
                            headers: { "X-CSRF-TOKEN": csrf }
                        })
                            .then(r => r.json())
                            .then(resp => {
                                if (resp.success) delBtn.parentElement.remove();
                            })
                            .finally(() => Loader.hide());
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
    }
});


// ===============================
// DELETE EVENT
// ===============================

document.addEventListener('click', function (e) {
    const deleteBtn = e.target.closest('.delete-event-btn');
    const id = deleteBtn.dataset.eventId;

    confirmAction("Delete Event?", "This action cannot be undone.", () =>
        fetch(`/api/event/${id}`, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": csrf }
        })
    );
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
                    Hide in the site (Announcement Page)
                </label>
            </form>
        `,
        `
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="saveAnnouncement">Save</button>
        `
    );

    ClassicEditor
        .create(document.querySelector('#announcement_description'), {
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

    document.getElementById('saveAnnouncement').addEventListener('click', () => {
        const payload = {
            name: document.getElementById('announcement_name').value,
            date: document.getElementById('announcement_date').value,
            description: window.ictEditorInstance.getData(),
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
document.addEventListener('click', function (e) {
    const editBtn = e.target.closest('.edit-announcemnet-btn')
    const id = editBtn.dataset.announcemnetId;
    if (editBtn) {
        openModal(
            "Edit Announcement",
            `
                    <form autocomplete="off">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" id="announcement_name" class="form-control" value="${editBtn.dataset.announcemnetName}">
                        </div>

                        <div class="form-group mt-2">
                            <label>Date</label>
                            <input type="date" id="announcement_date" class="form-control" value="${editBtn.dataset.announcemnetDate}">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category">
                                <option value="" disabled selected>Select Category</option>
                                <option value="Announcements" ${editBtn.dataset.announcemnetCategory === "Announcements" ? "selected" : ""}>Announcements</option>
                                <option value="Tender" ${editBtn.dataset.announcemnetCategory === "Tender" ? "selected" : ""}>Tender</option>
                                <option value="Vacancy" ${editBtn.dataset.announcemnetCategory === "Vacancy" ? "selected" : ""}>Vacancy</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label>Description</label>
                            <textarea id="announcement_description" class="form-control" rows="5">${editBtn.dataset.announcemnetDescription}</textarea>
                        </div>

                        <div class="form-group" style="margin-left:19px;">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="display" name="display" value="true"
                            ${editBtn.dataset.announcemnetDisplay == "true" ? "checked" : ""}>
                            Hide in the site (Announcement Page)
                        </label>
                    </form>
                `,
            `
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" id="updateAnnouncement">Update</button>
                `
        );

        ClassicEditor
            .create(document.querySelector('#announcement_description'), {
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

        document.getElementById('updateAnnouncement').addEventListener('click', () => {
            const payload = {
                name: document.getElementById('announcement_name').value,
                date: document.getElementById('announcement_date').value,
                description: window.ictEditorInstance.getData(),
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
    }
});

// ===============================
// DELETE ANNOUNCEMENT
// ===============================
document.addEventListener('click', function (e) {
    const deleteBtn = e.target.closest('.delete-announcemnet-btn');
    const id = deleteBtn.dataset.announcemnetId;

    confirmAction("Delete Announcement?", "This action cannot be undone.", () =>
        fetch(`/api/announcement/${id}`, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": csrf }
        })
    );
});
