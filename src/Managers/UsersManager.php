<?php

namespace src\Managers;

use PDO;
use src\Helpers\DatabaseHelper;

class UsersManager
{
    protected static function getDatabaseInstance(): PDO
    {
        $dbConnection = new DatabaseHelper();
        return $dbConnection->getInstance();
    }

    public static function checkUser($username): string
    {
        $txt = '';
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";

        if($stmt = self::getDatabaseInstance()->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($username);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $txt = "This username is already taken.";
                } else{
                    $txt = trim($username);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }

        return $txt;
    }

    public static function addNewUser(string $username, string $password)
    {
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        if($stmt = self::getDatabaseInstance()->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: ../../public/login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
}