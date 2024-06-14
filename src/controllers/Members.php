<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\MembersModel;

class Members extends Controller {
  protected object $member;

  public function __construct($param) {
    $this->member = new MembersModel();
    parent::__construct($param);
  }

  public function postMember() {
    $this->member->add($this->body);
    return $this->member->getLast();
  }

  public function deleteMember() {
    return $this->member->delete(intval($this->params['id']));
  }

  public function getMember() {
    return $this->member->get(intval($this->params['id']));
  }

  public function getAllMembers() {
    return $this->member->getAll();
  }
}
