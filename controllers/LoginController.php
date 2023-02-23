<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {
        
        $router->render('auth/login');
    }

    public static function logout() {
        echo "DESDE LOGOUT";
    }

    public static function olvide(Router $router) {
        $router->render("auth/olvide-password");
    }

    public static function recuperar() {
        echo "DESDE RECUPERAR";
    }

    public static function crear(Router $router) {
        
        $usuario = new Usuario;

        //Alertas Vacías
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisamos si las alertas está vacío
            if (empty($alertas)) {
                // Verificar que el usuario no esté registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    //hashear password
                    $usuario->hashPassword();

                    // Generar un Token único
                    $usuario->crearToken();

                    //Enviar Email
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarConfirmacion();

                    //Crear el usuario registrarlo en la bd
                    $resultado = $usuario->guardar();

                    // debuguear($usuario);

                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }

                // return $resultado;
            }
        }


        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }


    public static function mensaje (Router $router) {
        $router->render("auth/mensaje");
    }

    public static function confirmar (Router $router) {
        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);
        
        if(empty($usuario)) {
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token No Válido');
        } else {
            // Modificar a usuario confirmado
            $usuario->confirmado = 1;
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito','Cuenta Comprobada Correctamente');
        }

        //Obtener alertas
        $alertas = Usuario::getAlertas();

        //Renderizar la vista 
        $router->render("auth/confirmar-cuenta",[
            'alertas' => $alertas
        ]);
    }
}