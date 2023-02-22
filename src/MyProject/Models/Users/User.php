<?php

namespace MyProject\Models\Users;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @return mixed
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    public static function signUp(array $userData): User
    {
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передан nickname');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname'])) {
            throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
        }
        if (static::findOneByColumn('nickname', $userData['nickname'])) {
            throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
        }
        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }

        if (static::findOneByColumn('email', $userData['email'])) {
            throw new InvalidArgumentException('Пользователь с таким email уже существует');
        }
        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }

        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;
    }

    public function activate()
    {
        $this->isConfirmed = true;
        $this->save();
    }

    /**
     * @param array $userData
     * @return User
     * @throws InvalidArgumentException
     * @var User|null $user
     */
    public static function login(array $userData): User
    {
        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не введен email');
        }
        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан пароль');
        }
        $user = User::findOneByColumn('email', $userData['email']);
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким email');
        }
        if (!password_verify($userData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неверный пароль');
        }
        if (!$user->isConfirmed()) {
            throw new InvalidArgumentException('Пользователь не подтвержден');
        }

        $user->refreshAuthToken();
        $user->save();
        return $user;
    }

    public function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    public static function logout(): void
    {
        setcookie('token', '', 0, '/');
    }

    public function isConfirmed()
    {
        return $this->isConfirmed;
    }

    protected static function getTableName(): string
    {
        return 'users';
    }
}
