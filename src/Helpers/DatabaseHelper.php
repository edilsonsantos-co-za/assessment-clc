<?php

namespace src\Helpers;

use PDO;
use PDOException;

class DatabaseHelper
{
    public ?PDO $instance = null;

    protected string $host;

    protected string $dbname;

    protected string $username;

    protected string $password;

    protected string $port;

    public function __construct()
    {
        $this->setDatabaseVariables();
        $this->instance = $this->getInstance();
    }

    protected function createDatabaseConnection(): PDO
    {
        try {
            $pdo = new PDO("mysql:host=".$this->getHost().";port=".$this->getPort().";dbname=".$this->getDbname().";charset=utf8mb4", $this->getUsername(), $this->getPassword());

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            // Handle connection errors
            die("Connection failed: " . $e->getMessage());
        }
    }

    protected static function importDatabaseConfig(): array
    {
        return require(__DIR__ . '/../../config/database.php');
    }

    protected function setDatabaseVariables(): void
    {
        $config = $this->importDatabaseConfig()['mysql'];
        $this->setHost($config['host']);
        $this->setDbname($config['schema']);
        $this->setUsername($config['user']);
        $this->setPassword($config['password']);
        $this->setPort($config['port']);
    }

    /**
     * @return PDO|null
     */
    public function getInstance(): ?PDO
    {
        if (is_null($this->instance)) {
            $this->setInstance($this->createDatabaseConnection());
        }

        return $this->instance;
    }

    /**
     * @param PDO|void $instance
     */
    public function setInstance(PDO $instance): void
    {
        $this->instance = $instance;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getDbname(): string
    {
        return $this->dbname;
    }

    /**
     * @param string $dbname
     */
    public function setDbname(string $dbname): void
    {
        $this->dbname = $dbname;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function setPort(string $port): void
    {
        $this->port = $port;
    }
}
