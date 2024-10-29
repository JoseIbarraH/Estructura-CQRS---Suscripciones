<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Domain/Model/SuscripcionModel.php';

interface ISuscripcionRepository {
    public function crear(string $cedula, string $idSuscripcion);

    public function findByCodigo (string $codigo): TipoSuscripcionModel;

    public function editar(SuscripcionModel $suscripcionModel): SuscripcionModel;

    public function eliminarCodigo(string $codigo);

    public function listaSuscripciones(): array;

}