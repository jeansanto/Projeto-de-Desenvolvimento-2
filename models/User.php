<?php

class User
{

    public $id;
    public $nome;
    public $sobrenome;
    public $email;
    public $password;
    public $token;
    public $bio;

    public function getFullNome($user)
    {
        return $user->nome . " " . $user->sobrenome;
    }

    public function generateToken()
    {
        return bin2hex(random_bytes(50));
    }

    public function generatePassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

}

interface UserDAOInterface
{

    public function buildUser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $password);
    public function findByEmail($email);
    public function findById($id);
    public function findByToken($token);
    public function destroyToken();
    public function changePassword(User $user);
}
