<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\TaskModel;
use Exception;

class Task extends Controller {
    protected object $task;

    public function __construct($param) {
        $this->task = new TaskModel();

        parent::__construct($param);
    }

    public function postTask() {
        $this->task->add($this->body);

        return $this->task->getLast();
    }

    public function deleteTask() {
        return $this->task->delete(intval($this->params['id']));
    }

     public function getTask() {
         if (isset($this->params['id'])) {
             return $this->task->get(intval($this->params['id']));
         } else {
             throw new Exception("ID parameter is missing");
         }
     }

    public function getAllTasks() {
      try {
          $tasks = $this->task->getAll();
          var_dump($tasks); // Vérifiez si cela affiche des données
          echo json_encode($tasks);
      } catch (Exception $e) {
          http_response_code(500);
          echo json_encode(array("message" => $e->getMessage()));
      }
  }
    
}
// public function getTask() {
//   try {
//       if (isset($this->params['id'])) {
//           $taskId = intval($this->params['id']);
//           $task = $this->task->get($taskId);
//           echo json_encode($task);
//       } else {
//           $tasks = $this->task->getAll();
//           echo json_encode($tasks);
//       }
//   } catch (Exception $e) {
//       http_response_code(400); 
//       echo json_encode(array("message" => $e->getMessage()));
//   }
// }