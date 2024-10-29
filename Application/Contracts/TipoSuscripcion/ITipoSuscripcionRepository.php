<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Domain/Model/TipoSuscripcionModel.php';

interface ITipoSuscripcionRepository {

    public function crear(TipoSuscripcionModel $TipoSuscripcionModel);

    public function findByCodigo(string $idTipoSuscripcion): TipoSuscripcionModel;

    public function editar(TipoSuscripcionModel $tipoSuscripcionModel): TipoSuscripcionModel;

    public function eliminarIdTipoSuscripcion(string $idTipoSuscripcion);

    public function listaTipoSuscripciones(): array ;
}
