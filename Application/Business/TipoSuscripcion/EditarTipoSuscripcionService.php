<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/TipoSuscripcionModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/TipoSuscripcion/ITipoSuscripcionRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/TipoSuscripcion/IEditarTipoSuscripcionService.php";

class EditarTipoSuscripcionService implements IEditarTipoSuscripcionService {

    private $TipoSuscripcionRepository;

    public function __construct(ITipoSuscripcionRepository $TipoSuscripcionRepository) {
        $this->TipoSuscripcionRepository=$TipoSuscripcionRepository;
    }

    public function editarTipoSuscripcion(TipoSuscripcionModel $tipoSuscripcion): TipoSuscripcionModel {
        try {
            return $this->TipoSuscripcionRepository->editar($tipoSuscripcion);
        }catch(Exception $e) {
            throw $e;
        }
    }
}