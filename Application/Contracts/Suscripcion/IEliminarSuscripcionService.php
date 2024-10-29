<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/SuscripcionModel.php";

interface IEliminarSuscripcionService {
    public function eliminarSuscripcion(string $codigo);
}