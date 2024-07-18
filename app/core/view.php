<?php

class View
{
    /**
     * Генерация представления
     * @param string $content_view имя файла с контентом представления относительно папки /application/views
     * @param string $layout_view имя файла шаблона представления (в который будет вставлен контент) относительно папки /application/views
     * @param string $title заголовок страницы
     * @param array $data данные
     */
    public function generate($content_view, $layout_view, $title = 'MVC-фреймворк', $data = null)
    {
        include 'app/views/' . $layout_view;
    }
}
