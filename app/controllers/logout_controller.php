<?php

class Logout_Controller extends Controller
{
    public function index()
    {
        setcookie("hash", "", time() - 3600 * 24 * 30);
        setcookie("remember_me", "", time() - 3600 * 24 * 30);
        session_destroy();
        header("Location: /");
    }
}
