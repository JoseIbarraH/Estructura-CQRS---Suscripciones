<?php

use Database\Entities\Suscripcion;

require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/Suscripciones/Infrastructure/Libs/Orm/config.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Domain/Model/ClienteModel.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Contracts/Suscripcion/IGuardarSuscripcionService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Contracts/Suscripcion/ISuscripcionRepository.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Exceptions/EntityPreexistingException.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Infrastructure/Repository/SuscripcionRepository.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/Suscripcion/GuardarSuscripcionService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/Suscripcion/EliminarSuscripcionService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Infrastructure/Database/Entities/Cliente.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/Suscripcion/EditarSuscripcionService.php';

class SuscripcionController {

    private $suscripcionRepository;

    public function __construct(SuscripcionRepository $suscripcionRepository) {
        $this->suscripcionRepository = $suscripcionRepository;  
    }

    public function actionExecuter() {
        if ( isset( $_REQUEST[ 'action' ] ) ) {
            $action = $_REQUEST[ 'action' ];
            switch ( $action ) {
                case 'suscribirse':
                    $this->guardarSuscripcion();
                    break;
                case 'Mis_suscripciones':
                    $this->mostrarSuscripciones();
                    break;
                case 'Eliminar':
                    $this->eliminarSuscripcion();
                    break;
                default:
                    echo 'Todo mal con las redirecciones';
                    break;
            }
        }
    }

    public function eliminarSuscripcion() {
        $codigo = $_REQUEST[ 'codigo' ];
        try {
            $eliminarSuscripcionService = new EliminarSuscripcionService( $this->suscripcionRepository );
            $eliminarSuscripcionService->eliminarSuscripcion($codigo);
            $this->mostrarSuscripciones();
        } catch ( Exception $e ) {
            $message = "Suscripcion eliminada con codigo $codigo";
        }
    }

    public function guardarSuscripcion() {
        try {
            $cedula = $_REQUEST[ 'cedula' ];
            $codigo = $_REQUEST[ 'id' ];

            $guardarSuscripcionService = new GuardarSuscripcionService( $this->suscripcionRepository );
            $guardarSuscripcionService->guardarSuscripcion( $cedula, $codigo );

            header("Location: ../Public/Views/Forms/menu_User.php"); 
        } catch ( Exception $e ) {
            $message = $e->getMessage();
            header("Location: ../Public/Views/Forms/Clientes/CRUD_Clientes.php?message=" . urlencode($message));
        }
    }

    public function mostrarSuscripciones() {
        $suscripciones = $this->suscripcionRepository->listaSuscripciones();
        if ($suscripciones) {
            echo "<script>console.log('Suscripciones listadas con éxito.')</script>";
        } else {
            echo "<script>console.log('No hay suscripciones registradas.')</script>";
        }
        include '../Public/Views/Forms/Suscripciones/MisSuscripciones.php';

    }

}

$suscripcionRepository = new SuscripcionRepository();
$controlador = new SuscripcionController($suscripcionRepository);
$controlador->actionExecuter();
