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

    // Insert color in table 'colors'
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

    // Deletes color in table 'colors' given id
    public function deleteColor($color_id)
    {
        $stmt = $this->connection->prepare('DELETE FROM colors WHERE id=:color_id');
        $stmt->bindValue(':color_id', $color_id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            $stmt = $this->connection->prepare('DELETE FROM user_colors WHERE color_id = :color_id');
            $stmt->bindValue(':color_id', $color_id, SQLITE3_INTEGER);
            return true;
        } else {
            return false;
        }
    }

    // Updates color name in table 'colors' given id
    public function updateColor($color_id,$name)
    {
        $stmt = $this->connection->prepare('UPDATE colors SET name = :name WHERE id=:color_id');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':color_id', $color_id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

     // Inserts user in table 'users' and assigns their colors in 'user_colors'
    public function insertUser($uname, $email, $color_ids)
    {
        $stmt = $this->connection->prepare('INSERT INTO users (name, email) VALUES (:uname, :email)');
        $stmt->bindValue(':uname', $uname, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);

        if ($stmt->execute()) {
            // gets user id. Will break with asynchronous database manipulation (which this isn't built for)
            $user_id = $this->connection->lastInsertId();
            $color_ids = array_map('trim', explode(',', $color_ids));

            $stmt = $this->connection->prepare('DELETE FROM user_colors WHERE user_id=:user_id');
            $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
            $stmt->execute();

            $stmt = $this->connection->prepare('INSERT INTO user_colors (user_id, color_id)  VALUES (:user_id, :color_id)');

            foreach($color_ids as $color_id){
                # Should check if color id exists    
                $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
                $stmt->bindValue(':color_id', $color_id, SQLITE3_INTEGER);
                $stmt->execute();
            }
            return true;
        } else {
            return false;
        }
    }

    // Deletes user from table 'users' and 'user_colors'
    public function deleteUser($user_id)
    {
        $stmt = $this->connection->prepare('DELETE FROM users WHERE id=:user_id');
        $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            $stmt = $this->connection->prepare('DELETE FROM user_colors WHERE user_id = :user_id');
            $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }

    // Updates user from table 'users' and their assigned colors in 'user_colors'
    public function updateUser($user_id, $uname, $email, $color_ids)
    {
        // Update users table
        $stmt = $this->connection->prepare('UPDATE users SET name = :uname, email = :email WHERE id=:user_id');
        $stmt->bindValue(':uname', $uname, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            // Removes any color assignments
            # Doing this everytime may be a burden on the database, could modify only the colors that changed
            $stmt = $this->connection->prepare('DELETE FROM user_colors WHERE user_id=:user_id');
            $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
            $stmt->execute();
            $color_ids = explode(",", trim($color_ids));

            foreach($color_ids as $color_id){
                # Should check if color id exists
                // Re-assigns new colors
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

}