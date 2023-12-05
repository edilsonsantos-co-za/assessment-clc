$(document).ready(function () {
    $('#signupForm').submit(function (e) {
        e.preventDefault();

        var firstname = $('#firstname');
        var lastname = $('#lastname');
        var username = $('#username');
        var password = $('#password');
        var failed = false;

        // Reset the classes
        firstname.removeClass('is-invalid');
        lastname.removeClass('is-invalid');
        username.removeClass('is-invalid');
        password.removeClass('is-invalid');

        if (firstname.val() === '') {
            // If validation fails, update the class to 'error'
            firstname.addClass('is-invalid');
            failed = true;
        }

        if (lastname.val() === '') {
            // If validation fails, update the class to 'error'
            lastname.addClass('is-invalid');
            failed = true;
        }

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (username.val() === '' || !emailRegex.test(username.val())) {
            // If validation fails, update the class to 'error'
            username.addClass('is-invalid');
            failed = true;
        }

        // Validate the password using a regular expression
        var passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(.{8,})$/;
        if (password.val() === '' || !passwordRegex.test(password.val())) {
            // If validation fails, update the class to 'error'
            password.addClass('is-invalid');
            failed = true;
        }

        // Get form data
        var formData = {
            'username': $('#username').val(),
            'password': $('#password').val()
        };

        if (failed !== true) {
            // You can submit the form using AJAX here
            $.ajax({
                type: 'POST',
                url: 'sign-up-action.php',
                data: formData,
                success: function (response) {
                    console.log('Server response:', response);

                    // Your handling logic here
                    if (response.success) {
                        var modal = new bootstrap.Modal(document.getElementById('modal-success'));
                        modal.show();

                        // Redirect to another page after the modal is fully shown
                        $('#modal-success').on('hidden.bs.modal', function () {
                            window.location.href = 'sign-in.php';
                        });
                    } else {
                        document.getElementById('modal-failure-message').innerHTML = response.message;
                        var modal = new bootstrap.Modal(document.getElementById('modal-danger'));
                        modal.show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
});
