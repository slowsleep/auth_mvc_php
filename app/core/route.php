<?php

class Route
{
	public static function start()
	{
		$controller_name = 'main';
		$action_name = 'index';
		$routes = isset($_GET['page']) ? $_GET['page'] : '';

		if (!empty($routes)) {
            $controller_name = $routes;

            if (isset($_GET['action'])) {
                $action_name = $_GET['action'];
            }
		}

		$controller_name = $controller_name . '_controller';
		$controller_file = strtolower($controller_name) . '.php';
		$controller_path = "app/controllers/" . $controller_file;

		if (file_exists($controller_path)) {
			include "app/controllers/" . $controller_file;
		} else {
			self::ErrorPage404();
			return;
		}

		$controller = new $controller_name;
		$action = $action_name;

		if (method_exists($controller, $action)) {
            $controller->$action();
		} else {
			self::ErrorPage404();
			return;
		}
	}
	public static function ErrorPage404()
	{
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 Not Found');

		$view = new View();
		$view->generate('404_view.php', 'layout/layout_view.php', 'Страница не найдена');

		exit();
	}
}
