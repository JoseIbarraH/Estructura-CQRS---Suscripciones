<?php 

class SuscripcionModel {
    private $codigo;
    private $password;
    private $email;
    private $cedulaCliente;
    private $fechaSuscripcion;
    private $estado;
    private $tipoSuscripcion;
    private $fechaExpiracion;
    private $precio;
    private $detalles;

    public function __construct(
        string $codigo,
        string $password,
        string $email,
        string $cedulaCliente,
        string $fechaSuscripcion,
        string $estado,
        string $tipoSuscripcion,
        string $fechaExpiracion,
        string $precio,
        string $detalles
    ) {
        $this->codigo = $codigo;
        $this->password = $password;
        $this->email = $email;
        $this->cedulaCliente = $cedulaCliente;
        $this->fechaSuscripcion = $fechaSuscripcion;
        $this->estado = $estado;
        $this->tipoSuscripcion = $tipoSuscripcion;
        $this->fechaExpiracion = $fechaExpiracion;
        $this->precio = $precio;
        $this->detalles = $detalles;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCedulaCliente() {
        return $this->cedulaCliente;
    }

    public function getFechaSuscripcion() {
        return $this->fechaSuscripcion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getTipoSuscripcion() {
        return $this->tipoSuscripcion;
    }

    public function getFechaExpiracion() {
        return $this->fechaExpiracion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getDetalles() {
        return $this->detalles;
    }

    public function setCodigo(string $codigo) {
        $this->codigo = $codigo;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setCedulaCliente(string $cedulaCliente) {
        $this->cedulaCliente = $cedulaCliente;
    }

    public function setFechaSuscripcion(string $fechaSuscripcion) {
        $this->fechaSuscripcion = $fechaSuscripcion;
    }

    public function setEstado(string $estado) {
        $this->estado = $estado;
    }

    public function setTipoSuscripcion(string $tipoSuscripcion){
        $this->tipoSuscripcion = $tipoSuscripcion;
    }

    public function setFechaExpiracion(string $fechaExpiracion) {
        $this->fechaExpiracion = $fechaExpiracion;
    }

    public function setPrecio(string $precio) {
        $this->precio = $precio;
    }

    public function setDetalles(string $detalles) {   
        $this->detalles = $detalles;
    }

    
}