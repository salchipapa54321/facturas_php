/*BASE DE DATOS facturacion_tienda_db*/

SHOW DATABASES;
CREATE DATABASE facturacion_tienda_db;
USE facturacion_tienda_db;

CREATE TABLE usuarios(
id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
usuario VARCHAR(50) NOT NULL,
pwd VARCHAR (50) NOT NULL);

SHOW TABLES;

CREATE TABLE clientes(
id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
nombreCompleto VARCHAR(150) NOT NULL,
tipoDocumento ENUM('CC','CE','NIT','TI','OTRO') NOT NULL,
numeroDocumento VARCHAR(50) NOT NULL,
email VARCHAR(150) NOT NULL,
telefono VARCHAR(20) NOT NULL);

SHOW TABLES;

CREATE TABLE facturas(
referencia INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
fecha DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
estado ENUM('CAMBIO','DEVOLUCION','ERROR','PAGADA') NOT NULL,
descuento ENUM('0','2','4','8') NOT NULL,
idCliente INT(11) NOT NULL,
CONSTRAINT FK_clienteFactura FOREIGN KEY (idCliente) REFERENCES clientes(id)
);

SHOW TABLES;

CREATE TABLE articulos(
id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
nombre VARCHAR(50) NOT NULL,
precio DOUBLE NOT NULL
);

SHOW TABLES;

CREATE TABLE detalleFacturas(
id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
cantidad INT(11) NOT NULL,
precioUnitario DOUBLE NOT NULL,
idArticulo INT(11) NOT NULL,
referenciaFactura INT NOT NULL,
CONSTRAINT FK_articuloFacturas FOREIGN KEY (idArticulo) REFERENCES articulos(id),
CONSTRAINT FK_FactrefereciaArticulo FOREIGN KEY (referenciaFactura) REFERENCES facturas(referencia));

SHOW TABLES;

/*SETENCIAS SQL*/
INSERT INTO usuarios (usuario,pwd) VALUES ('admin@correo.com', MD5('1234567'));
SELECT * FROM usuarios;


/*EJEMPLO SETENCIAS MODELO*/
SELECT * FROM usuarios WHERE usuario = 'admin@correo.com' AND pwd = MD5('1234567');

/*ARTICULOS*/
INSERT INTO articulos (nombre,precio) VALUES ('Rodillera Ortopédica', 29900);
INSERT INTO articulos (nombre,precio) VALUES ('Tuff Agarre De Goma Bola De Medi', 413000);
INSERT INTO articulos (nombre,precio) VALUES ('Coffee Plus Colágeno', 155200);
INSERT INTO articulos (nombre,precio) VALUES ('Cuerda De Saltar', 46895);
INSERT INTO articulos (nombre, precio) VALUES ('Kit Cloruro Magnesio Calcio Y Colageno',77900);

SELECT * FROM articulos;

SELECT c.nombreCompleto,c.tipoDocumento,c.numeroDocumento,c.email,c.telefono,f.referencia,f.fecha,f.estado,f.descuento,df.cantidad,df.precioUnitario, a.nombre, a.precio FROM facturas f INNER JOIN  clientes c ON c.id = f.idCliente INNER JOIN detalleFacturas df ON df.referenciaFactura = f.referencia
INNER JOIN articulos a ON a.id = df.idArticulo ;