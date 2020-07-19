<?php
class Controller_Admin extends Controller
{
    function action_index()
    {
        $this->view->generate('admin.php', 'template.php');
    }
}