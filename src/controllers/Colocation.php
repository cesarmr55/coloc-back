<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\ColocationModel;

class Colocation extends Controller {
  protected object $user;

  public function __construct($param) {
    $this->user = new ColocationModel();

    parent::__construct($param);
  }

  public function postColocation() {
    $this->user->add($this->body);

    return $this->user->getLast();
  }

  public function deleteColocation() {
    return $this->user->delete(intval($this->params['id']));
  }

  public function getColocation() {
    return $this->user->get(intval($this->params['id']));
  }
}
