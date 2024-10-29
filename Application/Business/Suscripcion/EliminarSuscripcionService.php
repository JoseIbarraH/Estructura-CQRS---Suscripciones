<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/SuscripcionModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Suscripcion/ISuscripcionRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/Suscripcion/IEliminarSuscripcionService.php";

class EliminarSuscripcionService implements IEliminarSuscripcionService {

    private $SuscripcionRepository;

    public function __construct(ISuscripcionRepository $SuscripcionRepository) {
        $this->SuscripcionRepository = $SuscripcionRepository;
    }

    public function eliminarSuscripcion(string $codigo) {
        try {
            return $this->SuscripcionRepository->eliminarCodigo($codigo);
        } catch (EntityNotFoundException $e) {
            throw $e;
        }
    }
}