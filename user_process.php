<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);


$type = filter_input(INPUT_POST, "type");


if ($type === "update") {


  $userData = $userDao->verifyToken();


  $nome = filter_input(INPUT_POST, "nome");
  $sobrenome = filter_input(INPUT_POST, "sobrenome");
  $email = filter_input(INPUT_POST, "email");
  $bio = filter_input(INPUT_POST, "bio");


  $user = new User();

  $userData->nome = $nome;
  $userData->sobrenome = $sobrenome;
  $userData->email = $email;
  $userData->bio = $bio;
  

  $userDao->update($userData);
} else if ($type === "changepassword") {

  $password = filter_input(INPUT_POST, "password");
  $confirmpassword = filter_input(INPUT_POST, "confirmpassword");


  $userData = $userDao->verifyToken();

  $id = $userData->id;

  if ($password == $confirmpassword) {

    $user = new User();

    $finalPassword = $user->generatePassword($password);

    $user->password = $finalPassword;
    $user->id = $id;

    $userDao->changePassword($user);
  } else {
    $message->setMessage("As senhas não são iguais!", "error", "back");
  }
} else {

  $message->setMessage("Informações inválidas!", "error", "index.php");
}
