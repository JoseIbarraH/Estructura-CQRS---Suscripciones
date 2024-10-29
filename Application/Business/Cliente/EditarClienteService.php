<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/ClienteModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Cliente/IClienteRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Cliente/IEditarClienteService.php";

class EditarClienteService implements IEditarClienteService {

    private $ClienteRepository;

    public function __construct(IClienteRepository $ClienteRepository){
        $this->ClienteRepository = $ClienteRepository;
    }

    public function editarCliente(ClienteModel $cliente): ClienteModel {
        try{
            return $this->ClienteRepository->editar($cliente);
        }catch(Exception $e){
            throw $e;
        }
    }
}