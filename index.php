<?php

require 'vendor/autoload.php';

use App\Controllers\Colocation;
use App\Controllers\Expenses;
use App\Controllers\Members;
use App\Router;
use App\Controllers\User;
use App\Controllers\Task;
use App\Controllers\Register;
use App\Controllers\Auth;

new Router([
  'user/:id' => User::class,
  'colocation/:id' => Colocation::class,
  'task/' => Task::class,
  'task/id' => Task::class,
  'expenses/' => Expenses::class,
  'members/' => Members::class,
  'register/' => Register::class,
  'login/' => Auth::class
]);
