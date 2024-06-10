<?php

namespace App\Models;

use PDO;
use stdClass;

class TaskModel extends SqlConnect {
    public function add(array $data) {
      error_log(print_r($data, TRUE));
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
    }

    public function delete(int $id) {
        $req = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        $req->execute(["id" => $id]);
    }
    public function get(int $id) {
        $req = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $req->execute(["id" => $id]);

        return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getLast() {
        $req = $this->db->prepare("SELECT * FROM tasks ORDER BY id DESC LIMIT 1");
        $req->execute();

        return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getAll() {
        $req = $this->db->prepare("SELECT * FROM tasks");
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
