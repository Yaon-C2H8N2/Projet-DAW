<?php
include_once '../app/models/User.php';

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
     * @param string $firstname
     * User first name
     * @param string $lastname
     * User last name
     * @param string $birthdate
     * User birth date
     * @param string $pseudo
     * User pseudo
     */
    public function createUser(string $login, string $password, string $firstname, string $lastname, string $birthdate, string $pseudo): int
    {
        $salt = hash('sha256', random_bytes(32));
        $password = hash('sha256', $password . $salt);
        $sth = $this->dbh->prepare("INSERT INTO login (login, password, salt) VALUES (:login, :password, :salt)");
        $sth->bindParam(":login", $login);
        $sth->bindParam(":password", $password);
        $sth->bindParam(":salt", $salt);
        $sth->execute();

        $sth = $this->dbh->prepare("SELECT id FROM login WHERE login = :login AND password = :password");
        $sth->bindParam(":login", $login);
        $sth->bindParam(":password", $password);
        $sth->execute();
        $id = $sth->fetch(PDO::FETCH_ASSOC)['id'];

        $sth = $this->dbh->prepare("INSERT INTO userinfo (iduser, pseudo, nom, prenom, date_naissance) VALUES (:id, :pseudo, :lastname, :firstname, :birthdate)");
        $sth->bindParam(":id", $id);
        $sth->bindParam(":firstname", $firstname);
        $sth->bindParam(":lastname", $lastname);
        $sth->bindParam(":birthdate", $birthdate);
        $sth->bindParam(":pseudo", $pseudo);
        $sth->execute();
        return $id;
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
        if (!$result) {
            return false;
        }
        return $result['login'] == $login;
    }

    /**
     * Check if already a pseudo already exists in the database
     * @param string $pseudo
     * User pseudo
     * @return bool
     * True if the pseudo exists, false otherwise
     */
    public function pseudoExists(string $pseudo): bool
    {
        $sth = $this->dbh->prepare("SELECT pseudo FROM userinfo WHERE pseudo = :pseudo");
        $sth->bindParam(":pseudo", $pseudo);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return false;
        }
        return $result['pseudo'] == $pseudo;
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

    /**
     * Get the information to build a user object
     * @param string $login
     * User mail address used as login
     * @return User
     * User object
     */
    public function loadUser(string $login): User
    {
        $sth = $this->dbh->prepare("SELECT iduser, pseudo, nom, prenom,date_naissance,image_profil FROM userinfo WHERE iduser = (SELECT id FROM login WHERE login = :login)");
        $sth->bindParam(":login", $login);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if ($result['image_profil'] == null) $result['image_profil'] = "default.png"; //TODO : fix this
        return new User($result['iduser'], $result['pseudo'], $result['nom'], $result['prenom'], $result['image_profil'], $result['date_naissance']);
    }

    public function createTopic(string $title, string $content, int $iduser): int
    {
        $sth = $this->dbh->prepare("INSERT INTO topic (nom_topic, idauteur, date_creation) VALUES (:title, :iduser, now()::timestamp) RETURNING idtopic;");
        $sth->bindParam(":title", $title);
        $sth->bindParam(":iduser", $iduser);
        $sth->execute();
        $idtopic = $sth->fetch(PDO::FETCH_ASSOC)['idtopic'];
        return $idtopic;
    }

    public function createPost(string $content, int $iduser, int $idtopic): void
    {
        $sth = $this->dbh->prepare("INSERT INTO messages (idauteur, idtopic, content, date) VALUES (:iduser, :idtopic, :content, now()::timestamp);");
        $sth->bindParam(":content", $content);
        $sth->bindParam(":iduser", $iduser);
        $sth->bindParam(":idtopic", $idtopic);
        $sth->execute();
    }

    /**
     * @return void + affiche le nombre de personne en tout dans le site
     */
    public function getMaxNoteForUser(int $iduser): int
    {
        $nb_element = $this->dbh->query("SELECT MAX(note) FROM qcmresults WHERE iduser = $iduser;")->fetchColumn();
        if ($nb_element == 0) return 0;
        return $nb_element;
    }

    /**
     * @return void + affiche le nombre de personne en tout dans le site
     */
    public function getNBQCMForUser(int $iduser): int
    {
        return $this->dbh->query("SELECT COUNT(iduser) FROM qcmresults WHERE iduser = $iduser;")->fetchColumn();
    }

    /**
     * @return void + affiche le nombre de personne en tout dans le site
     */
    public function getNBUser(): int
    {
        return $this->dbh->query("SELECT COUNT(id) FROM login;")->fetchColumn();
    }

    /**
     * @return void + affiche le nombre de personne en tout dans le site
     */
    public function getNBMessage(): int
    {
        return $this->dbh->query("SELECT COUNT(idauteur) FROM messages;")->fetchColumn();
    }

    /**
     * @return void + affiche le nombre de QCM en tout dans le site
     */
    public function getQCM_Done(): int
    {
        return $this->dbh->query("SELECT COUNT(note) FROM qcmresults;")->fetchColumn();
    }

    /**
     * @return void + affiche le nombre de QCM en tout dans le site
     */
    public function getQCM_ToDo(): int
    {
        return $this->dbh->query("SELECT COUNT(id) FROM qcm;")->fetchColumn();
    }

    /**
     * @return void + affiche le nombre de personne en tout dans le site
     */
    public function getNBForumOnSite(): int
    {
        return $this->dbh->query("SELECT COUNT(idtopic) FROM topic;")->fetchColumn();
    }

    /**
     * @return void + affiche le nombre de personne en tout dans le site
     */
    public function getNbReponseToTopic(int $id_topic): int
    {
        return $this->dbh->query("SELECT COUNT(idtopic) FROM messages WHERE idtopic = $id_topic;")->fetchColumn();
    }


    public function getTopics(): array
    {
        $sth = $this->dbh->prepare("SELECT topic.idtopic, userinfo.pseudo, nom_topic, max(messages.date) as lastMessage FROM topic, messages, userinfo WHERE topic.idtopic = messages.idtopic AND topic.idauteur = userinfo.iduser GROUP BY topic.idtopic, userinfo.pseudo, nom_topic ORDER BY max(messages.date) DESC");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTopicMessages(int $idtopic): array
    {
        $sth = $this->dbh->prepare("SELECT userinfo.pseudo, userinfo.image_profil, messages.content, messages.date FROM userinfo, messages WHERE userinfo.iduser = messages.idauteur AND messages.idtopic = :idtopic ORDER BY messages.date ASC");
        $sth->bindParam(":idtopic", $idtopic);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateUserInfo(int $iduser, string $pseudo, string $nom, string $prenom, string $date_naissance): bool
    {
        $sth = $this->dbh->prepare("UPDATE userinfo SET pseudo = :pseudo, nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE iduser = :iduser");
        $sth->bindParam(":pseudo", $pseudo);
        $sth->bindParam(":nom", $nom);
        $sth->bindParam(":prenom", $prenom);
        $sth->bindParam(":date_naissance", $date_naissance);
        $sth->bindParam(":iduser", $iduser);
        return $sth->execute();
    }

    public function updateUserLogin(int $iduser, string $login, string $password): bool
    {
        $sth = $this->dbh->prepare("UPDATE login SET login = :login, password = :password WHERE id = :iduser");
        $sth->bindParam(":login", $login);
        $password_salted = hash('sha256', $password . $this->getSaltWithId($iduser));
        $sth->bindParam(":password", $password_salted);
        $sth->bindParam(":iduser", $iduser);
        return $sth->execute();
    }

    /**
     * Access stored salt for a given user
     * @param string $login
     * User mail address used as login
     * @return string
     * User salt
     */
    public function getSaltWithId(int $id): string
    {
        return $this->getLoginFromId($id)['salt'];
    }

    public function getLoginFromId(int $iduser): array
    {
        $sth = $this->dbh->prepare("SELECT login, password, salt FROM login WHERE id = :iduser");
        $sth->bindParam(":iduser", $iduser);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);

    }

    public function updateUserImage(int $iduser, string $image): bool
    {
        $sth = $this->dbh->prepare("UPDATE userinfo SET image_profil = :image WHERE iduser = :iduser");
        $sth->bindParam(":image", $image);
        $sth->bindParam(":iduser", $iduser);
        return $sth->execute();
    }

}