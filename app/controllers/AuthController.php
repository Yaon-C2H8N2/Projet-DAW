<?php

class AuthController
{
    /**
     * AuthController constructor.
     * @param $login
     * User mail address used as login
     * @param $password
     * User hashed and salted password
     */
    public function login($login, $password): void
    {
        $dbc = new DBController();
        if ($dbc->comparePassword($login, $password)) {
            echo "Authentification réussie";
        } else {
            echo "Authentification échouée";
        }
    }
}

?>