<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Domain/Model/ClienteModel.php';

interface IClienteRepository {
    public function crear (ClienteModel $clienteModel): int;

    public function findByCedula (string $cedula): ClienteModel;

    public function contar(): int;

    public function editar (ClienteModel $clienteModel);

    public function eliminarId (string $cedula);

    public function listaClientes(): array;
}