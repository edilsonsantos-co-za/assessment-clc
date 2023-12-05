<?php
// Start or resume the session
session_start();

// Include config file
require_once __DIR__ . "/../autoload.php";

use src\Managers\UserVotesManager;

// Retrieve POST data
$userID = $_SESSION['userId'];
$languageID = $_POST['language'];

$response = array(
    'success' => true,
    'message' => 'Sign In successful'
);

$userManager = new UserVotesManager();
$userCheckResult = $userManager->vote($userID, $languageID);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
