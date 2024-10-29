<?php

require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/Suscripciones/Infrastructure/Libs/Orm/config.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Domain/Model/TipoSuscripcionModel.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Contracts/TipoSuscripcion/IGuardarTipoSuscripcionService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Contracts/TipoSuscripcion/ITipoSuscripcionRepository.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Exceptions/EntityPreexistingException.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Infrastructure/Repository/TipoSuscripcionRepository.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/TipoSuscripcion/GuardarTipoSuscripcionService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/TipoSuscripcion/EliminarTipoSuscripcionesService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Infrastructure/Database/Entities/TipoSuscripcion.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/TipoSuscripcion/EditarTipoSuscripcionService.php';
 
class TipoSuscripcionController {

    private $tipoSuscripcionRepository;

    public function __construct( TipoSuscripcionRepository $tipoSuscripcionRepository ) {
        $this->tipoSuscripcionRepository = $tipoSuscripcionRepository;
    }

    public function actionExecuter() {
        if ( isset( $_REQUEST[ 'action' ] ) ) {
            $action = $_REQUEST[ 'action' ];
            switch ( $action ) {
                case 'crud_suscripciones':
                    $this->mostrarTipoSuscripciones();
                    break;
                case 'Suscribirse':
                    $this->mostrarTipoSuscripciones2();
                    break;
                case 'Guardar':
                    $this->guardarTipoSuscripcion();
                    break;
                case 'Eliminar':
                    $id = $_REQUEST[ 'id' ];
                    $this->eliminarTipoSuscripcion($id);
                    break;
                default:
                    echo'Todo mal con las direcciones';
                    break;
            }
        }
    }

    public function guardarTipoSuscripcion() {
        try {
            $idTipoSuscripcion = null;
            $titulo = $_REQUEST[ 'titulo' ];
            $descripcion = $_REQUEST[ 'descripcion' ];
            $precio = $_REQUEST[ 'precio' ];
            
            $tipoSuscripcionModel = new TipoSuscripcionModel(
                $idTipoSuscripcion,
                $titulo,
                $descripcion,
                $precio
            );

            $guardarTipoSuscripcionService = new guardarTipoSuscripcionService($this->tipoSuscripcionRepository);
            $guardarTipoSuscripcionService->guardarTipoSuscripcion($tipoSuscripcionModel);
            $this->mostrarTipoSuscripciones();
        } catch (Exception $e) {
            $message = $e->getMessage();
            header("Location: ../Public/Views/Forms/Suscripciones/CRUD_Suscripciones.php?message=" . urlencode($message));
        }
    }

    public function mostrarTipoSuscripciones() {
        $tipoSuscripciones = $this->tipoSuscripcionRepository->listaTipoSuscripciones();
        if ($tipoSuscripciones) {
            echo "<script>console.log('tipos de suscripciones listados con éxito.')</script>";
        } else {
            echo "<script>console.log('No hay tipos de suscripciones registradas.')</script>";
        }
        include '../Public/Views/Forms/Suscripciones/CRUD_Suscripciones.php';
    }

    public function mostrarTipoSuscripciones2() {
        $tipoSuscripciones = $this->tipoSuscripcionRepository->listaTipoSuscripciones();
        if ($tipoSuscripciones) {
            echo "<script>console.log('tipos de suscripciones listados con éxito.')</script>";
        } else {
            echo "<script>console.log('No hay tipos de suscripciones registradas.')</script>";
        }
        include '../Public/Views/Forms/Suscripciones/Suscripciones.php';
    }

    public function eliminarTipoSuscripcion(string $idTipoSuscripcion) {
        try {
            $eliminarTipoSuscripcionService = new EliminarTipoSuscripcionService( $this->tipoSuscripcionRepository );
            $eliminarTipoSuscripcionService->eliminarTipoSuscripcion( $idTipoSuscripcion );
            $this->mostrarTipoSuscripciones();
        } catch ( Exception $e ) {
            $message = "Suscripcion eliminada con id $idTipoSuscripcion";
            throw $e;
        }
    }

    public function editarTipoSuscripcion() {
        try {
            $idTipoSuscripcion = null;
            $titulo = $_REQUEST[ 'titulo' ];
            $descripcion = $_REQUEST[ 'descripcion' ];
            $precio = $_REQUEST[ 'precio' ];
            
            $tipoSuscripcionModel = new TipoSuscripcionModel(
                $idTipoSuscripcion,
                $titulo,
                $descripcion,
                $precio
            );

            $guardarTipoSuscripcionService = new EditarTipoSuscripcionService($this->tipoSuscripcionRepository);
            $guardarTipoSuscripcionService->editarTipoSuscripcion($tipoSuscripcionModel);
            $this->mostrarTipoSuscripciones();
        } catch (Exception $e) {
            $message = $e->getMessage();
            header("Location: ../Public/Views/Forms/Suscripciones/CRUD_Suscripciones.php?message=" . urlencode($message));
        }
    }

}

$tipoSuscripcionRepository = new TipoSuscripcionRepository();
$controlador = new TipoSuscripcionController($tipoSuscripcionRepository);
$controlador->actionExecuter();
