<?php
// Include config file
require_once __DIR__ . "/../autoload.php";

use src\Managers\UsersManager;

$recaptcha_secret_key = "your_secret_key";
$recaptcha_response = 'PENDING';
//$recaptcha_response = $_POST['g-recaptcha-response'];

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

$response = array(
    'success' => true,
    'message' => 'User signed up successfully',
);

/**
 * TODO
 * - check the recaptcha result $json_result['success']
 */
if (true) {
    // Retrieve POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userManager = new UsersManager();
    $userCheckResult = $userManager->checkUser($username);
    if (!$userCheckResult) {
        $result = $userManager->addNewUser($username, $password);
        if (!$result) {
            $response = array(
                'success' => false,
                'message' => 'User add failed',
            );
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Username already exists',
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'CAPTCHA verification failed',
    );
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
