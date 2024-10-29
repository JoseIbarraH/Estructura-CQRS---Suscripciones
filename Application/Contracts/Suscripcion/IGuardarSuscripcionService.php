<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/SuscripcionModel.php";

interface IGuardarSuscripcionService {
    public function guardarSuscripcion(string $cedula, string $idSuscripcion);
}