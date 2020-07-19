<?php

require_once "App/DB.php";

class Api {

    private $db;

    public function __construct($action, $query)
    {
        $this->db = new DB();
        $this->$action($query);
    }

    public function sign($query) {
        echo $this->db->checkAdmin($query['user'], $query['password']);
    }

    public function exitAdmin($query) {
        $this->db->exitAdmin();
    }

    public function createTask($query) {
        echo $this->db->createTask($query);
    }

    public function editTask($query) {
        echo $this->db->editTask($query);
    }
}