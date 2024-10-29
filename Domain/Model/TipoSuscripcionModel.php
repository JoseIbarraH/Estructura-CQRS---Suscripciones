<?php

class TipoSuscripcionModel {
    private $idTipoSuscripcion;
    private $nombreTipo;
    private $descripcion;
    private $precioBase;

    public function __construct($idTipoSuscripcion, $nombreTipo, $descripcion, $precioBase) {
        $this->idTipoSuscripcion = $idTipoSuscripcion;
        $this->nombreTipo = $nombreTipo;
        $this->descripcion = $descripcion;
        $this->precioBase = $precioBase;
    }

    public function getIdTipoSuscripcion(): string {
        return $this->idTipoSuscripcion;
    }

    public function getNombreTipo(): string {
        return $this->nombreTipo;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getprecioBase(): string {
        return $this->precioBase;
    }

    public function setIdTipoSuscripcion(string $idTipoSuscripcion) {
        $this->idTipoSuscripcion = $idTipoSuscripcion;
    }

    public function setNombreTipo(string $nombreTipo) {
        $this->nombreTipo = $nombreTipo;
    }

    public function setDescripcion(string $descripcion) { 
        $this->descripcion = $descripcion;
    }

    public function setprecioBase(string $precioBase) {
        $this->precioBase = $precioBase;
    }

}