<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/SuscripcionModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Suscripcion/ISuscripcionRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Suscripcion/IEditarSuscripcionService.php";

class EditarSuscripcionService implements IEditarSuscripcionService {

    private $SuscripcionRepository;

    public function __construct(ISuscripcionRepository $SuscripcionRepository) {
        $this->SuscripcionRepository = $SuscripcionRepository;
    }

    public function editarSuscripcion(SuscripcionModel $suscripcion): SuscripcionModel {
        try {
            return $this->SuscripcionRepository->editar($suscripcion);
        }catch(Exception $e) {
            throw $e;
        }
    }

}