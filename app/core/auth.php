<?php

class Auth
{
    public static function checkUserAuth() {
        if (isset($_COOKIE["remember_me"])) {
            $user = User_Model::getUserByHash($_COOKIE["hash"]);
            if ($user) {
                $_SESSION["is_auth"] = true;
                $_SESSION["user"] = $user;
                return true;
            }
        } else if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"]) {
            return true;
        }
        return false;
    }
}
