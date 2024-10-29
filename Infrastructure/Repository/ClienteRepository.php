<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Domain/Model/ClienteModel.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Application/Exceptions/EntityNotFoundException.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Application/Exceptions/EntityPreexistingException.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Suscripciones/Infrastructure/Repository/ClienteRepository.php';


use Database\Entities\Cliente;

class ClienteRepository implements IClienteRepository {

    public function crear(ClienteModel $clienteModel): int {
        try {
            $cliente = $this->findByCedula($clienteModel->getCedula());
            if($cliente !== null) {
                $mensaje = "Cliente con cedula ". $cliente->getCedula() ." ya existe.";
                throw new EntityPreexistingException($mensaje);
            }
            return 0;
        } catch (Exception $e) {

            $cliente = new Cliente();
            $cliente->cedula = $clienteModel->getCedula();
            $cliente->nombre = $clienteModel->getNombre();
            $cliente->apellidos = $clienteModel->getApellidos();
            $cliente->email = $clienteModel->getEmail();
            $cliente->telefono = $clienteModel->getTelefono();
            $cliente->tipo = $clienteModel->getTipo();
            $cliente->clave = $clienteModel->getClave();
            $cliente->direccion = $clienteModel->getDireccion();
            $cliente->save();
            return $this->contar();
        }catch (EntityPreexistingException $e) {
            throw $e;
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

    public function contar(): int {
        return @Cliente::count();
    }
    
    public function editar(ClienteModel $clienteModel): ClienteModel {
        try {
            
            // Buscar el cliente en la base de datos por cédula usando una sintaxis alternativa
            $cliente = Cliente::find( $clienteModel->getCedula() );
            
            if (!$cliente) {
                throw new EntityNotFoundException("Cliente con cédula " . $clienteModel->getCedula() . " no existe.");
            }
            
            // Actualizar los campos del cliente con los datos del modelo
            $cliente->nombre = $clienteModel->getNombre();
            $cliente->apellidos = $clienteModel->getApellidos();
            $cliente->email = $clienteModel->getEmail();
            $cliente->telefono = $clienteModel->getTelefono();
            $cliente->tipo = $clienteModel->getTipo();
            $cliente->clave = $clienteModel->getClave();
            $cliente->direccion = $clienteModel->getDireccion();
            
            // Guardar los cambios en la base de datos
            if (!$cliente->save()) {
                throw new Exception("No se pudo guardar los cambios del cliente.");
            }
            return $clienteModel;
    
        } catch (EntityNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception("Error al editar el cliente: " . $e->getMessage());
        }
    }

    public function eliminarId(string $cedula) {
        try{
            $cliente = Cliente::find($cedula);
            $cliente->delete();
        }catch (Exception $e) {
            $message = "El cliente con la cedula ".$cedula." no existe";
            throw new EntityNotFoundException($message);
        }
    }

    public function listaClientes(): array {
        $clientesList = Cliente::all();
        $clientesModelList = [];
        foreach($clientesList as $clientedb){
            $clienteModel = $clientedb->mapperEntityToModel();
            $clientesModelList[] = $clienteModel;
        }
        return $clientesModelList;
    }
}