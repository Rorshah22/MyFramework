<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ActivateException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
use MyProject\View\View;

class UserController
{
    /**@var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);

            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                $this->view->renderHtml('users/signUpSuccessful.php');
                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php');

    }

    public function activate(int $userId, string $activationCode)
    {

        try{
            $user = User::getByID($userId);
            if ($user === null) {
                throw new InvalidArgumentException('Нет такого пользователя');
            }
            if ($user->isConfirmed()) {
                throw new ActivateException('Пользователь активирован');
            }
            $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);

            if ($isCodeValid) {
                $user->activate();
                $this->view->renderHtml('');
            }
            if(!$isCodeValid){
                throw new InvalidArgumentException('Неверный код');
            }


        }catch (InvalidArgumentException $e){
            $this->view->renderHtml('users/signUp.php',['error'=>$e->getMessage()]);
        }catch (ActivateException $e){
            $this->view->renderHtml('users/signUp.php',['error'=>$e->getMessage()]);
        }
    }
}
