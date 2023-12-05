<?php
// Include config file
require_once __DIR__ . "/../autoload.php";

use src\Managers\UsersManager;

// Retrieve POST data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];

$result = UsersManager::checkUser($username);

//DatabaseManager::addNewUser();