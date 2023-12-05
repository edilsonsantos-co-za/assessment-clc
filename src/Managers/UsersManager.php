<?php

namespace src\Managers;

use PDO;

class UsersManager extends AbstractManager
{
    public function checkUser($username): bool
    {
        $exists = false;
        $checkUserExists = $this->getDatabaseInstance()->prepare("SELECT id FROM user WHERE username = :username");
        $checkUserExists->bindParam(":username", $username, PDO::PARAM_STR);
        $checkUserExists->execute();
        $results = $checkUserExists->fetch(PDO::FETCH_ASSOC);
        if (is_array($results)){
            $exists = true;
        }

        return $exists;
    }

    public function addNewUser(string $username, string $password): bool
    {
        $addedSuccessFully = false;
        $addNewUser = $this->getDatabaseInstance()->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
        $addNewUser->bindParam(":username", $username, PDO::PARAM_STR);
        $hashedPassword = md5($password);
        $addNewUser->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        if ($addNewUser->execute()) {
            $addedSuccessFully = true;
        }

        return $addedSuccessFully;
    }
}
