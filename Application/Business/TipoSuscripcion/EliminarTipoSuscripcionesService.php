<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/TipoSuscripcionModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/TipoSuscripcion/ITipoSuscripcionRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/TipoSuscripcion/IEliminarTipoSuscripcionesService.php";

class EliminarTipoSuscripcionService implements IEliminarTipoSuscripcionService {

    private $TipoSuscripcionRepository;

    public function __construct(ITipoSuscripcionRepository $TipoSuscripcionRepository) {
        $this->TipoSuscripcionRepository = $TipoSuscripcionRepository;
    }

    public function eliminarTipoSuscripcion(string $idTipoSuscripcion) {
        try {
            return $this->TipoSuscripcionRepository->eliminarIdTipoSuscripcion($idTipoSuscripcion);
        } catch (EntityNotFoundException $e) {
            throw $e;
        }
    }
}