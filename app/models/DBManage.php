<?php

class DBManage
{
    private PDO $dbh;

    /**
     * DBManage constructor.
     */
    public function __construct()
    {
        try {
            $this->dbh = new PDO("pgsql:host=pgsql;dbname=postgres;port=5432", "postgres", "postgres");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Get the connection status
     * @return string
     * Connection status
     */
    public function getConnectionStatus(): string
    {
        return $this->dbh->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    }

    /**
     * Insert a new user in the database
     * @param string $login
     * User mail address used as login
     * @param string $password
     * User password
     */
    public function createUser(string $login, string $password): void
    {
        $salt = hash('sha256', random_bytes(32));
        $password = hash('sha256', $password . $salt);
        $sth = $this->dbh->prepare("INSERT INTO login (login, password, salt) VALUES (:login, :password, :salt)");
        $sth->bindParam(":login", $login);
        $sth->bindParam(":password", $password);
        $sth->bindParam(":salt", $salt);
        $sth->execute();
    }

    /**
     * Check if a user exists
     * @param string $login
     * User mail address used as login
     * @return bool
     * True if the user exists, false otherwise
     */
    public function userExists(string $login): bool
    {
        $sth = $this->dbh->prepare("SELECT login FROM login WHERE login = :login");
        $sth->bindParam(":login", $login);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            return false;
        }
        return $result['login'] == $login;
    }

    /**
     * Access stored salt for a given user
     * @param string $login
     * User mail address used as login
     * @return string
     * User salt
     */
    public function getSalt(string $login): mixed
    {
        $sth = $this->dbh->prepare("SELECT salt FROM login WHERE login = :login");
        $sth->bindParam(":login", $login);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['salt'];
    }

    /**
     * Compare the user password with the one in the database
     * @param $login
     * User mail address used as login
     * @param $password
     * User hashed and salted password
     * @return bool
     * True if the password is correct, false otherwise
     */
    public function comparePassword(string $login, string $password): bool
    {
        $sth = $this->dbh->prepare("SELECT password FROM login WHERE login = :login");
        $sth->bindParam(":login", $login);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['password'] == $password;
    }
}
