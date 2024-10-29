<?php 
namespace Database\Entities;

use ActiveRecord\Model;
use TipoSuscripcionModel;

class TipoSuscripcion extends Model {
    public static string $table_name = 'tipossuscripcion';
    
    public static string $primary_key = 'idTipoSuscripcion';
    
    public static array $has_many = [
        ['suscritos', 'class_name' => 'Suscripcion']
    ];
    
    public function mapperEntityToModel() : TipoSuscripcionModel {
        $tipoSuscripcionModel = new TipoSuscripcionModel(
            $this->idTipoSuscripcion,  // Coincide con el campo INT
            $this->nombreTipo,         // Coincide con el campo VARCHAR
            $this->descripcion,        // Coincide con el campo TEXT
            $this->precioBase          // Coincide con el campo DECIMAL
        );
        return $tipoSuscripcionModel;
    }
}