<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UserModel;

class User extends Controller {
  protected object $user;

  public function __construct($param) {
    $this->user = new UserModel();
    parent::__construct($param);
  }

  public function postUser() {
    $this->user->add($this->body);
    return $this->user->getLast();
  }

  public function deleteUser() {
    return $this->user->delete(intval($this->params['id']));
  }

  public function getUser() {
    return $this->user->get(intval($this->params['id']));
  }

  public function registerUser() {
    $username = $this->body['username'];
    $email = $this->body['email'];
    $password = $this->body['password'];
    $confirmPassword = $this->body['confirmPassword'];

    if ($password !== $confirmPassword) {
      header('HTTP/1.1 400 Bad Request');
      echo json_encode(['error' => 'Passwords do not match']);
      exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $userData = [
      'username' => $username,
      'email' => $email,
      'password' => $hashedPassword
    ];

    $this->user->add($userData);

    header('HTTP/1.1 201 Created');
    echo json_encode($this->user->getLast());
  }
}
