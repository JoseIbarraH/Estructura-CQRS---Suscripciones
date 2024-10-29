<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Domain/Model/SuscripcionModel.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Application/Exceptions/EntityNotFoundException.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Application/Exceptions/EntityPreexistingException.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Suscripciones/Infrastructure/Repository/SuscripcionRepository.php';

use Database\Entities\Suscripcion;
use Database\Entities\Cliente;
use Database\Entities\TipoSuscripcion;

class SuscripcionRepository implements ISuscripcionRepository {

    public function crear(string $cedula, string $idSuscripcion) {
        try {
            $cliente = Cliente::find($cedula); 
            $tipoSuscripcion = TipoSuscripcion::find($idSuscripcion);
            
            $suscripcion = new Suscripcion();
            $suscripcion->codigo = null;
            if ($cliente !== null) {
                $suscripcion->password = $cliente->Clave;
                $suscripcion->email = $cliente->email;
                $suscripcion->cedulaCliente = $cliente->cedula;
            } else {
                throw new Exception("Cliente no encontrado.");
            }
    
            if ($tipoSuscripcion !== null) {
                $suscripcion->tipoSuscripcion = $tipoSuscripcion->IdTipoSuscripcion;
                $suscripcion->precio = $tipoSuscripcion->precioBase;
                $suscripcion->detalles = $tipoSuscripcion->descripcion;
            } else {
                throw new Exception("Tipo de suscripción no encontrado.");
            }
    
            $suscripcion->fechaSuscripcion = (new DateTime())->format('Y-m-d H:i:s');
            $suscripcion->fechaExpiracion = (new DateTime())->modify('+30 days')->format('Y-m-d H:i:s');

            $suscripcion->estado = "activa";
    
            $suscripcion->save();
    
        } catch (EntityPreexistingException $e) {
            throw $e; 
        } catch (Exception $e) {
            throw new Exception("Error al crear la suscripción 222: " . $e->getMessage());
        }
    }
    

    public function findByCedula(string $cedula): ClienteModel {
        try {
            $cliente = Cliente::find($cedula);
            return $cliente->mapperClienteModel();
        }catch (Exception $e) {
            $mensaje = "Cliente con cedula $cedula no existe";
            throw new EntityNotFoundException($mensaje);
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


    public function editar(SuscripcionModel $suscripcionModel): SuscripcionModel {
        try {
            $suscripcion = Suscripcion::find($suscripcionModel->getCodigo());

            if(!$suscripcion) {
                throw new EntityNotFoundException("Suscripcion con codigo " . $suscripcionModel->getCodigo(). " no existe. ");
            }

            $suscripcion->password = $suscripcionModel->getPassword();
            $suscripcion->email = $suscripcionModel->getEmail();
            $suscripcion->cedulaCliente = $suscripcionModel->getCedulaCliente();
            $suscripcion->fechaSuscripcion = $suscripcionModel->getFechaSuscripcion();
            $suscripcion->estado = $suscripcionModel->getEstado();
            $suscripcion->tipoSuscripcion = $suscripcionModel->getTipoSuscripcion();
            $suscripcion->fechaExpiracion = $suscripcionModel->getFechaExpiracion();
            $suscripcion->precio = $suscripcionModel->getPrecio();
            $suscripcion->detalle = $suscripcionModel->getDetalles();
            
            if (!$suscripcion->save()) {
                throw new Exception("No se pudo guardar los cambios de la suscripcion");
            }
            return $suscripcionModel;
        } catch (EntityNotFoundException $e) {
            throw $e;
        }catch(Exception $e) {
            throw new Exception("Error al editar la suscripcion" . $e->getMessage());
        }
    }

    public function eliminarCodigo(string $codigo) {
        try {
            $suscripcion = Suscripcion::find($codigo);
            $suscripcion->delete();
        }catch(Exception $e) {
            $message = "La suscripcion con codigo ".$codigo." no existe";
            throw new EntityNotFoundException($message);
        }
    }

    public function listaSuscripciones(): array {
        $suscripcionesList = Suscripcion::all();
        $suscripcionesModeList = [];
        foreach ($suscripcionesList as $suscripciondb) {
            $suscripcionModel = $suscripciondb->mapperEntityToModel();
            $suscripcionesModeList[] = $suscripcionModel;
        }
        return $suscripcionesModeList;
    }
}