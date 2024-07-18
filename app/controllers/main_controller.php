<?php

class Main_Controller extends Controller
{
    public function index()
    {
        $this->view->generate('main_view.php', 'layout/layout_view.php', 'Главная');
    }
}
