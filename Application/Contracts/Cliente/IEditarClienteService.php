<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";

interface IEditarClienteService {
    public function editarCliente(ClienteModel $cliente): ClienteModel;
}