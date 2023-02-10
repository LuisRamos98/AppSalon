<?php

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        
        $router->render('auth/login');
    }

    public static function logout() {
        echo "DESDE LOGOUT";
    }

    public static function olvide() {
        echo "DESDE OLVIDE";
    }

    public static function recuperar() {
        echo "DESDE RECUPERAR";
    }

    public static function crear() {
        echo "DESDE CREAR";
    }
}