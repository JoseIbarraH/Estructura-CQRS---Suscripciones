<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/SuscripcionModel.php";

interface IEditarSuscripcionService {
    public function editarSuscripcion(SuscripcionModel $suscripcion): SuscripcionModel;
}