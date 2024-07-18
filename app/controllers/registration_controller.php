<?php

class Registration_Controller extends Controller
{
    public function index()
    {
        $this->view->generate('registration_view.php', 'layout/layout_view.php', 'Регистрация');
    }
}
