<?php

namespace src\Managers;

use PDO;
use src\Managers\UsersManager;

class UserVotesManager extends AbstractManager
{
    public function getAllVotesGroupedByProgrammingLanguage()
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
}
