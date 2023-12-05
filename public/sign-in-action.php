<?php
session_start();

require_once __DIR__ . "/../autoload.php";

use src\Managers\UsersManager;

$username = $_POST['username'];
$password = $_POST['password'];

$response = array(
    'success' => true,
    'message' => 'Sign In successful'
);

$userManager = new UsersManager();
$userCheckResult = $userManager->checkExistingUser($username, $password);
if (!$userCheckResult) {
    $response = array(
        'success' => false,
        'message' => 'Information provided is invalid'
    );
}

$_SESSION['username'] = $username;

header('Content-Type: application/json');
echo json_encode($response);
