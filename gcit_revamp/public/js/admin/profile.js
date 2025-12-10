// Select forms correctly using class selectors
const updateProfileForm = document.querySelector(".updateUserForm");
const updatePasswordForm = document.querySelector(".updatePasswordForm");

// UPDATE PROFILE FORM
updateProfileForm.addEventListener('submit', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Confirm Update',
        text: "Do you want to update your profile?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, update',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then(result => {
        if (result.isConfirmed) {

            const formData = new FormData(updateProfileForm);
            const action = updateProfileForm.action;

            fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token'),
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? 'Profile Updated' : 'Update Failed',
                        text: data.message || '',
                    });

                    if (data.success) {
                        setTimeout(() => location.reload(), 1500);
                    }
                });
        }
    });
});

// UPDATE PASSWORD FORM
updatePasswordForm.addEventListener('submit', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Confirm Password Change',
        text: "Do you want to update your password?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it',
    }).then(result => {
        if (result.isConfirmed) {

            const formData = new FormData(updatePasswordForm);
            const action = updatePasswordForm.action;

            fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token'),
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {

                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? 'Password Updated' : 'Update Failed',
                        text: data.message || '',
                    });

                    if (data.success) {
                        updatePasswordForm.reset();
                    }
                });
        }
    });
});

document.querySelectorAll('.toggle-password').forEach(toggle => {
    const input = toggle.previousElementSibling;
    const eyeOpen = toggle.querySelector('.eye-open');
    const eyeClosed = toggle.querySelector('.eye-closed');

    toggle.addEventListener('click', function (e) {
        e.preventDefault();
        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.remove('active');
            eyeClosed.classList.add('active');
        } else {
            input.type = 'password';
            eyeOpen.classList.add('active');
            eyeClosed.classList.remove('active');
        }
    });
});
