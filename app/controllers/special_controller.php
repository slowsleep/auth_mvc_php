<?php

class Special_Controller extends Controller
{
    public function index()
    {
        $this->view->generate('special_view.php', 'layout/layout_view.php', 'Специальная страница');
    }
}
