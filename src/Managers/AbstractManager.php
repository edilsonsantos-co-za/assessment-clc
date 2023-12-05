<?php

namespace src\Managers;

use PDO;
use src\Helpers\DatabaseHelper;

class AbstractManager implements ManagerInterface
{
    /**
     * @return PDO
     */
    public function getDatabaseInstance(): PDO
    {
        $dbConnection = new DatabaseHelper();
        return $dbConnection->getInstance();
    }
}
