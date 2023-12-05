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
                    <div class="invalid-feedback">First Name invalid</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input id="lastname" type="text" class="form-control" placeholder="Last name">
                    <div class="invalid-feedback">Last Name invalid</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input id="username" type="email" class="form-control" placeholder="Enter email">
                    <div class="invalid-feedback">Email address invalid</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input id="password" type="password" class="form-control"  placeholder="Password">
                    <div class="invalid-feedback">Must be atleast 8 characters, 1 uppercase letter, 1 special character</div>
                </div>
                <!-- Add reCAPTCHA widget -->
                <div class="g-recaptcha" data-sitekey="your_site_key"></div>
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
<script src="./assets/js/tabler.min.js?1692870487" defer></script>
<script src="./assets/js/demo.min.js?1692870487" defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="./assets/js/sign-up.js?1692870487" defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
