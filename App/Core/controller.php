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
        return $db->checkCookie($_COOKIE['admin']);
    }

    function setQuery($query) {
        $this->query = $query;
    }

}