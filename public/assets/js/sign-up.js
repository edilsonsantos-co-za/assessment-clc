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

        if (username.val() === '') {
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
                url: 'sign-up-post.php',
                data: formData,
                success: function (response) {
                    if (!response) {

                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
});
