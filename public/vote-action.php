<?php
session_start();

require_once __DIR__ . "/../autoload.php";

use src\Managers\UserVotesManager;

$userID = $_SESSION['userId'];
$languageID = $_POST['language'];

$response = array(
    'success' => true,
    'message' => 'Sign In successful'
);

$userManager = new UserVotesManager();
$userCheckResult = $userManager->vote($userID, $languageID);

header('Content-Type: application/json');
echo json_encode($response);
