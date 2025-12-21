const csrf = document.querySelector('input[name="_token"]')?.value;
window.Loader = {
    show() {
        document.getElementById('global-loader')?.style.setProperty('display', 'flex');
    },
    hide() {
        document.getElementById('global-loader')?.style.setProperty('display', 'none');
    }
};
// Format validation errors
function formatErrors(errors) {
    if (!errors) return "";
    if (typeof errors === "string") return errors;

    return Object.values(errors).flat().join("\n");
}

// Open modal helper
function openMediaModal(title, body, footer) {
    document.querySelector("#myModal .modal-title").innerHTML = title;
    document.querySelector("#myModal .modal-body").innerHTML = body;
    document.querySelector("#myModal .modal-footer").innerHTML = footer;

    new bootstrap.Modal(document.getElementById("myModal")).show();
}

/* ============================================================
   ADD MEDIA
   ============================================================ */
document.getElementById("addClubBtn").addEventListener("click", () => {
    openMediaModal(
        "Add Media",
        `
        <form id="addMediaForm" enctype="multipart/form-data">
            <div class="form-group">
                <label>Position</label>
                <input type="number" id="position" class="form-control" required>
            </div>

            <div class="form-group mt-2">
                <label>Title</label>
                <input type="text" id="title" class="form-control" required>
            </div>

            <div class="form-group mt-2">
                <label>Upload Image or Video</label>
                <input type="file" id="media" class="form-control"
                       accept="image/*,video/*" required>
            </div>
        </form>
        `,
        `
        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" id="saveMedia">Save</button>
        `
    );

    document.getElementById("saveMedia").addEventListener("click", () => {
        const formData = new FormData();

        formData.append("position", document.getElementById("position").value);
        formData.append("title", document.getElementById("title").value);
        formData.append("media", document.getElementById("media").files[0]);

        Swal.fire({
            title: "Add Media?",
            text: "This will be added to Hero Banner.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, add",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then(res => {
            if (!res.isConfirmed) return;
            Loader.show();
            fetch("/api/media", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf },
                body: formData
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Added!", data.message, "success");
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        Swal.fire("Failed", formatErrors(data.errors), "error");
                    }
                })
                .finally(() => Loader.hide());
        });
    });
});

/* ============================================================
   EDIT MEDIA
   ============================================================ */
document.querySelectorAll(".edit-media-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        const id = btn.dataset.itemId;
        const title = btn.dataset.itemTitle;
        const position = btn.dataset.itemPosition;
        const mediaPath = btn.dataset.itemMedia;

        // Determine preview type
        const isVideo = mediaPath.match(/\.(mp4|mov|avi|mkv)$/i);

        const preview = isVideo
            ? `<video src="${mediaPath}" width="250" controls class="mt-2 rounded"></video>`
            : `<img src="${mediaPath}" width="250" class="mt-2 rounded">`;

        openMediaModal(
            "Edit Media",
            `
            <form id="editMediaForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Position</label>
                    <input type="number" id="position" class="form-control" value="${position}" required>
                </div>

                <div class="form-group mt-2">
                    <label>Title</label>
                    <input type="text" id="title" class="form-control" value="${title}" required>
                </div>

                <div class="form-group mt-2">
                    <label>Current Media</label><br>
                    ${preview}
                </div>

                <div class="form-group mt-2">
                    <label>Replace Media (optional)</label>
                    <input type="file" id="media" class="form-control" accept="image/*,video/*">
                </div>
            </form>
            `,
            `
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="updateMedia">Update</button>
            `
        );

        document.getElementById("updateMedia").addEventListener("click", () => {
            const formData = new FormData();

            formData.append("position", document.getElementById("position").value);
            formData.append("title", document.getElementById("title").value);
            formData.append("_method", "PUT");

            const newFile = document.getElementById("media").files[0];
            if (newFile) formData.append("media", newFile);

            Swal.fire({
                title: "Update Media?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Update Media",
            }).then(r => {
                if (!r.isConfirmed) return;
                Loader.show();
                fetch(`/api/media/${id}`, {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": csrf },
                    body: formData
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Updated!", data.message, "success");
                            setTimeout(() => location.reload(), 1200);
                        } else {
                            Swal.fire("Failed", formatErrors(data.errors), "error");
                        }
                    })
                    .finally(() => Loader.hide());
            });
        });
    });
});

/* ============================================================
   DELETE MEDIA
   ============================================================ */
document.querySelectorAll(".delete-media-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        const id = btn.dataset.itemId;

        Swal.fire({
            title: "Delete Media?",
            text: "This cannot be undone.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete"
        }).then(result => {
            if (!result.isConfirmed) return;
            Loader.show();
            fetch(`/api/media/${id}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": csrf }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Deleted!", data.message, "success");
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        Swal.fire("Failed", data.message, "error");
                    }
                })
                .finally(() => Loader.hide());
        });
    });
});
