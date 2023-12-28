<?php
class Database
{

    private $dbh; // Database Handler
    private $stmt; // Statement (query)

    function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=dbkantin'; // Data Source Name

        try {
            $this->dbh = new PDO($dsn, 'akfalah', '2905'); // Try to connect database
        } catch (PDOException $e) {
            die($e->getMessage()); // Get error message
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function insertId()
    {
        return $this->dbh->lastInsertId();
    }

    public function fetch()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
