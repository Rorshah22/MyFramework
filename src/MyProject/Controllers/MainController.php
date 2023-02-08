<?php

namespace MyProject\Controllers;

class MainController
{
//    private $view;

    public function __construct()
    {

    }

    public function main()
    {
        echo 'General page';
    }

    public function sayHello(string $name)
    {
        echo 'Hello '.$name;
    }

}
