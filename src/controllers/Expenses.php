<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\ExpensesModel;

class Expenses extends Controller {
  protected object $expense;

  public function __construct($param) {
    $this->expense = new ExpensesModel();
    parent::__construct($param);
  }

  public function postExpense() {
    $this->expense->add($this->body);
    return $this->expense->getLast();
  }

  public function deleteExpense() {
    return $this->expense->delete(intval($this->params['id']));
  }

  public function getExpense() {
    return $this->expense->get(intval($this->params['id']));
  }

  public function getAllExpenses() {
    return $this->expense->getAll();
  }
}
