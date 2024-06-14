<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UserModel;

class Register extends Controller {
    protected object $user;

    public function __construct($param) {
        $this->user = new UserModel();
        parent::__construct($param);
    }

    public function postRegister() {
        $hashedPassword = password_hash($this->body['password_hash'], PASSWORD_BCRYPT);

        $data = [
            'username' => $this->body['username'],
            'email' => $this->body['email'],
            'password_hash' => $hashedPassword
        ];

        $this->user->add($data);

        return $this->user->getLast();
    }
}
