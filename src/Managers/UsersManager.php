<?php

namespace src\Managers;

use PDO;

class UsersManager extends AbstractManager
{
    public function checkNewUser(string $username): bool
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

    public function checkExistingUser(string $username, string $password): bool
    {
        $valid = false;
        $checkUserExists = $this->getDatabaseInstance()->prepare("SELECT password FROM user WHERE username = :username");
        $checkUserExists->bindParam(":username", $username, PDO::PARAM_STR);
        $checkUserExists->execute();
        $results = $checkUserExists->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $result) {
            if ($result['password'] === md5(trim($password))) {
                $valid = true;
            }
        }

        return $valid;
    }

    public function addNewUser(string $username, string $password): bool
    {
        $addedSuccessFully = false;
        $addNewUser = $this->getDatabaseInstance()->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
        $addNewUser->bindParam(":username", $username, PDO::PARAM_STR);
        $hashedPassword = md5(trim($password));
        $addNewUser->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        if ($addNewUser->execute()) {
            $addedSuccessFully = true;
        }

        return $addedSuccessFully;
    }

    public function getUserIdByUsername(string $username): ?string
    {
        $result = null;
        $checkUserExists = $this->getDatabaseInstance()->prepare("SELECT id FROM user WHERE username = :username");
        $checkUserExists->bindParam(":username", $username, PDO::PARAM_STR);
        $checkUserExists->execute();
        $results = $checkUserExists->fetch(PDO::FETCH_ASSOC);
        if (is_array($results)){
            $result = $results['id'];
        }

        return $result;
    }
}
