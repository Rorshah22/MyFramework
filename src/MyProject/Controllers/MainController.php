<?php

namespace MyProject\Controllers;

use MyProject\Services\Db;
use MyProject\View\View;

class MainController
{
    private $view;
    private $db;


    public function __construct()
    {
        $this->view = new View(__DIR__.'/../../../templates');
        $this->db = new Db();
    }

    public function main()
    {
        $articles  = $this->db->query('SELECT * FROM `articles`');
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
            var_dump($articles);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello.php', ['name' => $name]);
    }

}
