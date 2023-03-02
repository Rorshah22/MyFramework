<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;

class MainController extends AbstractController
{
    public function main()
    {
        $articles  = Article::findLastRecords(3 , 'DESC');
        $this->view->renderHtml('main/main.php',
            [
                'articles' => $articles,
                'pagesCount' => Article::getPageCount(5)
            ]);
    }

}
