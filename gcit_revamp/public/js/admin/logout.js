document.querySelector('.logout-btn').addEventListener('click', function (e) {
    e.preventDefault();

    const form = document.getElementById('logout-form');
    const action = form.action;
    const csrfToken = form.querySelector('input[name="_token"]').value;

    Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out from the system.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, log out!'
    }).then(result => {
        if (result.isConfirmed) {

            fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Logged Out',
                        text: data.message || 'You have been logged out successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            location.reload();
                        }
                    }, 1200);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Logout failed.'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.'
                });
            });
        }
    });
});
