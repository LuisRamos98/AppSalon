<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Funcion que revisa si el usuario está autenticado
function isAuth() :void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

// Funcion que revisa si el usuario está autenticado
function isAdmin() :void {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}

//ES EL ULTIMO 
function esUltimo($actual,$proximo) {
    if($actual !== $proximo) {
        return true;
    }
    return false;
}