-- Active: 1726273689039@@127.0.0.1@3306@suscripciones

use suscripciones;

-- Tabla Clientes
CREATE TABLE Clientes (
    cedula INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    fechaEntrada  DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultima_fecha_entrada DATETIME DEFAULT NULL,
    tipo ENUM('cliente', 'administrador') DEFAULT 'cliente',
    clave VARCHAR(50) DEFAULT '1234',
    direccion VARCHAR(200)
);

-- Tabla TiposSuscripcion
CREATE TABLE TiposSuscripcion (
    idTipoSuscripcion INT PRIMARY KEY AUTO_INCREMENT,
    nombreTipo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precioBase DECIMAL(10, 2) NOT NULL
);

-- Tabla Suscripciones 
CREATE TABLE Suscripciones (
    codigo INT PRIMARY KEY AUTO_INCREMENT,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cedulaCliente INT,
    fechaSuscripcion DATE NOT NULL,
    estado ENUM('activa', 'inactiva', 'pendiente') DEFAULT 'activa',
    tipoSuscripcion INT NOT NULL,
    fechaExpiracion DATE,
    precio DECIMAL(10, 2),
    detalles TEXT,
    FOREIGN KEY (cedulaCliente) REFERENCES Clientes(cedula),
    FOREIGN KEY (tipoSuscripcion) REFERENCES TiposSuscripcion(idTipoSuscripcion)
);

-- Tabla Pagos
CREATE TABLE Pagos (
    idPago INT PRIMARY KEY AUTO_INCREMENT,
    codigoSuscripcion INT NOT NULL,
    fechaPago DATE NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    metodoPago ENUM('tarjeta', 'paypal', 'transferencia') NOT NULL,
    estadoPago ENUM('completado', 'pendiente', 'fallido') DEFAULT 'pendiente',
    FOREIGN KEY (codigoSuscripcion) REFERENCES Suscripciones(codigo)
);

-- Tabla HistorialEstadosSuscripcion
CREATE TABLE HistorialEstadosSuscripcion (
    idHistorial INT PRIMARY KEY AUTO_INCREMENT,
    codigoSuscripcion INT NOT NULL,
    estadoAnterior ENUM('activa', 'inactiva', 'pendiente') NOT NULL,
    estadoNuevo ENUM('activa', 'inactiva', 'pendiente') NOT NULL,
    fechaCambio DATE NOT NULL,
    FOREIGN KEY (codigoSuscripcion) REFERENCES Suscripciones(codigo)
);
