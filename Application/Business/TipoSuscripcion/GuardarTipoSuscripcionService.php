<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/TipoSuscripcionModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Suscripcion/ISuscripcionRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/TipoSuscripcion/IGuardarTipoSuscripcionService.php";

class guardarTipoSuscripcionService implements IGuardarTipoSuscripcionService {

    private $TipoSuscripcionRepository;

    public function __construct(ITipoSuscripcionRepository $TipoSuscripcionRepository){
        $this->TipoSuscripcionRepository=$TipoSuscripcionRepository;    
    }

    public function guardarTipoSuscripcion(TipoSuscripcionModel $tipoSuscripcion) {
        try {
            return $this->TipoSuscripcionRepository->crear($tipoSuscripcion);
        } catch (EntityPreexistingException $e) {
            throw $e;
        }
    }
}