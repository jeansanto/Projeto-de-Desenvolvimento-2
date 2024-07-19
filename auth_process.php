<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

if($type === "registro") {

    $nome = filter_input(INPUT_POST, "nome");
    $sobrenome = filter_input(INPUT_POST, "sobrenome");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    if($nome && $sobrenome && $email && $password) {

        if($password === $confirmpassword) {

            if($userDao->findByEmail($email) === false) {

                $user = new User();

                $userToken = $user->generateToken();
                $finalPassword = $user->generatePassword($password);

                $user->nome = $nome;
                $user->sobrenome = $sobrenome;
                $user->email = $email;
                $user->password = $finalPassword;
                $user->token = $userToken;

                $auth = true;

                $userDao->create($user, $auth);

            } else {
                $message->setMessage("O usuário já existe, tente outro E-mail.", "error", "back");
            }

        } else {
            $message->setMessage("As Senhas não são iguais.", "error", "back");
        }

    } else {
        $message->setMessage("Por Favor, Preencha todos os campos.", "error", "back");
    }

} else if($type === "login") {

    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    if($userDao->authenticateUser($email, $password)) {

      $message->setMessage("Seja bem-vindo!", "success", "editprofile.php");

    } else {

      $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");

    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }