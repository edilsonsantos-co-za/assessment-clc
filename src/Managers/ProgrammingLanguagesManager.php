<?php

namespace src\Managers;

use PDO;
use src\Helpers\DatabaseHelper;

class ProgrammingLanguagesManager extends AbstractManager
{
    public function getProgrammingLanguages(): array
    {
        $programmingLanguages = $this->getDatabaseInstance()->prepare("SELECT * FROM programming_languages");
        $programmingLanguages->execute();
        return $programmingLanguages->fetchAll(PDO::FETCH_ASSOC);
    }
}
