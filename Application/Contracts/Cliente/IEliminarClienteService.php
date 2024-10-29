<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";

interface IEliminarClienteService {
    public function eliminarCliente(string $cedula);
}