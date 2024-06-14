<?php

namespace App\Models;

use \PDO;
use stdClass;
use PDOException;
use Exception;

class UserModel extends SqlConnect {
    public function add(array $data) {
        try {
            $query = "
                INSERT INTO users (username, email, password_hash)
                VALUES (:username, :email, :password_hash)
            ";

            $req = $this->db->prepare($query);
            $req->execute($data);
            echo "User added successfully";
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function delete(int $id) {
        try {
            $req = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $req->execute(["id" => $id]);
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function get(int $id) {
        try {
            $req = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $req->execute(["id" => $id]);

            return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getLast() {
        try {
            $req = $this->db->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
            $req->execute();

            return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getByEmail(string $email) {
      try {
          $req = $this->db->prepare("SELECT email, password_hash FROM users WHERE email = :email");
          $req->execute(["email" => $email]);

          return $req->fetch(PDO::FETCH_ASSOC) ?: false;
      } catch (PDOException $e) {
          throw new Exception("Database error: " . $e->getMessage());
      }
  }
}
