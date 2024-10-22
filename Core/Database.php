<?php

namespace Core;
use PDO;
use PDOStatement;

class Database {
    public PDO $connection;
    public PDOStatement $statement;

    public function __construct($config, $username='root', $pwd='')
    {
        $dsn = 'mysql://' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn,$username,$pwd, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $results = $this->find();

        if (! $results)
        {
            abort();
        }

        return $results;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }
}
