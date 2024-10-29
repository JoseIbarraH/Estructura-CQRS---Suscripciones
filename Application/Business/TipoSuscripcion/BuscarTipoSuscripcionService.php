<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/TipoSuscripcionModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/TipoSuscripcion/ITipoSuscripcionRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Exceptions/Cliente/EntityPreexistingException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Application/Contracts/TipoSuscripcion/IBuscarTipoSuscripcionService.php";

class BuscarTipoSuscripcionService implements IBuscarTipoSuscripcionService {

    private $TipoSuscripcionRepository;

    public function __construct(ITipoSuscripcionRepository $iTipoSuscripcionRepository) {
        $this->TipoSuscripcionRepository = $iTipoSuscripcionRepository;
    }

    public function buscarTipoSuscripcion(string $idTipoSuscripcion): TipoSuscripcionModel {
        return $this->TipoSuscripcionRepository->findByCodigo($idTipoSuscripcion);
    }
}