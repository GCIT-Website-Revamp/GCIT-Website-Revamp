const csrf = document.querySelector('input[name="_token"]').value;

window.Loader = {
    show() {
        document.getElementById('global-loader')?.style.setProperty('display', 'flex');
    },
    hide() {
        document.getElementById('global-loader')?.style.setProperty('display', 'none');
    }
};

/* =========================
   CKEDITOR (FOR ALL TEXTAREAS)
   ========================= */
const CKEDITORS = new Map(); // key: textarea element, value: editor instance

function initCkEditors(scope = document) {
    const textareas = scope.querySelectorAll('textarea');

    textareas.forEach(textarea => {
        if (CKEDITORS.has(textarea)) return;

        ClassicEditor
            .create(textarea, {
                ckfinder: {
                    uploadUrl: '/ckeditor/upload?_token=' + csrf
                },
                image: {
                    upload: {
                        types: ['jpeg', 'png', 'jpg', 'gif', 'webp']
                    }
                }
            })
            .then(editor => {
                CKEDITORS.set(textarea, editor);
            })
            .catch(err => console.error('CKEditor init error:', err));
    });
}

function getCkData(textareaId) {
    const el = document.getElementById(textareaId);
    if (!el) return "";

    const editor = CKEDITORS.get(el);
    return editor ? editor.getData() : el.value;
}

function destroyCkEditors() {
    CKEDITORS.forEach(editor => editor.destroy());
    CKEDITORS.clear();
}

document.getElementById('myModal')?.addEventListener('hidden.bs.modal', destroyCkEditors);


/* =========================
   MODULE SEARCH (UNCHANGED)
   ========================= */
document.addEventListener('DOMContentLoaded', () => {

    const moduleSearchInput = document.getElementById('moduleSearch');
    if (!moduleSearchInput) return;

    const moduleTableBody = moduleSearchInput
        .closest('.white_shd')
        .querySelector('table tbody');

    const originalModuleRows = moduleTableBody.innerHTML;

    moduleSearchInput.addEventListener('input', function () {
        const query = this.value.trim();

        // Restore original table
        if (query.length === 0) {
            moduleTableBody.innerHTML = originalModuleRows;
            return;
        }
        Loader.show();
        fetch(`/api/module-search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;

                moduleTableBody.innerHTML = '';

                if (data.data.length === 0) {
                    moduleTableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center">No matching modules found</td>
                        </tr>
                    `;
                    return;
                }

                data.data.forEach((module, index) => {
                    moduleTableBody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${module.name}</td>
                            <td>${module.year}</td>
                            <td>${module.semester}</td>
                            <td style="max-width: 440px;">
                                ${module.description.substring(0, 200)}...
                            </td>
                            <td style="max-width:80px;">
                                <div class="action-buttons">
                                    <button
                                        class="btn btn-success edit-module-btn"
                                        data-module-id="${module.id}"
                                        data-module-name="${module.name}"
                                        data-module-description="${module.description.replace(/"/g, '&quot;')}"
                                        data-module-course-id='${JSON.stringify(module.course_id || [])}'
                                    >
                                        Edit
                                    </button>

                                    <button
                                        class="btn btn-danger delete-module-btn"
                                        data-module-id="${module.id}"
                                        data-module-name="${module.name}"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(err => console.error('Module search error:', err))
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

// =====================
// Add Course Modal Logic
// =====================
document.getElementById('addCourseBtn').addEventListener('click', function () {

    document.querySelector('#myModal .modal-title').textContent = 'Add New Course';

    document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="addCourseForm" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>

            <div class="form-group">
                <label>Header</label>
                <input type="text" class="form-control" id="header" rows="2" required>
            </div>
            <div class="form-group">
                <label>Header 2</label>
                <input type="text" class="form-control" id="header2" rows="2" required>
            </div>

            <div class="form-group">
                <label for="courseType">Type</label>
                <select class="form-control" id="courseType">
                    <option value="" disabled selected>Select Degree</option>
                    <option value="School of Future Computing">School of Future Computing</option>
                    <option value="School of Interactive Design and Development">School of Interactive Design and Development</option>
                </select>
            </div>

            <div class="form-group">
                <label>Short Description</label>
                <textarea class="form-control" id="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Description (Why This Program?)</label>
                <textarea class="form-control" id="why" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Description (What Would I Learn?)</label>
                <textarea class="form-control" id="what" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Program Structure</label>
                <textarea class="form-control" id="structure" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Career Prospects</label>
                <textarea class="form-control" id="career" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" id="courseImage" accept="image/*" required>
            </div>
        </form>
    `;

    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="addCourse">Add Course</button>
    `;

    // INIT CKEDITOR FOR ALL TEXTAREAS IN MODAL
    initCkEditors(document.getElementById('myModal'));

    // HANDLE SUBMIT
    document.getElementById('addCourse').addEventListener('click', function () {

        let formData = new FormData();
        formData.append("name", document.getElementById('name').value);
        formData.append("header", document.getElementById('header').value);
        formData.append("header2", document.getElementById('header2').value);
        // textarea -> CKEditor data
        formData.append("description", getCkData("description"));
        formData.append("why", getCkData("why"));
        formData.append("what", getCkData("what"));
        formData.append("structure", getCkData("structure"));
        formData.append("career", getCkData("career"));
        formData.append("type", document.getElementById("courseType").value);
        let imageFile = document.getElementById('courseImage').files[0];
        formData.append("image", imageFile);

        Swal.fire({
            title: "Add Course?",
            text: "Do you want to create this new course?",
            icon: "question",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            showCancelButton: true
        }).then(result => {
            if (result.isConfirmed) {
                Loader.show();
                fetch('/api/course', {
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
                            Swal.fire("Success", "Course Added Successfully!", "success");
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            Swal.fire("Failed", formatErrors(data.errors || data.message), "error");
                        }
                    })
                    .catch(() => Swal.fire("Error", "Something went wrong!", "error"))
                    .finally(() => Loader.hide());
            }
        });
    });

    new bootstrap.Modal(document.getElementById('myModal')).show();
});


// =====================
// Add Module Modal Logic
// =====================
document.getElementById('addModuleBtn').addEventListener('click', function () {
    document.querySelector('#myModal .modal-title').textContent = 'Add New Module';

    document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="moduleForm" autocomplete="off">
            <div class="form-group">
                <label for="name">Module Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group" id="coursesContainer">
                <label>Courses</label>
                <small class="form-text text-danger">Select one or more courses along with year and semester.</small>
                <div id="coursesCheckboxes">Loading courses...</div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter module description..." required></textarea>
            </div>
        </form>
    `;

    // INIT CKEDITOR FOR ALL TEXTAREAS IN MODAL
    initCkEditors(document.getElementById('myModal'));

    // Fetch courses and display as checkboxes
    fetch('/api/course')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('coursesCheckboxes');
            container.innerHTML = '';
            if (data.data && data.data.length) {
                data.data.forEach(course => {
                    const div = document.createElement('div');
                    div.classList.add('form-check');
                    div.innerHTML = `
                        <!-- Course -->
                        <input class="form-check-input course-checkbox"
                            type="checkbox"
                            value="${course.id}"
                            id="course_${course.id}">

                        <label class="form-check-label fw-bold" for="course_${course.id}">
                            ${course.name}
                        </label>

                        <!-- Year -->
                        <div class="d-flex">
                            <div class="d-flex mt-2 ms-3">
                                <label class="form-label mx-2 fw-bold">Year:</label>
                                ${[1,2,3,4].map(y => `
                                    <div class="mx-4">
                                        <input class="form-check-input year-radio"
                                            type="radio"
                                            name="year_${course.id}"
                                            value="${y}">
                                        <label>${y}</label>
                                    </div>
                                `).join('')}
                            </div>

                            <!-- Semester -->
                            <div class="d-flex mt-2 ms-3">
                                <label class="form-label mx-2 fw-bold">Semester:</label>
                                ${[1,2].map(s => `
                                    <div class="mx-4">
                                        <input class="form-check-input semester-radio"
                                            type="radio"
                                            name="semester_${course.id}"
                                            value="${s}">
                                        <label>${s}</label>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    container.appendChild(div);
                });
            } else {
                container.innerHTML = 'No courses available';
            }
        })
        .catch(err => {
            console.error('Error fetching courses:', err);
            document.getElementById('coursesCheckboxes').innerText = 'Error loading courses';
        });

    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="submitModuleForm">Add Module</button>
    `;

    document.getElementById('submitModuleForm').addEventListener('click', function () {
        const coursesData = {};

        document.querySelectorAll('.course-checkbox:checked').forEach(courseCheckbox => {
            const courseId = courseCheckbox.value;

            const yearInput = document.querySelector(`input[name="year_${courseId}"]:checked`);
            const semesterInput = document.querySelector(`input[name="semester_${courseId}"]:checked`);

            if (!yearInput || !semesterInput) {
                throw new Error(`Year and semester required for course ID ${courseId}`);
            }

            coursesData[courseId] = {
                year: parseInt(yearInput.value),
                semester: parseInt(semesterInput.value)
            };
        });

        const payload = {
            name: document.getElementById('name').value,
            course_id: coursesData,
            // textarea -> CKEditor data
            description: getCkData("description")
        };

        Swal.fire({
            title: "Add Module?",
            text: "Do you want to create this new module?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create"
        }).then(result => {
            if (result.isConfirmed) {
                Loader.show();
                fetch('/api/module', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Module Added",
                                text: data.message || "New Module Added successfully!"
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
                        console.error('Error:', err);
                        Swal.fire({ icon: "error", title: "Error", text: "Something went wrong!" });
                    })
                    .finally(() => Loader.hide());
            }
        });
    });

    const modalEl = document.getElementById('myModal');
    const bsModal = new bootstrap.Modal(modalEl);
    bsModal.show();
});


// =============================
// Edit Course Button
// =============================
document.querySelectorAll('.edit-course-btn').forEach(button => {
    button.addEventListener('click', function () {

        const courseId = this.dataset.courseId;

        document.querySelector('#myModal .modal-title').textContent = 'Edit Course';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="editCourseForm" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" value="${this.dataset.courseName}" required>
                </div>

                <div class="form-group">
                    <label>Header</label>
                    <input type="text" class="form-control" id="header" rows="2" value="${this.dataset.courseHeader}" required>
                </div>
                <div class="form-group">
                    <label>Header 2</label>
                    <input type="text" class="form-control" id="header2" rows="2" value="${this.dataset.courseHeader2}" required>
                </div>

                <div class="form-group">
                    <label for="courseType">Type</label>
                    <select class="form-control" id="courseType">
                        <option value="" disabled selected>Select Degree</option>
                        <option value="School of Future Computing"  ${this.dataset.courseType === "School of Future Computing" ? "selected" : ""}>School of Future Computing</option>
                        <option value="School of Interactive Design and Development" ${this.dataset.courseType === "School of Interactive Design and Development" ? "selected" : ""}>School of Interactive Design and Development</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Short Description</label>
                    <textarea class="form-control" id="description" rows="3" required>${this.dataset.courseDescription}</textarea>
                </div>

                <div class="form-group">
                    <label>Description (Why This Program?)</label>
                    <textarea class="form-control" id="why" rows="3" required>${this.dataset.courseWhy}</textarea>
                </div>

                <div class="form-group">
                    <label>Description (What Would I Learn?)</label>
                    <textarea class="form-control" id="what" rows="3" required>${this.dataset.courseWhat}</textarea>
                </div>

                <div class="form-group">
                    <label>Program Structure</label>
                    <textarea class="form-control" id="structure" rows="3" required>${this.dataset.courseStructure}</textarea>
                </div>

                <div class="form-group">
                    <label>Career Prospects</label>
                    <textarea class="form-control" id="career" rows="3" required>${this.dataset.courseCareer}</textarea>
                </div>

                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="${this.dataset.courseImage}" width="50" class="mb-2">
                    <input type="file" class="form-control" id="courseImage" accept="image/*">
                </div>
            </form>
        `;

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="updateCourse">Update Course</button>
        `;

        // INIT CKEDITOR FOR ALL TEXTAREAS IN MODAL
        initCkEditors(document.getElementById('myModal'));

        // Handle Update
        document.getElementById('updateCourse').addEventListener('click', function () {

            let formData = new FormData();
            formData.append("name", document.getElementById('name').value);
            formData.append("header", document.getElementById('header').value);
            formData.append("header2", document.getElementById('header2').value);
            // textarea -> CKEditor data
            formData.append("description", getCkData("description"));
            formData.append("why", getCkData("why"));
            formData.append("what", getCkData("what"));
            formData.append("structure", getCkData("structure"));
            formData.append("career", getCkData("career"));

            formData.append("type", document.getElementById("courseType").value);
            let newImage = document.getElementById('courseImage').files[0];
            if (newImage) {
                formData.append("image", newImage);
            }
            formData.append("_method", "PUT");

            Swal.fire({
                title: "Update Course?",
                text: "Do you want to update this course?",
                icon: "question",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                showCancelButton: true
            }).then(result => {
                if (result.isConfirmed) {
                    Loader.show();
                    fetch(`/api/course/${courseId}`, {
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
                                Swal.fire("Updated", "Course Updated Successfully!", "success");
                                setTimeout(() => location.reload(), 1200);
                            } else {
                                Swal.fire("Failed", formatErrors(data.errors || data.message), "error");
                            }
                        })
                        .catch(() => Swal.fire("Error", "Something went wrong!", "error"))
                        .finally(() => Loader.hide());
                }
            });

        });

        new bootstrap.Modal(document.getElementById('myModal')).show();
    });
});


// =============================
// Delete Course Button
// =============================
document.querySelectorAll('.delete-course-btn').forEach(button => {
    button.addEventListener('click', function () {
        const courseId = this.dataset.courseId;
        const courseName = this.dataset.courseName;

        Swal.fire({
            title: "Delete Course?",
            text: `Are you sure you want to delete "${courseName}"? This action cannot be undone.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.isConfirmed) {
                Loader.show();
                fetch(`/api/course/${courseId}`, {
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
                                title: "Course Deleted",
                                text: data.message || "Course Deleted successfully!"
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
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something went wrong!"
                        });
                    })
                    .finally(() => Loader.hide());
            }
        });
    });
});


// =============================
// Edit Module Button (Updated to Match Add Module)
// =============================
document.addEventListener('click', function (e) {
    const editBtn = e.target.closest('.edit-module-btn');
    if (editBtn) {
        const moduleId = editBtn.dataset.moduleId;
        const moduleName = editBtn.dataset.moduleName;
        const moduleDescription = editBtn.dataset.moduleDescription;
        const moduleCourseIds = JSON.parse(editBtn.dataset.moduleCourseId); // pass as JSON array

        document.querySelector('#myModal .modal-title').textContent = 'Edit Module';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="editModuleForm" autocomplete="off">
                <div class="form-group">
                    <label for="name">Module Name</label>
                    <input type="text" class="form-control" id="name" value="${moduleName}" required>
                </div>

                <div class="form-group" id="coursesContainer">
                    <label>Courses</label>
                    <small class="form-text text-danger">Select one or more courses along with year and semester.</small>
                    <div id="coursesCheckboxes">Loading courses...</div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="4" required>${moduleDescription}</textarea>
                </div>
            </form>
        `;

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="updateModule">Update Module</button>
        `;

        // INIT CKEDITOR FOR ALL TEXTAREAS IN MODAL
        initCkEditors(document.getElementById('myModal'));

        // Fetch courses and create checkboxes
        fetch('/api/course')
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('coursesCheckboxes');
                container.innerHTML = '';
                data.data.forEach(course => {
                    const existing = moduleCourseIds[course.id] || null;
                    const div = document.createElement('div');
                    div.classList.add('form-check');
                    div.innerHTML = `
                        <input class="form-check-input course-checkbox"
                            type="checkbox"
                            value="${course.id}"
                            id="course_${course.id}"
                            ${existing ? 'checked' : ''}>

                        <label class="form-check-label fw-bold" for="course_${course.id}">
                            ${course.name}
                        </label>
                        <div class="d-flex">
                            <div class="d-flex mt-2 ms-3">
                                <label class="fw-bold mx-2">Year:</label>
                                ${[1,2,3,4].map(y => `
                                    <div class="mx-3">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="year_${course.id}"
                                            value="${y}"
                                            ${existing && existing.year == y ? 'checked' : ''}>
                                        <label>${y}</label>
                                    </div>
                                `).join('')}
                            </div>

                            <div class="d-flex mt-2 ms-3">
                                <label class="fw-bold mx-2">Semester:</label>
                                ${[1,2].map(s => `
                                    <div class="mx-3">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="semester_${course.id}"
                                            value="${s}"
                                            ${existing && existing.semester == s ? 'checked' : ''}>
                                        <label>${s}</label>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    container.appendChild(div);
                });
            })
            .catch(err => {
                console.error('Error fetching courses:', err);
                document.getElementById('coursesCheckboxes').innerText = 'Error loading courses';
            });

        document.getElementById('updateModule').addEventListener('click', function () {
            const coursesData = {};

            document.querySelectorAll('.course-checkbox:checked').forEach(cb => {
                const courseId = cb.value;

                const year = document.querySelector(`input[name="year_${courseId}"]:checked`);
                const semester = document.querySelector(`input[name="semester_${courseId}"]:checked`);

                if (!year || !semester) {
                    Swal.fire("Error", "Year and semester required for each course", "error");
                    throw new Error("Invalid selection");
                }

                coursesData[courseId] = {
                    year: parseInt(year.value),
                    semester: parseInt(semester.value)
                };
            });

            const payload = {
                name: document.getElementById('name').value,
                // textarea -> CKEditor data
                description: getCkData("description"),
                course_id: coursesData
            };

            Swal.fire({
                title: "Update Module?",
                text: "Do you want to update this module?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update"
            }).then(result => {
                if (result.isConfirmed) {
                    Loader.show();
                    fetch(`/api/module/${moduleId}`, {
                        method: "PUT",
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
                                    title: "Updated",
                                    text: data.message || "Module Updated successfully!"
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
                            console.error('Error:', err);
                            Swal.fire({ icon: "error", title: "Error", text: "Something went wrong!" });
                        })
                        .finally(() => Loader.hide());
                }
            });
        });

        const modalEl = document.getElementById('myModal');
        const bsModal = new bootstrap.Modal(modalEl);
        bsModal.show();
    }
});


// =============================
// Delete Module Button
// =============================
document.addEventListener('click', function (e) {
    const deleteBtn = e.target.closest('.delete-module-btn');
    const moduleId = deleteBtn.dataset.moduleId;
    const moduleName = deleteBtn.dataset.moduleName;

    Swal.fire({
        title: "Delete Module?",
        text: `Are you sure you want to delete "${moduleName}"? This action cannot be undone.`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then(result => {
        if (result.isConfirmed) {
            Loader.show();
            fetch(`/api/module/${moduleId}`, {
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
                            title: "Module Deleted",
                            text: data.message || "Module Deleted successfully!"
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
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong!"
                    });
                })
                .finally(() => Loader.hide());
        }
    });
});