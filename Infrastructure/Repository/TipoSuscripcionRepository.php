<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Domain/Model/TipoSuscripcionModel.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Application/Exceptions/EntityNotFoundException.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Application/Exceptions/EntityPreexistingException.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Suscripciones/Infrastructure/Repository/TipoSuscripcionRepository.php';

use Database\Entities\TipoSuscripcion;

class TipoSuscripcionRepository implements ITipoSuscripcionRepository {
    
    public function crear(TipoSuscripcionModel $TipoSuscripcionModel) {
        try {   
            $tipoSuscripcion = new TipoSuscripcion();
            $tipoSuscripcion->nombreTipo = $TipoSuscripcionModel->getNombretipo();
            $tipoSuscripcion->descripcion = $TipoSuscripcionModel->getDescripcion();
            $tipoSuscripcion->precioBase = $TipoSuscripcionModel->getPrecioBase();
            $tipoSuscripcion->save();
        }catch (EntityPreexistingException $e) {
            throw $e;
        }
    }

    public function findByCodigo(string $idTipoSuscripcion): TipoSuscripcionModel {
        try {
            $tipoSuscripcion = TipoSuscripcion::find($idTipoSuscripcion);
            return $tipoSuscripcion->mapperClienteModel();
        }catch(Exception $e) {
            $mensaje = "Suscripcion con codigo $idTipoSuscripcion no existe";
            throw new EntityPreexistingException($mensaje);
        }
    }

    public function editar(TipoSuscripcionModel $tipoSuscripcionModel): TipoSuscripcionModel {
        try {
            $tipoSuscripcion = TipoSuscripcion::find($tipoSuscripcionModel->getIdTipoSuscripcion());

            if(!$tipoSuscripcion) {
                throw new EntityPreexistingException("TipoSuscripcion con id ". $tipoSuscripcionModel->getIdTipoSuscripcion() ." no existe.");
            }

            $tipoSuscripcion->nombreTipo = $tipoSuscripcion->getNombreTipo();
            $tipoSuscripcion->descripcion = $tipoSuscripcion->getDescripcion();
            $tipoSuscripcion->precioBase = $tipoSuscripcion->getPrecioBase();

            if(!$tipoSuscripcion->save()) {
                throw new Exception("No se pudo guardar los cambios del tipo de suscripcion");
            }
            return $tipoSuscripcionModel;
        }catch(EntityNotFoundException $e){
            throw $e;
        }catch(Exception $e) {
            throw new Exception("Error al editar el tipo de suscripcion" . $e->getMessage());
        }
    }

    public function eliminarIdTipoSuscripcion(string $idTipoSuscripcion) {
        try {
            $tipoSuscripcion = TipoSuscripcion::find($idTipoSuscripcion);
            $tipoSuscripcion->delete();
        }catch (Exception $e) { 
            $message = "El tipo de usuario ". $idTipoSuscripcion ." no existe.";
            throw new EntityNotFoundException($message);
        }
    }

    public function listaTipoSuscripciones(): array {
        try {            
            $tipoSuscripcionesList = TipoSuscripcion::all();
            
            if (empty($tipoSuscripcionesList)) {
                throw new Exception("No se encontraron tipos de suscripción");
            }
            
            $tipoSuscripcionesModelList = [];
            foreach($tipoSuscripcionesList as $tipoSuscripciondb){
                $tipoSuscripcionModel = $tipoSuscripciondb->mapperEntityToModel();
                $tipoSuscripcionesModelList[] = $tipoSuscripcionModel;
            }
            
            return $tipoSuscripcionesModelList;
        } catch (Exception $e) {
            error_log("Error en listaTipoSuscripciones: " . $e->getMessage());
            throw $e;
        }
    }
}