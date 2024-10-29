<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/suscripciones/Domain/Model/SuscripcionModel";

interface IBuscarSuscripcionService {
    public function buscarSuscripcion(string $codigo): SuscripcionModel;
}