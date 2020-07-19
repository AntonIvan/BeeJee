<?php

include "App/Api/Api.php";

class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        $parts = parse_url($_SERVER['REQUEST_URI']);

        $routes = explode('/', $parts['path']);

        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        if(array_key_exists('query', $parts)) {
            parse_str($parts['query'], $query);
        } else {
            $query = "";
        }

        if($routes[1] == "api" && $_SERVER['SERVER_NAME'] == $_SERVER['HTTP_HOST'] && $_POST) {
            return new Api($action_name, $_REQUEST);
        }



        // добавляем префиксы
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = strtolower($model_name).'.php';
        $model_path = "App/Model/".$model_file;
        if(file_exists($model_path))
        {
            include "App/Model/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "App/Controller/".$controller_file;
        if(file_exists($controller_path))
        {
            include "App/Controller/".$controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            return self::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name;
        if($query) {
            $controller->setQuery($query);
        }

        $action = $action_name;

        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            return self::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}