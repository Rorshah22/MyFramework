<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Models\Users\UsersAuthService;
use MyProject\View\View;

/**
 * @property User|null $user
 * @property View $view
 */
class AbstractController
{
    protected $view;
    protected $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
    }

    public function getInputData()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}