<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {

    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar() {

        //Almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();  
        
        $id = $resultado['id'];
        
        //Almacena los servcios con el ID de la cita
        $idServicios = explode(',', $_POST['servicios']);

        foreach($idServicios as $idServicio) {
            $args = [
                'citasId' => $id,
                'serviciosId' => $idServicio
            ];

            $citaServcio = new CitaServicio($args);
            $citaServcio->guardar();
        }

        echo json_encode([
            'resultado' => $resultado
        ]);

    }
}
