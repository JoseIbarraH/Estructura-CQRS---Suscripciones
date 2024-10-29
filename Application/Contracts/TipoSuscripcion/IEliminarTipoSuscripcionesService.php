<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/TipoSuscripcionModel.php";

interface IEliminarTipoSuscripcionService {

    public function eliminarTipoSuscripcion(string $idTipoSuscripcion);
}