<?php

namespace src;

class DatabaseConnection
{
    public PDO $instance;

    protected string $host;

    protected string $dbname;

    protected string $username;

    protected string $password;

    public function __construct()
    {
        $this->instance = $this->setDatabaseConnection();
    }

    protected function setDatabaseConnection()
    {
        if (is_null($this->getInstance())) {
            $this->createDatabaseConnection();
        }
    }

    protected function createDatabaseConnection()
    {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4", $this->username, $this->password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->setInstance($pdo);
        } catch (PDOException $e) {
            // Handle connection errors
            die("Connection failed: " . $e->getMessage());
        }
    }

    protected static function importDatabaseConfig(): array
    {
        return include_once(__DIR__ . '/../config/database.php');
    }

    /**
     * @return PDO|void
     */
    public function getInstance(): PDO
    {
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
}
