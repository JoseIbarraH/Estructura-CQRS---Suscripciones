<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/TipoSuscripcionModel.php";

interface IGuardarTipoSuscripcionService {
    public function guardarTipoSuscripcion(TipoSuscripcionModel $tipoSuscripcion);
}