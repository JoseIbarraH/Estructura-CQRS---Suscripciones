<?php
namespace Database\Entities; 

use ActiveRecord\Model;
use SuscripcionModel;

require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/vendor/autoload.php';

class Suscripcion extends Model {

    public static string $table_name = 'suscripciones';
    public static string $primary_key = 'codigo';
    public static array $belongs_to = [
        ['suscripciones', 'class_name' => 'Cliente']
    ];

    public function mapperEntityToModel() : SuscripcionModel {
        $suscripcionModel = new SuscripcionModel(
            $this->codigo,
            $this->password,
            $this->email,
            $this->cedulaCliente,
            $this->fechaSuscripcion,
            $this->estado,
            $this->tipoSuscripcion,
            $this->fechaExpiracion,
            $this->precio,
            $this->detalles
        );
        return $suscripcionModel;
    }
}