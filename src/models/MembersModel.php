<?php

namespace App\Models;

use PDO;
use stdClass;

class MembersModel extends SqlConnect {
    public function add(array $data) {
        $query = "
            INSERT INTO members (name, email, role)
            VALUES (:name, :email, :role)
        ";

        $req = $this->db->prepare($query);
        $req->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':role' => $data['role']
        ]);
    }

    public function delete(int $id) {
        $req = $this->db->prepare("DELETE FROM members WHERE id = :id");
        $req->execute(["id" => $id]);
    }

    public function get(int $id) {
        $req = $this->db->prepare("SELECT * FROM members WHERE id = :id");
        $req->execute(["id" => $id]);

        return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getLast() {
        $req = $this->db->prepare("SELECT * FROM members ORDER BY id DESC LIMIT 1");
        $req->execute();

        return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getAll() {
        $req = $this->db->prepare("SELECT * FROM members");
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
