<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Suscripciones/Infrastructure/Libs/Orm/config.php';
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/IGuardarClienteService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Business/GuardarClienteService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/IClienteRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Infrastructure/Repository/ClienteRepository.php";

class TestGuardarCliente {
    public static function testGuardarCliente() {
        $cedula = "4321";
        $nombre = "Andres";
        $apellidos = "Ibarra Herrera";
        $email = "email@gmail.com";
        $telefono = "3214567890";
        $clave = "1234";
        $direccion = "la esquina";

        $clienteModel = new ClienteModel(
            $cedula, 
            $nombre, 
            $apellidos, 
            $email, 
            $telefono, 
            null,
            null,
            null,
            $clave,
            $direccion
        );
        echo "asigno valores al cliente <br>";

        $clienteRepository = new ClienteRepository();
        $guardarClienteService = new GuardarClienteService( $clienteRepository);
    
        try {
            $total = $guardarClienteService->guardarCliente($clienteModel);
            echo"Total Usuarios $total";
        } catch (Exception $e) {
            echo "todo mal: $e";
        }
    }
}

TestGuardarCliente::testGuardarCliente();