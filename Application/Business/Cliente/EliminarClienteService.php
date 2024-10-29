<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Cliente/IEliminarClienteService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Cliente/IClienteRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";

class EliminarClienteService implements IEliminarClienteService {

    private $ClienteRepository;

    public function __construct(IClienteRepository $ClienteRepository) {
        $this->ClienteRepository = $ClienteRepository;
    }

    public function eliminarCliente(string $cedula) {
        try {
            return $this->ClienteRepository->eliminarId($cedula);
        } catch (EntityNotFoundException $e) {
            throw $e;
        }
    }

}
