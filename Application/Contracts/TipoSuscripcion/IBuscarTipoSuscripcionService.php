<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/TipoSuscripcionModel.php";

interface IBuscarTipoSuscripcionService {
    public function buscarTipoSuscripcion(string $idTipoSuscripcion): TipoSuscripcionModel;
}