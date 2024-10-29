<?php
namespace Database\Entities;

use ActiveRecord\Model;
use ClienteModel;

require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/vendor/autoload.php';

class Cliente extends Model {  

    public static String $table_name = 'clientes';
    public static string $primary_key = "cedula";
    public static array $belongs_to = [
        ['suscripciones', 'class_name' => 'Suscripcion']
    ];

    public function mapperEntityToModel() : ClienteModel {
        $clienteModel = new ClienteModel(
            $this->cedula,
            $this->nombre,
            $this->apellidos,
            $this->email,
            $this->telefono,
            $this->fechaEntrada,
            $this->ultima_fecha_entrada,
            $this->tipo,
            $this->clave,
            $this->direccion
        );
        return $clienteModel;
    }
}