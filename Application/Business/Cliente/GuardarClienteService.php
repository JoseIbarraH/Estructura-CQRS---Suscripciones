<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Cliente/IGuardarClienteService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Cliente/IClienteRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";

class GuardarClienteService implements IGuardarClienteService {

    private $ClienteRepository;

    public function __construct(IClienteRepository $ClienteRepository){
        $this->ClienteRepository = $ClienteRepository;
    }

    public function guardarCliente(ClienteModel $cliente): int{
        try{
            return $this->ClienteRepository->crear($cliente);
        }catch(EntityPreexistingException $e){
            throw $e;
        }
    }
}