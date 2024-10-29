<?php

class ClienteModel {
    private $cedula;
    private $nombre;
    private $apellidos;
    private $email;
    private $telefono;
    private $fechaEntrada;
    private $ultima_fecha_entrada;
    private $tipo;
    private $clave;
    private $direccion;

    public function __construct(
        string $cedula,
        string $nombre,
        string $apellidos,
        string $email,
        string $telefono,
        string $fechaEntrada = null,   // Permite null
        string $ultima_fecha_entrada = null, // Permite null
        string $tipo = null,           // Permite null
        string $clave,
        string $direccion
    ) {
        $resultado = $this->validarClave($clave);
        if(!$resultado["resultado"]){
            throw new InvalidArgumentException("La clave es requerida");
        }
        
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->fechaEntrada = $fechaEntrada;
        $this->ultima_fecha_entrada = $ultima_fecha_entrada;
        $this->tipo = $tipo;
        $this->clave = $clave;
        $this->direccion = $direccion;
    }

    private function validarClave(string $clave): array {
        // Logica para validar la clave
        $resultado = true;
        $mensaje = "";
        if (empty(trim(string: $clave))){
            $mensaje = "La clave e requerida<br>";
            return array("resultado" => false, "mensaje" => $mensaje);
        }
        return array("resultado" => true, "mensaje" => "Clave ok");
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getTipo() {
        return $this->tipo ?? 'cliente';
    }

    public function getClave() {
        return $this->clave;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setCedula(string $cedula) {
        $this->cedula = $cedula;
    }

    public function setNombre(string $nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos(string $apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setTelefono(string $telefono) {
        $this->telefono = $telefono;
    }

    public function setTipo(string $tipo) {
        $this->tipo = $tipo;
    }

    public function setClave(string $clave) {
        $this->clave = $clave;
    }

    public function setdireccion(string $direccion) {
        $this->direccion = $direccion;
    }


}