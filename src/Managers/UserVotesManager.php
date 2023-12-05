<?php

namespace src\Managers;

use PDO;

class UserVotesManager extends AbstractManager
{
    public function getUserVotes(int $userId): array
    {
        $programmingLanguages = $this->getDatabaseInstance()->prepare("SELECT * FROM user_votes WHERE user_id = {$userId}");
        $programmingLanguages->execute();
        return $programmingLanguages->fetchAll(PDO::FETCH_ASSOC);
    }
}
