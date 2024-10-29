<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Suscripciones/Infrastructure/Libs/Orm/config.php';

use Database\Entities\Cliente;

class TestCliente {

    public static function test_crear_cliente() {
        
        $cedula = "123";
        $nombre = "Jose";
        $apellidos = "Ibarra Herrera";
        $email = "jcibarrah@gmail.com";
        $telefono = "3164749242";
        $tipo = "administrador";
        $clave = "1234";
        $direccion = "La esquina de la castellana";

        $cliente = new Cliente();
        $cliente->cedula = $cedula;
        $cliente->nombre = $nombre;
        $cliente->apellidos = $apellidos;
        $cliente->email = $email;
        $cliente->telefono = $telefono;
        $cliente->tipo = $tipo;
        $cliente->clave = $clave;
        $cliente->direccion = $direccion;

        try {
            $user = Cliente::find_by_cedula($cedula);
            if($user) {
                echo "Este cliente ya existe.";
            } else {
                $cliente->save();
                echo "Todo bien con el registro";
            }
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
        }
    }
}

TestCliente::test_crear_cliente();