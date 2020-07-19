<?php

class DB {

    public $pdo;

    public function __construct()
    {
        $host="remotemysql.com";
        $dbname="egZBgfuJNP";
        try {
            $this->pdo = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, 'egZBgfuJNP', 'zrZ8grg2IZ');    // Устанавливаем соединение с БД
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            printme(' подключиться к MySQL не получилось', 1);
            printme(' проверьте настройки в коде скрипта (поля класса DBO этого скрипта), а также убедитесь что PHP PDO включено | текст ошибки:');
            printme("Error: ".$e->getMessage());
            //  exit();
        }
        $this->pdo->exec("SET CHARSET utf8"); // Устанавливаем кодировку
    }

    public function checkAdmin($user, $password) {
        $result = $this->pdo->query("SELECT * FROM admin WHERE name ='".$user."'");
        $q = $result->fetchAll();
        if(empty($q) || $q[0]['password'] != $password) {
            return 'Error';
        }
        $indentifier = base64_encode(rand(0, 100).rand(0, 100).rand(0, 100).rand(0, 100).rand(0, 100)."1234");
        $this->pdo->query("UPDATE admin SET indentifier = '".$indentifier."', status = '1' WHERE name ='".$user."'");
        setcookie("admin", $indentifier, time()+3600, "/");
        return "Success";

    }

    public function checkCookie($query) {
        if($query) {
            $result = $this->pdo->query("SELECT * FROM admin WHERE indentifier ='" . $query . "'");
            $q = $result->fetchAll();
        }
        if(empty($q)) {
            return 'Error';
        } else {
            return 'Success';
        }
    }

    public function exitAdmin() {
        $this->pdo->query("UPDATE admin SET indentifier = '', status = '0' WHERE id ='1'");
        setcookie('admin', null, -1, '/');
    }

    public function createTask($query) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO tasks (name, email, text, status) VALUES (:name, :email, :text, :status)");
            $stmt->bindValue(':name', $query['name']);
            $stmt->bindValue(':email', $query['email']);
            $stmt->bindValue(':text', $query['text']);
            $stmt->bindValue(':status', "no");
            $stmt->execute();
        } catch (Exception $e) {

        }
        return "Success";

    }

    public function allTasks($query) {
        if(!$query || $query['page'] == 1) {
            $start = 0;
        } else {
            $start = 3 * $query['page'] - 3;
        }
        if($query['orderby'] == "asc") {
            $orderby = "ASC";
        } else {
            $orderby = "DESC";
        }
        if($query['sort']) {
            $sort = $query['sort'];
        } else {
            $sort = "id";
        }
        $result = $this->pdo->query("SELECT * FROM tasks ORDER BY ".$sort." ".$orderby." LIMIT ".$start.",3");
        return $result->fetchAll();
    }

    public function pages() {
        $result = $this->pdo->query("SELECT COUNT(*) FROM tasks");
        $q =  $result->fetchAll();
        return round($q[0][0]/3);
    }

    public function task($id) {
        $result = $this->pdo->query("SELECT * FROM tasks WHERE id = '".$id."'");
        return $result->fetchAll();
    }

    public function editTask($query) {
        $check = $this->checkCookie(urldecode($query['cookie']));
        if($check == "Success") {
            $this->pdo->query("UPDATE tasks SET text = '".$query['text']."', editedAdmin = '1' WHERE id ='".$query['id']."'");
            echo "Success";
        } else {
            echo "Error";
        }
    }

}
?>