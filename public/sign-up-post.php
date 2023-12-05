<?php
// Include config file
require_once __DIR__ . "/../autoload.php";

use src\Managers\UsersManager;

$recaptcha_secret_key = "your_secret_key";
$recaptcha_response = $_POST['g-recaptcha-response'];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = [
    'secret' => $recaptcha_secret_key,
    'response' => $recaptcha_response,
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$json_result = json_decode($result, true);

if ($json_result['success']) {
    // Retrieve POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userCheckResult = UsersManager::checkUser($username);
    if (!$userCheckResult) {
        DatabaseManager::addNewUser($username, $password);
    }
} else {
    // CAPTCHA verification failed
    return false;
}
