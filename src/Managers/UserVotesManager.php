<?php

namespace src\Managers;

use PDO;
use src\Managers\UsersManager;

class UserVotesManager extends AbstractManager
{
    public function getAllVotesGroupedByProgrammingLanguage(): array
    {
        $userVotes = $this->getDatabaseInstance()->prepare("
        SELECT
            p.name AS programming_language,
            COUNT(uv.id) AS total_votes,
            (COUNT(uv.id) / (SELECT COUNT(*) FROM user_votes)) * 100 AS percentage_of_votes
        FROM
            user_votes uv
        JOIN
            programming_languages p ON uv.programming_languages_id = p.id
        GROUP BY
            uv.programming_languages_id, p.name");

        $userVotes->execute();
        return $userVotes->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkIfUserHasVoted(int $userId): bool
    {
        $exists = false;
        $checkUserExists = $this->getDatabaseInstance()->prepare("SELECT * FROM user_votes WHERE user_id = :userId");
        $checkUserExists->bindParam(":userId", $userId, PDO::PARAM_STR);
        $checkUserExists->execute();
        $results = $checkUserExists->fetch(PDO::FETCH_ASSOC);
        if (is_array($results)){
            $exists = true;
        }

        return $exists;
    }

    public function vote(int $userId, string $languageID): void
    {
        $exists = false;
        $checkUserExists = $this->getDatabaseInstance()->prepare("INSERT INTO user_votes (user_id, programming_languages_id) VALUES (:userId, :programming_languages_id)");
        $checkUserExists->bindParam(":userId", $userId, PDO::PARAM_STR);
        $checkUserExists->bindParam(":programming_languages_id", $languageID, PDO::PARAM_STR);
        $checkUserExists->execute();
    }
}
