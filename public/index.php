<?php
session_start();

// Check if the session variable exists
if (!isset($_SESSION['username'])) {
    // Redirect to another page
    header("Location: sign-in.php");
    exit();
}

require_once __DIR__ . "/../autoload.php";

use src\Managers\ProgrammingLanguagesManager;
use src\Managers\UsersManager;
use src\Managers\UserVotesManager;

$programmingLanguagesManager = new ProgrammingLanguagesManager();
$languages = $programmingLanguagesManager->getProgrammingLanguages();

$usersManager = new UsersManager();
$userId = $usersManager->getUserIdByUsername($_SESSION['username']);
$_SESSION['userId'] = $userId;

$userVotesManager = new UserVotesManager();
$allUserVotes = $userVotesManager->getAllVotesGroupedByProgrammingLanguage();
$currentUserVotes = $userVotesManager->checkIfUserHasVoted($userId);
?>
<!doctype html>
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
                <h1 class="mt-5">Welcome <?php echo $_SESSION['username'] ?></h1>
            </div>
            <div class="hr-text hr-text-center hr-text-spaceless">Voting data</div>
            <div class="card-body">
                <?php
                    if (count($allUserVotes) == 0) {
                        ?>
                        <div class="empty">
                            <p class="empty-title">No results found</p>
                            <p class="empty-subtitle text-secondary">
                                No user has voted yet, be the first :-)
                            </p>
                        </div>
                <?php
                    } else {
                        foreach ($allUserVotes as $userVote) {
                            echo "<div class='d-flex mb-2'>
                            <div>{$userVote['programming_language']}</div>
                                <div class='ms-auto'>
                                    <span class='text-green d-inline-flex align-items-center lh-1'>
                                        ".(int) $userVote['percentage_of_votes']."%
                                    </span>
                                </div>
                            </div>
                            <div class='progress progress-sm'>
                                <div class='progress-bar bg-primary' style='width: {$userVote['percentage_of_votes']}%' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='{$userVote['percentage_of_votes']}' aria-label='{{$userVote['percentage_of_votes']}}%'>
                                    <span class='visually-hidden'>{$userVote['percentage_of_votes']}%</span>
                                </div>
                            </div>
                            <br />";
                        }
                    }
                ?>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-list justify-content-end">
                    <a href="sign-out.php" class="btn btn-link link-secondary">
                        Sign Out
                    </a>
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-vote">
                        Vote
                    </a>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-vote" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Vote for your favourite programming language</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">What is your favourite coding language?</label>
                                    <select class="form-select mb-0" id="dropdown">
                                        <?php
                                        foreach ($languages as $language) {
                                            ?>
                                            <option value="<?php echo $language['id'] ?>"><?php echo $language['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <?php
                            if ($currentUserVotes) {
                        ?>
                                <a href="#" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modal-danger">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Submit Vote
                                </a>
                        <?php
                            } else {
                        ?>
                                <a id="vote" href="#" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modal-success">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Submit Vote
                                </a>
                        <?php
                         }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-success"></div>
                    <div class="modal-body text-center py-4">
                        <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                        <h3>Voting Success</h3>
                        <div class="text-secondary">Your vote has been added to the poll</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Go to dashboard
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                        <h3>Warning</h3>
                        <div class="text-secondary">You cannot vote more than once</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="./assets/js/tabler.min.js?1692870487" defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

    $(document).ready(function () {
        // Attach a click event handler to the button
        $('#vote').on('click', function () {
            var dropdown = document.getElementById("dropdown");

            // Get the selected value
            var selectedValue = dropdown.options[dropdown.selectedIndex].value;

            // Get form data
            var formData = {
                'language': selectedValue
            };

            // Perform the AJAX call
            $.ajax({
                type: 'POST', // or 'POST' depending on your server-side endpoint
                url: 'vote-action.php',  // Replace with your actual API endpoint
                data: formData,
                success: function (response) {
                    // Handle the success response
                    $('#modal-success').on('hidden.bs.modal', function () {
                        // Reload the page when the modal is closed
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        });
    });
</script>
</body>
</html>
