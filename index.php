<?php

require 'vendor/autoload.php';

use App\Controllers\Colocation;
use App\Controllers\Expenses;
use App\Router;
use App\Controllers\User;
use App\Controllers\Task;


new Router([
  'user/:id' => User::class,
  'colocation/:id' => Colocation::class,
  'task/' => Task::class,
  'expenses/' => Expenses::class,
  'register/' => ['POST' => [User::class, 'registerUser']]
]);
