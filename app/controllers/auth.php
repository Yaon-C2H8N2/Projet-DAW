<?php

function logout()
{
    session_destroy();
    header('Location: /', true, 301);
    exit();
}

function getLoginForm()
{
    if (isset($_SESSION['userInfo'])) {
        header('Location: /', true, 301);
        exit();
    } else {
        require '../app/views/userAuth.php';
    }
}

function getRegisterForm()
{
    if (isset($_SESSION['userInfo'])) {
        header('Location: /', true, 301);
        exit();
    } else {
        require '../app/views/userCreate.php';
    }
}

function login()
{
    if (isset($_POST['email']) && isset($_POST['password'])) {
        include_once "../app/models/DBManage.php";

        $dbc = new DBManage();
        $login = $_POST['email'];
        $password = $_POST['password'];

        if (!$dbc->userExists($login)) {
            echo json_encode(array('success' => false, 'message' => 'Erreur : Utilisateur inexistant.'));
            exit();
        } else {


            $password = hash('sha256', $password . $dbc->getSalt($login));

            //Connexion réussie
            if ($dbc->comparePassword($login, $password)) {
                $User = $dbc->loadUser($login);

                $_SESSION['userInfo'] = serialize($User);
                echo json_encode(array('success' => true, 'message' => 'Connexion réussie.'));

                //Log
                $file = fopen("../app/controllers/adminPanel/Log.txt", "a+") or die("Impossible d'ouvrir le fichier !");
                $now = DateTime::createFromFormat('U.u', microtime(true));
                $txt = date('d/m/Y') . " à " . $now->format("H\hi:s.u") . " connexion de \"" . $User->pseudo . "\" ID [" . $User->id . "]\r\n";
                fwrite($file, $txt);
                fclose($file);

                exit();
            } else {
                echo json_encode(array('success' => false, 'message' => 'Utilisateur ou mot de passe incorrect.'));
                exit();
            }
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Erreur : Veuillez remplir tous les champs.'));
        exit();
    }
}

function register()
{
    include_once "../app/models/Utility.php";
    if (isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate']) && isset($_POST['username'])) {

        $dbc = new DBManage();
        $login = $_POST['mail'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $birthdate = $_POST['birthdate'];
        $pseudo = $_POST['username'];

        if ($dbc->userExists($login)) {
            echo 'Erreur : Utilisateur déjà existant.';
        } else if ($dbc->pseudoExists($pseudo)) {
            echo 'Erreur : Pseudo déjà existant.';
        } else {
            $id = $dbc->createUser($login, $password, $firstname, $lastname, $birthdate, $pseudo);
            if (isset($_FILES['img'])) {
                saveImgProfile($_FILES['img'], $id);
            }
            echo 'Succès !';
            header('Location: /', true, 301);
            exit();
        }
    } else {
        header('Location: /index.php?controller=auth&action=getRegisterForm', true, 301);
        exit();
    }
}

function checkValidValue()
{
    include_once '../app/models/DBManage.php';

    $db = new DBManage();

    if (!isset($_SESSION['userInfo'])) {
        if (isset($_REQUEST['pseudo'])) {
            echo($db->pseudoExists($_REQUEST['pseudo']) == 0 ? 'false' : 'true');
            exit();
        }
        if (isset($_REQUEST['email'])) {
            echo($db->userExists($_REQUEST['email']) == 0 ? 'false' : 'true');
            exit();
        }
    }

    if (isset($_SESSION['userInfo'])) {

        if (isset($_REQUEST['pseudo'])) {
            if (unserialize($_SESSION['userInfo'])->pseudo == $_REQUEST['pseudo'])
                exit();
            echo($db->pseudoExists($_REQUEST['pseudo']) == 0 ? 'false' : 'true');
        } else {
            if (isset($_REQUEST['email'])) {
                if ($db->getLoginFromId(unserialize($_SESSION['userInfo'])->id)['login'] == $_REQUEST['email'])
                    exit();
                echo($db->userExists($_REQUEST['email']) == 0 ? 'false' : 'true');
            } else {
                echo 'false';
                exit();
            }
        }
    }
}