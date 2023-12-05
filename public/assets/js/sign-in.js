$(document).ready(function () {
    $('#signinForm').submit(function (e) {
        e.preventDefault();

        var username = $('#username');
        var password = $('#password');
        var failed = false;

        // Reset the classes
        username.removeClass('is-invalid');
        password.removeClass('is-invalid');

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

        if (failed !== true) {
            // Get form data
            var formData = {
                'username': $('#username').val(),
                'password': $('#password').val()
            };

            // You can submit the form using AJAX here
            $.ajax({
                type: 'POST',
                url: 'sign-in-action.php',
                data: formData,
                success: function (response) {
                    console.log('Server response:', response);

                    // Your handling logic here
                    if (response.success) {
                        window.location.href = 'index.php';
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
