<?php
$results = [
        'PHP' => '10',
        'C#' => '20',
        'C' => '30',
        'JAVA' => '40',
        'Python' => '50',
        'C++' => '60'
];
?>
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Wizard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
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
        <div class="card card-md">
            <div class="card-body text-center py-4 p-sm-5">
                <img src="./assets/static/illustrations/undraw_sign_in_e6hj.svg" height="120" class="mb-n2" alt="">
                <h1 class="mt-5">Welcome {NAME}</h1>
            </div>
            <div class="hr-text hr-text-center hr-text-spaceless">Voting data</div>
            <div class="card-body">
                <?php
                foreach ($results as $key => $result) {
                    echo "<div class='d-flex mb-2'>
                    <div>{$key}</div>
                    <div class='ms-auto'>
                        <span class='text-green d-inline-flex align-items-center lh-1'>
                          {$results[$key]}%
                        </span>
                    </div>
                </div>
                <div class='progress progress-sm'>
                    <div class='progress-bar bg-primary' style='width: {$results[$key]}%' role='progressbar' aria-valuenow='{$results[$key]}' aria-valuemin='0' aria-valuemax='100' aria-label='{$results[$key]}% Complete'>
                        <span class='visually-hidden'>{$results[$key]}% complete</span>
                    </div>
                </div>
                <br />";
                }
                ?>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-list justify-content-end">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-report">
                        Vote
                    </a>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Vote For your favourite programming language</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">What is your favourite coding language?</label>
                                    <select class="form-select mb-0">
                                        <option value="DST">PHP</option>
                                        <option value="U">C#</option>
                                        <option value="HST">C</option>
                                        <option value="HST">JAVA</option>
                                        <option value="HST">Python</option>
                                        <option value="HST">C++</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Submit Vote
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="./assets/js/tabler.min.js?1692870487" defer></script>
<script src="./assets/js/demo.min.js?1692870487" defer></script>
</body>
</html>