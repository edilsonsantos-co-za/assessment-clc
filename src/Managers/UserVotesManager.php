<?php

namespace src\Managers;

class UserVotesManager extends AbstractManager
{
    public function getUserVotes(int $userId): array
    {
        $programmingLanguages = $this->getDatabaseInstance()->prepare("SELECT * FROM programming_languages WHERE user_id = {$userId}");
        $programmingLanguages->execute();
        return $programmingLanguages->fetchAll(PDO::FETCH_ASSOC);
    }
}
