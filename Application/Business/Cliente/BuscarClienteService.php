<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Cliente/IClienteRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/Cliente/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/IBuscarClienteService.php";

class BuscarClienteService implements IBuscarClienteService {

    private $ClienteRepository;

    public function __construct(IClienteRepository $ClienteRepository){
        $this->ClienteRepository = $ClienteRepository;
    }

    public function buscarCliente(string $cedula): ClienteModel {
        return $this->ClienteRepository->findByCedula($cedula);
    }
}