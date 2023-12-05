<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign up - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="./assets/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="./assets/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="./assets/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="./assets/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="./assets/css/demo.min.css?1692870487" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body  class=" d-flex flex-column">
<script src="./assets/js/demo-theme.min.js?1692870487"></script>
<div class="page page-center">
    <div class="container container-tight py-4">
        <form id="signupForm" class="card card-md" action="../src/Controllers/signUpController.php" method="get" autocomplete="off" novalidate>
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Create new account</h2>
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input id="firstname" type="text" class="form-control" placeholder="First name">
                    <div class="invalid-feedback">No First Name provided</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input id="lastname" type="text" class="form-control" placeholder="Last name">
                    <div class="invalid-feedback">No Last Name provided</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input id="username" type="email" class="form-control" placeholder="Enter email">
                    <div class="invalid-feedback">No email address provided</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input id="password" type="password" class="form-control"  placeholder="Password">
                    <div class="invalid-feedback">No password provided</div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Create new account</button>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            Already have account? <a href="./sign-in.php" tabindex="-1">Sign in</a>
        </div>
    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="./assets/js/tabler.min.js?1692870487" defer></script>
<script src="./assets/js/demo.min.js?1692870487" defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
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

            if (password.val() === '') {
                // If validation fails, update the class to 'error'
                password.addClass('is-invalid');
                failed = true;
            }

            // Validate the password using a regular expression
            var passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(.{8,})$/;

            if (!passwordRegex.test(password.val())) {
                // Display an error message
                $('#passwordError').text('Password must be at least 8 characters long, contain at least 1 uppercase letter, and at least 1 special character.');
            } else {
                failed = true;
                // Password is valid, you can submit the form or perform additional actions
                $('#passwordError').text('');
                // Uncomment the following line to submit the form
                // $('#myForm').unbind('submit').submit();
            }

            // Get form data
            var formData = {
                'firstname': $('#firstname').val(),
                'lastname': $('#lastname').val(),
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
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    });
</script>
</body>
</html>