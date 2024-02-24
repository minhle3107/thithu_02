<?php

use App\Controllers\BookController;
use App\Router;

require_once __DIR__ . "/env.php";
require_once __DIR__ . "/config.php";

require_once __DIR__ . "/vendor/autoload.php";

$router = new Router();
Router::get("/", [BookController::class, "index"]);
Router::get("/create", [BookController::class, "create"]);
Router::post("/create", [BookController::class, "store"]);
Router::get("/edit", [BookController::class, "edit"]);
Router::post("/edit", [BookController::class, "update"]);
Router::get("/delete", [BookController::class, "delete"]);

$router->resolve();
