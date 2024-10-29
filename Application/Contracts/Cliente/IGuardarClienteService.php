<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";

interface IGuardarClienteService {
    public function guardarCliente(ClienteModel $cliente): int;
}