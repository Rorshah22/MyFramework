<?php

namespace MyProject\Controllers;

use MyProject\Services\Parser;

class ParserController extends AbstractController
{
    public function parse(){
        echo '<h1>Parse</h1>';
        $result = new Parser('onliner.by');

        echo '<br><br><br><br><br><br><br><br><br><h2>11212121</h2>h1>';
//        var_dump($result);
    }
}