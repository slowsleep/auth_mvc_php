<?php

class Login_Controller extends Controller
{
    public function index()
    {
        $this->view->generate('login_view.php', 'layout/layout_view.php', 'Вход');
    }
}
