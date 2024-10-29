<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/SuscripcionModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Suscripcion/ISuscripcionRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Suscripcion/IGuardarSuscripcionService.php";

class GuardarSuscripcionService implements IGuardarSuscripcionService {

    private $SuscripcionRepository;

    public function __construct(ISuscripcionRepository $SuscripcionRepository) {
        $this->SuscripcionRepository = $SuscripcionRepository;
    }

    public function guardarSuscripcion(string $cedula, string $idSuscripcion) {
        try {
            return $this->SuscripcionRepository->crear($cedula, $idSuscripcion);
        } catch (EntityPreexistingException $e) {
            throw $e;
        }
    }
}