<?php
class Controller_Main extends Controller
{
    function action_index()
    {
        $db = new DB();
        if(is_null($this->query['page'])) {
            $this->query['page'] = 1;
        }
        $this->view->generate('main.php',
            'template.php',
            [
                "admin" => $this->checkCookie(),
                "tasks" => $db->allTasks($this->query),
                "pages" => $db->pages(),
                "currentPage" => $this->query['page'],
                "sort" => $this->query['sort'],
                "orderby" => $this->query['orderby'],
            ]);
    }
}