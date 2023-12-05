<?php

namespace src\Managers;

interface ManagerInterface
{
    /**
     * @return mixed
     */
    public function getDatabaseInstance();
}
