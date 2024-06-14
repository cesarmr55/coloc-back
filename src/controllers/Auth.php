<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UserModel;
use Exception;

class Auth extends Controller {
    protected object $user;

    public function __construct($param) {
        $this->user = new UserModel();
        parent::__construct($param);
    }

    public function postlogin() {
        try {
          error_log('Received POST data: ' . file_get_contents('php://input'));
            // Log received data
            error_log("Received data: " . json_encode($this->body));

            if (empty($this->body['email']) || empty($this->body['password'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Email and password are required']);
                return;
            }

            $email = filter_var($this->body['email'], FILTER_SANITIZE_EMAIL);
            $password = $this->body['password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid email format']);
                return;
            }

            $user = $this->user->getByEmail($email);

            // Log user data retrieved
            error_log("User data: " . json_encode($user));

            if ($user) {
                if (password_verify($password, $user['password_hash'])) {
                    http_response_code(200);
                    $userData = ['email' => $user['email']];
                    echo json_encode(['success' => true, 'message' => 'Login successful', 'data' => $userData]);
                } else {
                    http_response_code(401);
                    echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
                }
            } else {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
            }
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
