<?php

namespace app;

use Exception;
use mysqli;

class Db
{

    /**
     * @var mysqli
     */
    private $connection;

    /**
     * @return Db
     */
    public function __construct()
    {
        try {
            $this->connection = new mysqli("db", "root", "FlowerPoodleRocket1398-", "cpos");
            if ($this->connection->connect_errno) {
                exit("Failed to connect to MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error);
            } else {
                $this->connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            }
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function finish()
    {
        $status = $this->connection->commit();
        $this->connection->close();
        return $status;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
