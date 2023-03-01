<?php

namespace Controllers;

use MVC\Router;

class CitaController {

    public static function index(Router $router) {
        session_start();

        $nombre = $_SESSION['nombre'];

        $router->render("citas/index", [
            'nombre' => $nombre
        ]);
    }
}