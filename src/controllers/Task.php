<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\TaskModel;

class Task extends Controller {
  protected object $task;

  public function __construct($param) {
    $this->task = new TaskModel();
    parent::__construct($param);
  }

  public function postTask() {
    error_log("Test pour ajouter une tache \n");
    $this->task->add($this->body);
    return $this->task->getLast();
  }

  public function deleteTask() {
    return $this->task->delete(intval($this->params['id']));
  }

  public function getTask() {
    return $this->task->get(intval($this->params['id']));
  }

  public function getAllTasks() {
    return $this->task->getAll();
  }
}
