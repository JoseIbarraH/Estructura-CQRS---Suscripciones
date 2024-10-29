<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";

interface IBuscarClienteService {
    public function buscarCliente(string $cedula): ClienteModel;
}