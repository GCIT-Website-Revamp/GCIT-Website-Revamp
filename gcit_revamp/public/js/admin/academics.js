const csrf = document.querySelector('input[name="_token"]').value;

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
        <form id="addCourseForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="why">Description (Why)</label>
                <textarea class="form-control" id="why" name="why" rows="3" placeholder="Enter course description..." required></textarea>
            </div>
            <div class="form-group">
                <label for="what">Description (What)</label>
                <textarea class="form-control" id="what" name="what" rows="3" placeholder="Enter course description..." required></textarea>
            </div>
            <div class="form-group">
                <label for="structure">Structure</label>
                <textarea class="form-control" id="structure" name="structure" rows="3" placeholder="Enter course structure..." required></textarea>
            </div>
            <div class="form-group">
                <label for="career">Career</label>
                <textarea class="form-control" id="career" name="career" rows="3" placeholder="Enter career opportunities..." required></textarea>
            </div>
        </form>
    `;

    document.querySelector('#myModal .modal-footer').innerHTML = `
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="addCourse">Add Course</button>
    `;

    // Handle Add Course with JSON
    document.getElementById('addCourse').addEventListener('click', function () {
        const payload = {
            name: document.getElementById('name').value,
            why: document.getElementById('why').value,
            what: document.getElementById('what').value,
            structure: document.getElementById('structure').value,
            career: document.getElementById('career').value
        };

        Swal.fire({
            title: "Add Course?",
            text: "Do you want to create this new course?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create"
        }).then(result => {
            if (result.isConfirmed) {
                fetch('/api/course', {
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
                                title: "Course Added",
                                text: data.message || "Course Added successfully!"
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
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something went wrong!"
                        });
                    });
            }
        });
    });

    // Show modal
    var modalEl = document.getElementById('myModal');
    var bsModal = new bootstrap.Modal(modalEl);
    bsModal.show();
});

// =====================
// Add Module Modal Logic
// =====================
document.getElementById('addModuleBtn').addEventListener('click', function () {
    document.querySelector('#myModal .modal-title').textContent = 'Add New Module';

    document.querySelector('#myModal .modal-body').innerHTML = `
        <form id="moduleForm">
            <div class="form-group">
                <label for="name">Module Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group" id="coursesContainer">
                <label>Courses</label>
                <div id="coursesCheckboxes">Loading courses...</div>
                <small class="form-text text-muted">Select one or more courses.</small>
            </div>

            <div class="form-group">
                <label for="year">Year of Module</label>
                <input type="text" class="form-control" id="year" name="year" required>
            </div>

            <div class="form-group">
                <label for="semester">Semester of Module</label>
                <input type="text" class="form-control" id="semester" name="semester" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter module description..." required></textarea>
            </div>
        </form>
    `;

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
                        <input class="form-check-input" type="checkbox" value="${course.id}" id="course_${course.id}">
                        <label class="form-check-label" for="course_${course.id}">${course.name}</label>
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
        const selectedCourses = Array.from(document.querySelectorAll('#coursesCheckboxes input[type="checkbox"]:checked')).map(cb => cb.value);

        const payload = {
            name: document.getElementById('name').value,
            course_id: selectedCourses,
            year: document.getElementById('year').value,
            semester: document.getElementById('semester').value,
            description: document.getElementById('description').value
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
                    });
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
        const courseName = this.dataset.courseName;
        const courseWhy = this.dataset.courseWhy;
        const courseWhat = this.dataset.courseWhat;
        const courseStructure = this.dataset.courseStructure;
        const courseCareer = this.dataset.courseCareer;

        document.querySelector('#myModal .modal-title').textContent = 'Edit Course';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="editCourseForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="${courseName}" required>
                </div>
                <div class="form-group">
                    <label for="why">Description (Why)</label>
                    <textarea class="form-control" id="why" name="why" rows="3" required>${courseWhy}</textarea>
                </div>
                <div class="form-group">
                    <label for="what">Description (What)</label>
                    <textarea class="form-control" id="what" name="what" rows="3" required>${courseWhat}</textarea>
                </div>
                <div class="form-group">
                    <label for="structure">Structure</label>
                    <textarea class="form-control" id="structure" name="structure" rows="3" required>${courseStructure}</textarea>
                </div>
                <div class="form-group">
                    <label for="career">Career</label>
                    <textarea class="form-control" id="career" name="career" rows="3" required>${courseCareer}</textarea>
                </div>
            </form>
        `;

        document.querySelector('#myModal .modal-footer').innerHTML = `
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="updateCourse">Update Course</button>
        `;

        // Handle Update Course with JSON
        document.getElementById('updateCourse').addEventListener('click', function () {
            const payload = {
                name: document.getElementById('name').value,
                why: document.getElementById('why').value,
                what: document.getElementById('what').value,
                structure: document.getElementById('structure').value,
                career: document.getElementById('career').value
            };

            Swal.fire({
                title: "Update Course?",
                text: "Do you want to update this course?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update"
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`/api/course/${courseId}`, {
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
                                    text: data.message || "Course Updated successfully!"
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
                        });
                }
            });
        });

        // Show modal
        var modalEl = document.getElementById('myModal');
        var bsModal = new bootstrap.Modal(modalEl);
        bsModal.show();
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
                    });
            }
        });
    });
});

// =============================
// Edit Module Button (Updated to Match Add Module)
// =============================
document.querySelectorAll('.edit-module-btn').forEach(button => {
    button.addEventListener('click', function () {
        const moduleId = this.dataset.moduleId;
        const moduleName = this.dataset.moduleName;
        const moduleDescription = this.dataset.moduleDescription;
        const moduleYear = this.dataset.moduleYear;
        const moduleSemester = this.dataset.moduleSemester;
        const moduleCourseIds = JSON.parse(this.dataset.moduleCourseId).map(Number); // pass as JSON array

        document.querySelector('#myModal .modal-title').textContent = 'Edit Module';

        document.querySelector('#myModal .modal-body').innerHTML = `
            <form id="editModuleForm">
                <div class="form-group">
                    <label for="name">Module Name</label>
                    <input type="text" class="form-control" id="name" value="${moduleName}" required>
                </div>

                <div class="form-group" id="coursesContainer">
                    <label>Courses</label>
                    <div id="coursesCheckboxes">Loading courses...</div>
                    <small class="form-text text-muted">Select one or more courses.</small>
                </div>

                <div class="form-group">
                    <label for="year">Year of Module</label>
                    <input type="text" class="form-control" id="year" value="${moduleYear}" required>
                </div>

                <div class="form-group">
                    <label for="semester">Semester of Module</label>
                    <input type="text" class="form-control" id="semester" value="${moduleSemester}" required>
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

        // Fetch courses and create checkboxes
        fetch('/api/course')
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('coursesCheckboxes');
                container.innerHTML = '';
                data.data.forEach(course => {
                    const div = document.createElement('div');
                    div.classList.add('form-check');
                    div.innerHTML = `
                        <input class="form-check-input" type="checkbox" value="${course.id}" id="course_${course.id}" ${moduleCourseIds.includes(course.id) ? 'checked' : ''}>
                        <label class="form-check-label" for="course_${course.id}">${course.name}</label>
                    `;
                    container.appendChild(div);
                });
            })
            .catch(err => {
                console.error('Error fetching courses:', err);
                document.getElementById('coursesCheckboxes').innerText = 'Error loading courses';
            });

        document.getElementById('updateModule').addEventListener('click', function () {
            const selectedCourseIds = Array.from(
                document.querySelectorAll('#coursesCheckboxes input[type="checkbox"]:checked')
            ).map(cb => cb.value);

            const payload = {
                name: document.getElementById('name').value,
                year: document.getElementById('year').value,
                semester: document.getElementById('semester').value,
                description: document.getElementById('description').value,
                course_id: selectedCourseIds
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
                        });
                }
            });
        });

        const modalEl = document.getElementById('myModal');
        const bsModal = new bootstrap.Modal(modalEl);
        bsModal.show();
    });
});


// =============================
// Delete Module Button
// =============================
document.querySelectorAll('.delete-module-btn').forEach(button => {
    button.addEventListener('click', function () {
        const moduleId = this.dataset.moduleId;
        const moduleName = this.dataset.moduleName;

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
                    });
            }
        });
    });
});