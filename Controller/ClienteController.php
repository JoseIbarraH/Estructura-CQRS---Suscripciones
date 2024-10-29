<?php

require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/Suscripciones/Infrastructure/Libs/Orm/config.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Domain/Model/ClienteModel.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Contracts/Cliente/IGuardarClienteService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Contracts/Cliente/IClienteRepository.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Exceptions/EntityPreexistingException.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Infrastructure/Repository/ClienteRepository.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/Cliente/GuardarClienteService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/Cliente/EliminarClienteService.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Infrastructure/Database/Entities/Cliente.php';
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/suscripciones/Application/Business/Cliente/EditarClienteService.php';
 
class ClienteController {

    private $clienteRepository;

    public function __construct( ClienteRepository $clienteRepository ) {
        $this->clienteRepository = $clienteRepository;
    }

    public function actionExecuter() {
        if ( isset( $_REQUEST[ 'action' ] ) ) {
            $action = $_REQUEST[ 'action' ];
            switch ( $action ) {
                case 'IngresarListar':
                    $this->mostrarClientes();
                    break;
                case 'Guardar':
                    $this->guardarCliente();
                    break;
                case 'Editar':
                    $this->editarCliente();
                    break;
                case 'Eliminar':
                    $cedula = $_REQUEST[ 'cedula' ];
                    $this->eliminarCliente($cedula);
                    break;
                default:
                    echo 'Todo mal con las redirecciones';
                    break;
            }
        }
    }

    public function guardarCliente() {
        try {
            $cedula = $_REQUEST[ 'cedula' ];
            $nombre = $_REQUEST[ 'nombre' ];
            $apellidos = $_REQUEST[ 'apellidos' ];
            $email = $_REQUEST[ 'email' ];
            $telefono = $_REQUEST[ 'telefono' ];
            $fechaEntrada = null;
            $ultima_fecha_entrada = null;
            $tipo = $_REQUEST[ 'tipo' ];
            $clave = $_REQUEST[ 'clave' ];
            $direccion = $_REQUEST[ 'direccion' ];

            $clienteModel = new ClienteModel( 
                $cedula, 
                $nombre, 
                $apellidos, 
                $email, 
                $telefono, 
                $fechaEntrada, 
                $ultima_fecha_entrada,  
                $tipo, 
                $clave, 
                $direccion 
            );

            $guardarClienteService = new GuardarClienteService( $this->clienteRepository );
            $total = $guardarClienteService->guardarCliente( $clienteModel );
            $this->mostrarClientes();
        } catch ( Exception $e ) {
            $message = $e->getMessage();
            header("Location: ../Public/Views/Forms/Clientes/CRUD_Clientes.php?message=" . urlencode($message));
        }
    }

    public function editarCliente() {
        try {
            $cedula = $_REQUEST[ 'cedula' ];
            $nombre = $_REQUEST[ 'nombre' ];
            $apellidos = $_REQUEST[ 'apellidos' ];
            $email = $_REQUEST[ 'email' ];
            $telefono = $_REQUEST[ 'telefono' ];
            $fechaEntrada = null;
            $ultima_fecha_entrada = null;
            $tipo = $_REQUEST[ 'tipo' ];
            $clave = $_REQUEST[ 'clave' ];
            $direccion = $_REQUEST[ 'direccion' ];

            $clienteModel = new ClienteModel( $cedula, $nombre, $apellidos, $email, $telefono, $fechaEntrada, $ultima_fecha_entrada,  $tipo, $clave, $direccion );
            
            $editarClienteService = new EditarClienteService( $this->clienteRepository );
            $editarClienteService->editarCliente( $clienteModel );
            $this->mostrarClientes();
        } catch ( Exception $e ) {
            echo "todo mal con el editar ;C: $e";
        }
    }

    public function mostrarClientes() {
        $clientes = $this->clienteRepository->listaClientes();
        if ($clientes) {
            echo "<script>console.log('Clientes listados con éxito.')</script>";
        } else {
            echo "<script>console.log('No hay clientes registrados.')</script>";
        }
        include '../Public/Views/Forms/Clientes/CRUD_Clientes.php';
    }

    public function eliminarCliente(string $cedula) {
        try {
            $eliminarClienteService = new EliminarClienteService( $this->clienteRepository );
            $eliminarClienteService->eliminarCliente( $cedula );
            $message = "Cliente eliminado con cedula $cedula";
            $this->mostrarClientes();
        } catch ( Exception $e ) {
            $message = "Cliente eliminado con cedula $cedula";
        }
    }
    
}

$clienteRepository = new ClienteRepository();
$controlador = new ClienteController( $clienteRepository );
$controlador->actionExecuter();