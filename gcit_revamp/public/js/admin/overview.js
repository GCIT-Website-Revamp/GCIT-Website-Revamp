const csrf = document.querySelector('input[name="_token"]')?.value;

function formatErrors(errors) {
    if (!errors) return "";
    if (typeof errors === "string") return errors;

    // If errors is an object (like Laravel validation errors)
    return Object.values(errors)
        .flat()
        .join("\n");
}

// ===============================
// Add Overview
// ===============================
document.getElementById("addOverviewBtn")?.addEventListener("click", function () {
    setupOverviewModal({
        isEdit: false,
        overviewId: null,
        image: "",
        mission: "",
        vision: "",
        description: "",
        timeline: []
    });
});

// ===============================
// Edit Overview
// ===============================
document.getElementById("editOverviewBtn")?.addEventListener("click", function () {

    const timelineData = JSON.parse(this.dataset.overviewTimeline || "[]");

    setupOverviewModal({
        isEdit: true,
        overviewId: this.dataset.overviewId,
        image: this.dataset.overviewImage,
        mission: this.dataset.overviewMission,
        vision: this.dataset.overviewVision,
        description: this.dataset.overviewDescription,
        timeline: timelineData
    });
});

// ===============================
// MAIN MODAL SETUP FUNCTION
// ===============================
function setupOverviewModal(data) {
    document.querySelector("#myModal .modal-title").innerText =
        data.isEdit ? "Edit Overview" : "Add Overview";

    document.querySelector("#myModal .modal-body").innerHTML = `
        <form id="overviewForm" enctype="multipart/form-data">

            <label><b>Image</b></label>
            <input type="file" class="form-control mb-3" id="overviewImage">

            ${data.image
            ? `<p>Current Image:</p><img src="/storage/${data.image}" width="120" class="mb-3">`
            : ""}

            <label><b>Mission</b></label>
            <textarea class="form-control mb-3" id="overviewMission" rows="3">${data.mission || ""}</textarea>

            <label><b>Vision</b></label>
            <textarea class="form-control mb-3" id="overviewVision" rows="3">${data.vision || ""}</textarea>

            <label><b>Description</b></label>
            <textarea class="form-control mb-3" id="overviewDescription" rows="4">${data.description || ""}</textarea>

            <hr>

            <div class="d-flex justify-content-between align-items-center">
                <h5><b>Timeline</b></h5>
                <button type="button" class="btn btn-primary btn-sm" id="addTimelineRowBtn">+ Add Year</button>
            </div>

            <div id="timeline-container" class="mt-3"></div>
        </form>
    `;

    // Load timeline if editing
    const container = document.getElementById("timeline-container");

    const createTimelineRow = (item = { year: "", description: "" }) => `
        <div class="timeline-row border p-3 mb-3 rounded">

            <label class="fw-bold">Year</label>
            <input type="text" class="form-control mb-2 year-input" value="${item.year}" placeholder="Enter Year">

            <label class="fw-bold">Description</label>
            <textarea class="form-control mb-2 desc-input" rows="2" placeholder="Write details...">${item.event || ""}</textarea>

            <button type="button" class="btn btn-danger btn-sm remove-timeline-row">Remove</button>
        </div>
    `;

    // If editing: load items
    data.timeline.forEach(item => {
        container.insertAdjacentHTML("beforeend", createTimelineRow(item));
    });

    // Clicking: Add new timeline row
    document.getElementById("addTimelineRowBtn").addEventListener("click", () => {
        container.insertAdjacentHTML("beforeend", createTimelineRow());
    });

    // Clicking: Remove timeline row
    container.addEventListener("click", (e) => {
        if (e.target.classList.contains("remove-timeline-row")) {
            e.target.closest(".timeline-row").remove();
        }
    });

    // Build Footer Button
    document.querySelector("#myModal .modal-footer").innerHTML = `
        ${data.isEdit
            ? `<button class="btn btn-danger" id="deleteOverviewBtn">Delete Overview</button>`
            : `<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>`}
        <button class="btn btn-success" id="saveOverviewBtn">${data.isEdit ? "Update" : "Save"}</button>
    `;

    // SAVE OVERVIEW
    document.getElementById("saveOverviewBtn").addEventListener("click", function () {
        Swal.fire({
            title: data.isEdit ? "Update Overview?" : "Add Overview?",
            text: data.isEdit ? "Do you want to update this overview?" : "Do you want to add this overview?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: data.isEdit ? "Yes, Update" : "Yes, Add",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                submitOverviewForm(data);
            }
        });
    });


    // DELETE OVERVIEW
    if (data.isEdit) {
        document.getElementById("deleteOverviewBtn").addEventListener("click", function () {
            deleteOverview(data.overviewId);
        });
    }

    new bootstrap.Modal(document.getElementById("myModal")).show();
}

// ===============================
// SUBMIT OVERVIEW
// ===============================
function submitOverviewForm(data) {
    const formData = new FormData();

    formData.append("mission", document.getElementById("overviewMission").value);
    formData.append("vision", document.getElementById("overviewVision").value);
    formData.append("description", document.getElementById("overviewDescription").value);

    const imageFile = document.getElementById("overviewImage").files[0];
    if (imageFile) formData.append("image", imageFile);

    // Collect timeline rows
    const timelineItems = [...document.querySelectorAll(".timeline-row")].map(row => ({
        year: row.querySelector(".year-input").value,
        event: row.querySelector(".desc-input").value
    }));

    formData.append("timeline", JSON.stringify(timelineItems));
    if (data.isEdit) {
        formData.append("_method", "PUT");
    }
    const url = data.isEdit
        ? `/api/overview/${data.overviewId}`
        : `/api/overview`;

    fetch(url, {
        method: "POST",
        headers: { "X-CSRF-TOKEN": csrf },
        body: formData
    })
        .then(res => res.json())
        .then(response => {
            if (response.success) {
                Swal.fire({
                    icon: "success",
                    title: data.isEdit ? "Update" : "Add",
                    text: response.message || ""
                });
                setTimeout(() => location.reload(), 1500);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Failed",
                    text: formatErrors(response.errors || response.message)
                });
            }
        });
}

// ===============================
// DELETE OVERVIEW
// ===============================
function deleteOverview(id) {
    Swal.fire({
        title: "Delete Overview?",
        text: "This action cannot be undone.",
        icon: "warning",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        showCancelButton: true,
        confirmButtonText: "Delete"
    }).then(result => {
        if (result.isConfirmed) {
            fetch(`/api/overview/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrf
                }
            })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Deleted",
                            text: response.message || "Overview Deleted successfully!"
                        });
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Failed",
                            text: formatErrors(response.errors || response.message)
                        });
                    }
                });
        }
    });
}