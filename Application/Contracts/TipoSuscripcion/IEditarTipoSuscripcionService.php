<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/TipoSuscripcionModel.php";

interface IEditarTipoSuscripcionService {
    public function editarTipoSuscripcion(TipoSuscripcionModel $tipoSuscripcion): TipoSuscripcionModel;
}