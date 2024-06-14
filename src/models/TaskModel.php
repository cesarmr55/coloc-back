<?php

namespace App\Models;

use PDO;
use stdClass;
use Exception;

class TaskModel extends SqlConnect {
    public function add(array $data) {
        try {
            $query = "
                INSERT INTO tasks (title, description, due_date, assigned_to)
                VALUES (:title, :description, :due_date, :assigned_to)
            ";

            $req = $this->db->prepare($query);
            $req->execute([
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':due_date' => $data['due_date'],
                ':assigned_to' => $data['assigned_to']
            ]);
        } catch (PDOException $e) {
            error_log("Database error in add method: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function delete(int $id) {
        try {
            $req = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
            $req->execute(["id" => $id]);
        } catch (PDOException $e) {
            error_log("Database error in delete method: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function get(int $id) {
        try {
            $req = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
            $req->execute(["id" => $id]);

            return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
        } catch (PDOException $e) {
            error_log("Database error in get method: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getLast() {
        try {
            $req = $this->db->prepare("SELECT * FROM tasks ORDER BY id DESC LIMIT 1");
            $req->execute();

            return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
        } catch (PDOException $e) {
            error_log("Database error in getLast method: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getAll() {
      try {
          $query = "SELECT * FROM tasks";
          $stmt = $this->db->prepare($query);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
          throw new Exception("Database error: " . $e->getMessage());
      }
  }
  
}

