<?php

class Connection {

    private $databaseFile;
    private $connection;

    public function __construct()
    {
        $this->databaseFile = realpath(__DIR__ . "/database/db.sqlite");
        $this->connect();
    }

    private function connect()
    {
        return $this->connection = new PDO("sqlite:{$this->databaseFile}");
    }

    public function getConnection()
    {
        return $this->connection ?: $this->connection = $this->connect();
    }

    public function query($query)
    {
        $result = $this->getConnection()->query($query);

        $result->setFetchMode(PDO::FETCH_INTO, new stdClass);

        return $result;
    }

    public function insertColor($name)
    {
        $stmt = $this->connection->prepare('INSERT INTO colors (name) VALUES (:name)');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteColor($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM colors WHERE id=:id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateColor($id,$name)
    {
        $stmt = $this->connection->prepare('UPDATE colors SET name = :name WHERE id=:id');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertUser($uname, $email, $color_ids)
    {
        $stmt = $this->connection->prepare('INSERT INTO users (name, email) VALUES (:uname, :email)');
        $stmt->bindValue(':uname', $uname, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);

        if ($stmt->execute()) {
            $user_id = $this->connection->lastInsertId();
            $color_ids = explode(",", trim($color_ids));
            foreach($color_ids as $color_id){
                #check if color id exists
                $stmt = $this->connection->prepare('INSERT INTO user_colors (user_id, color_id)  VALUES (:user_id, :color_id)');
                $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
                $stmt->bindValue(':color_id', $color_id, SQLITE3_INTEGER);
                $stmt->execute();
            }
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM users WHERE id=:id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($id,$uname, $email, $color_ids)
    {
        $stmt = $this->connection->prepare('UPDATE users SET name = :uname, email = :email WHERE id=:id');
        $stmt->bindValue(':uname', $uname, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            $stmt = $this->connection->prepare('DELETE FROM user_colors WHERE user_id=:id');
            $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            $stmt->execute();
            $color_ids = explode(",", trim($color_ids));
            foreach($color_ids as $color_id){
                #check if color id exists
                $stmt = $this->connection->prepare('INSERT INTO user_colors (user_id, color_id)  VALUES (:user_id, :color_id)');
                $stmt->bindValue(':user_id', $id, SQLITE3_INTEGER);
                $stmt->bindValue(':color_id', $color_id, SQLITE3_INTEGER);
                $stmt->execute();
            }
            return true;
        } else {
            return false;
        }
    }

}