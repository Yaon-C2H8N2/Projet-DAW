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
     * @return Crée un nouvel utilisateur et l'ajoute dans la base de données
     */
    public function generateUser(): void
    {
        $liste_prenoms = array('Jean', 'Marie', 'Lucie', 'Sophie', 'Julie', 'Antoine', 'Pierre', 'Paul', 'Emilie',
            'Léa', 'Charlotte', 'Maxime', 'Mathilde', 'Camille', 'Thomas', 'Lucas', 'Benoit', 'Rémi', 'Olivier', 'Claire', '
            Anne', 'Julien', 'Nicolas', 'Vincent', 'Alice', 'Caroline', 'Elodie', 'Laurent', 'Alexandre', 'Hélène', 'Isabelle',
            'Juliette', 'Romain', 'Guillaume', 'Adrien', 'Bastien', 'Cédric', 'David', 'Elise', 'Estelle', 'Fanny', 'Florian',
            'Gael', 'Jessica', 'Jonathan', 'Julia', 'Laura', 'Laure', 'Loïc', 'Maeva', 'Manon', 'Mélanie', 'Mickael', 'Nathalie',
            'Nathanaël', 'Nicole', 'Sébastien', 'Sofia', 'Sylvain', 'Valentin', 'Yann', 'Yoann', 'Zoé', 'GMK', 'Lewis', 'Jason', 'Max',
            'Lucas', 'Emma', 'Liam', 'Olivia', 'Noah', 'Ava', 'Ethan', 'Sophia', 'Logan', 'Mia', 'Mason', 'Isabella', 'Elijah', 'Charlotte',
            'Caleb', 'Amelia', 'Benjamin', 'Harper', 'William', 'Evelyn', 'James', 'Abigail', 'Alexander', 'Emily', 'Michael', 'Elizabeth',
            'Daniel', 'Mila', 'Henry', 'Ella', 'Owen', 'Avery', 'Matthew', 'Sofia', 'Jackson', 'Camila', 'Sebastian', 'Aria', 'Joseph', 'Scarlett',
            'Levi', 'Victoria', 'David', 'Madison', 'Aiden', 'Luna', 'Grayson', 'Grace', 'Samuel', 'Chloe', 'Isaac', 'Penelope', 'Rahman', 'Yoan',
            'Bastien', 'Remy', 'Clement', 'Rina', 'Flo', 'Alex', 'Corentin', 'Simon');

        $liste_caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $liste_full_caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';


        $firstname = $liste_prenoms[rand(0, count($liste_prenoms))];
        $lastname = $liste_prenoms[rand(0, count($liste_prenoms))];
        $birthdate = mt_rand(strtotime("1900-01-01"), strtotime("2023-01-01"));
        $birthdate = date("Y-m-d", $birthdate);
        $password = "123456789";

        $pseudo = '';
        for ($i = 0; $i < rand(3, 15); $i++) {
            $indice_caractere = rand(0, strlen($liste_caracteres) - 1);
            $pseudo .= $liste_caracteres[$indice_caractere];
        }


        $login = '';
        for ($i = 0; $i < rand(2, 15); $i++) {
            $login .= $liste_full_caracteres[rand(0, strlen($liste_full_caracteres) - 1)];
        }

        $login .= '@neptune.com';
        $this->createUser($login, $password, $firstname, $lastname, $birthdate, $pseudo);
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
    public function loadUser(string $login): User|null
    {
        $sth = $this->dbh->prepare("SELECT iduser, pseudo, nom, prenom,date_naissance,image_profil FROM userinfo WHERE iduser = (SELECT id FROM login WHERE login = :login)");
        $sth->bindParam(":login", $login);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (!$result)
            return null;
        if ($result['image_profil'] == null) $result['image_profil'] = "default.png"; //TODO : fix this
        $user = new User($result['iduser'], $result['pseudo'], $result['nom'], $result['prenom'], $result['image_profil'], $result['date_naissance']);
        $user->isAdmin = $this->isAdmin($user->id);
        return $user;
    }

    public function isAdmin(int $iduser): bool
    {
        // check if iduser exists in admin table
        $sql = "SELECT EXISTS(SELECT 1 FROM admin WHERE iduser = :iduser)";
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array('iduser' => $iduser));
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['exists'];
    }

    public function DeleteTopicById(int $idtopic): void
    {
        $sql = "DELETE FROM messages where idtopic = $idtopic;";
        $this->dbh->query($sql);
        $sql = "DELETE FROM topic where idtopic = $idtopic;";
        $this->dbh->query($sql);
    }

    public function DeleteMessageById(int $idmessage): void
    {
        $sql = "DELETE FROM messages where idmessage = $idmessage;";
        $this->dbh->query($sql);
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

    public function getQCMById(int $id): bool|object
    {
        $sth = $this->dbh->prepare("SELECT path FROM qcm WHERE id = :id");
        $sth->execute(array('id' => $id));
        $result = $sth->fetch(PDO::FETCH_OBJ);
        if (!$result) return false;
        $result->path = 'xml/qcm/' . $result->path;
        return $result;
    }

    public function addQCMResult($idqcm, $iduser, $note): void
    {
        //check if the user already did the qcm
        $sth = $this->dbh->prepare("SELECT EXISTS(SELECT 1 FROM qcmresults WHERE idqcm = :idqcm AND iduser = :iduser)");
        $sth->execute(array('idqcm' => $idqcm, 'iduser' => $iduser));
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if ($result['exists']) {
            $sth = $this->dbh->prepare("UPDATE qcmresults SET note = :note, date = now()::timestamp WHERE idqcm = :idqcm AND iduser = :iduser");
            $sth->execute(array('idqcm' => $idqcm, 'iduser' => $iduser, 'note' => $note));
        } else {
            $sth = $this->dbh->prepare("INSERT INTO qcmresults (idqcm, iduser, note, date) VALUES (:idqcm, :iduser, :note, now()::timestamp)");
            $sth->execute(array('idqcm' => $idqcm, 'iduser' => $iduser, 'note' => $note));
        }
    }

    /**
     * @return void + affiche le nombre de personne en tout dans le site
     */
    public function getMaxNoteForUser(int $iduser): mixed
    {
        $nb_element = $this->dbh->query("SELECT MAX(note) FROM qcmresults WHERE iduser = $iduser;")->fetchColumn();
        if (is_null($nb_element)) return "Aucun QCM réalisé";
        return $nb_element;
    }

    /**
     * @return void + Donne la derniere note obtenue par l'utilisateur
     */
    public function getLastNoteForUser(int $iduser): mixed
    {
        $nb_element = $this->dbh->query("SELECT note FROM qcmresults WHERE date in (SELECT max(date) from qcmresults where iduser = $iduser) and iduser = $iduser;")->fetchColumn();
        //SELECT note, MAX(date) as latestQCM FROM qcmresults WHERE iduser = $iduser GROUP BY note;
        if (is_null($nb_element)) return "Aucun QCM réalisé";
        return $nb_element;
    }

    /**
     * @return void + affiche le nombre de cours sur le site
     */
    public function getNbCours(): int
    {
        $nb_element = $this->dbh->query("SELECT COUNT(id) FROM cours;")->fetchColumn();
        if ($nb_element == 0) return 0;
        return $nb_element;
    }


    /**
     * @return void + affiche le nombre de Qcm fait par l'utilisateur
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
        return ($this->dbh->query("SELECT COUNT(id) FROM login;")->fetchColumn()) - 1;
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
        $sth = $this->dbh->prepare("SELECT topic.idtopic,topic.idauteur,userinfo.pseudo, nom_topic, max(messages.date) as lastMessage FROM topic, messages, userinfo WHERE topic.idtopic = messages.idtopic AND topic.idauteur = userinfo.iduser GROUP BY topic.idtopic, userinfo.pseudo, nom_topic ORDER BY max(messages.date) DESC");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTopicById(int $idtopic): array
    {
        $sth = $this->dbh->prepare("SELECT topic.idtopic, topic.idauteur, topic.nom_topic, topic.date_creation FROM topic WHERE topic.idtopic = :idtopic");
        $sth->bindParam(":idtopic", $idtopic);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTopicMessages(int $idtopic): array
    {
        $sth = $this->dbh->prepare("SELECT userinfo.pseudo, userinfo.image_profil, messages.content,messages.idauteur, messages.idmessage ,messages.date FROM userinfo, messages WHERE userinfo.iduser = messages.idauteur AND messages.idtopic = :idtopic ORDER BY messages.date ASC");
        $sth->bindParam(":idtopic", $idtopic);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMessageById(int $idtopic, int $idmessage): array
    {
        $sth = $this->dbh->prepare("SELECT messages.idauteur, messages.idmessage, messages.idtopic, messages.content, messages.date FROM messages WHERE messages.idtopic = :idtopic AND messages.idmessage = :idmessage");
        $sth->bindParam(":idtopic", $idtopic);
        $sth->bindParam(":idmessage", $idmessage);
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

    /**
     * @details Récupère le login d'un utilisateur
     * @param int $iduser
     * @return array
     */
    public function getLoginFromId(int $iduser): array|bool
    {
        $sql = "SELECT login, password, salt FROM login WHERE id = :iduser";
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array('iduser' => $iduser));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @details Met à jour l'image de profil d'un utilisateur
     * @param int $iduser
     * @param string $image
     * @return bool
     */
    public function updateUserImage(int $iduser, string $image): bool
    {
        $sth = $this->dbh->prepare("UPDATE userinfo SET image_profil = :image WHERE iduser = :iduser");
        $sth->bindParam(":image", $image);
        $sth->bindParam(":iduser", $iduser);
        return $sth->execute();
    }

    /**
     * @details Récupère une liste d'utilisateur en fonction de leur pseudo
     * @param string $pseudo
     * @return bool|array
     */
    public function getUsersByPseudo(string $pseudo): bool|array
    {
        $sql = "SELECT * FROM userinfo WHERE LOWER(pseudo) ~ :pseudo";
        $res = $this->dbh->prepare($sql);
        $res->execute(array('pseudo' => strtolower($pseudo)));
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @details Ajoute un QCM dans la base de données
     * @param string $path
     * @return bool
     */
    public function addQCM(string $path): bool
    {
        $sql = "INSERT INTO qcm (path) VALUES (:path)";
        $sth = $this->dbh->prepare($sql);
        return $sth->execute(array('path' => $path));
    }

    public function deleteQCM(int $id): bool
    {
        $sql = "DELETE FROM qcm WHERE id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array('id' => $id));
        return $sth->rowCount() > 0;
    }

    /**
     * @details Supprime un user de la base de données
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        $sql = "DELETE FROM login WHERE id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array('id' => $id));
        return $sth->rowCount() > 0;
    }

    /**
     * @details Récupère tous les qcm
     * @return array|bool
     */
    public function getAllQcm()
    {
        $sql = "SELECT * FROM qcm";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @details ajoute un cours dans la base de données
     * @param string $path
     * @return bool
     */
    public function addCourse(string $path): bool
    {
        $sql = "INSERT INTO cours (path) VALUES (:path)";
        $sth = $this->dbh->prepare($sql);
        return $sth->execute(array('path' => $path));
    }

    /**
     * @details Récupère le cours
     * @param int $id
     * @return bool|object
     */
    public function getCourseById(int $id): bool|object
    {
        $sql = "SELECT path FROM cours where id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array('id' => $id));
        $cours = $sth->fetch(PDO::FETCH_OBJ);
        if (!$cours)
            return false;
        $cours->path = 'cours' . DIRECTORY_SEPARATOR . $cours->path;
        return $cours;
    }

    public function getAllCourses()
    {
        $sql = "SELECT * FROM cours";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @details Supprime un cours de la base de données
     * @param int $id
     * @return bool
     */
    public function deleteCourse(int $id): bool
    {
        // returne false si le cours n'existe pas
        $sql = "DELETE FROM cours WHERE id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array('id' => $id));
        return $sth->rowCount() > 0;
    }
}