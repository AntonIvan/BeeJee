<?php
class Controller {

    public $model;
    public $view;
    public $query;

    function __construct()
    {

        $this->view = new View();

    }

    function action_index()
    {

    }

    function checkCookie() {
        $db = new DB();
        if(array_key_exists('admin', $_COOKIE)) {
            return $db->checkCookie($_COOKIE['admin']);
        } else {
            return "Error";
        }
    }

    function setQuery($query) {
        $this->query = $query;
    }

}