<?php
class Controller_Main extends Controller
{
    function action_index()
    {

        $db = new DB();
        if(is_null($this->query) || !array_key_exists('page', $this->query) || is_null($this->query['page'])) {
            $this->query['page'] = 1;
        }
        if(!array_key_exists('sort', $this->query)) {
            $this->query['sort'] = "";
        }
        if(!array_key_exists('orderby', $this->query)) {
            $this->query['orderby'] = "";
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