<?php
class Controller_Form extends Controller
{
    function action_index()
    {

        $db = new DB();
        $this->view->generate(
            'form.php',
            'template.php',
            [
                "task" => $db->task($this->query['id']),
                "admin" => $this->checkCookie(),
            ]);
    }
}