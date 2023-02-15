<?php

namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\Db;

class ArticlesController
{
    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__.'/../../../templates');
        $this->db = Db::getInstance();
    }
    public function view(int $articleId):void
    {
        $result = $this->db->query('SELECT * FROM `articles` INNER JOIN `users` ON `articles`.author_id=`users`.id WHERE `articles`.id=:id; ',
            [':id'=>$articleId]
        );
        if ($result === []) {
            $this->view->renderHtml('errors/404.php',[], 404);
            return;
        }
        $this->view->renderHtml('articles/view.php', ['article' => $result[0]]);
    }
}
