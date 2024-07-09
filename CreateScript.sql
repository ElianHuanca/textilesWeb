/*CREATE TABLE IF NOT EXISTS usuarios(
	id SERIAL PRIMARY KEY,
	name VARCHAR(100),
	email VARCHAR(100) unique,
	password VARCHAR(255),
	token text,
	estado boolean default true
);*/

--ALTER TABLE users 
--ADD COLUMN rol integer DEFAULT 1; --1:Gerente, 2: Vendedor, 3:Almacen

alter table users 
add column metas double precision default 0;

/*alter table users 
add column token text;*/

CREATE TABLE IF NOT EXISTS proveedores(
	id SERIAL PRIMARY KEY,
	nombre VARCHAR(100),
	estado boolean default true
);

CREATE TABLE IF NOT EXISTS sucursales(
	id SERIAL PRIMARY KEY,
	direccion VARCHAR(100),
	zona VARCHAR(100),
	celular VARCHAR(8),
	estado boolean default true
);

CREATE TABLE IF NOT EXISTS almacenes(
	id SERIAL PRIMARY KEY,
	direccion VARCHAR(100),
	zona VARCHAR(100),
	celular VARCHAR(8),
	estado boolean default true
);

CREATE TABLE IF NOT EXISTS telas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),	    
    precioxcompra  DOUBLE PRECISION default 0, --Precio Unitario De Compra
    precioxmay DOUBLE PRECISION default 0,
    precioxmen DOUBLE PRECISION default 0,
    precioxrollo DOUBLE PRECISION default 0,
    rop DOUBLE PRECISION default 0,
   	seguridad DOUBLE PRECISION default 0,
	idproveedor int,
	estado boolean default true,
	CONSTRAINT fk_proveedor FOREIGN KEY (idproveedor) REFERENCES proveedores(id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS sucursalestelas (
    idsucursal INT,
    idtela INT,
    stock DOUBLE PRECISION DEFAULT 0,    
    CONSTRAINT pk_sucursal_tela PRIMARY KEY (idsucursal, idtela),
    CONSTRAINT fk_sucursal FOREIGN KEY (idsucursal) REFERENCES sucursales(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_tela FOREIGN KEY (idtela) REFERENCES telas(id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS almacenestelas (
    idalmacen INT,
    idtela INT,
    stock DOUBLE PRECISION DEFAULT 0,
    CONSTRAINT pk_almacen_tela PRIMARY KEY (idalmacen, idtela),
    CONSTRAINT fk_almacen FOREIGN KEY (idalmacen) REFERENCES almacenes(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_tela FOREIGN KEY (idtela) REFERENCES telas(id) ON DELETE CASCADE ON UPDATE RESTRICT
);


CREATE TABLE IF NOT EXISTS ventas (
    id SERIAL PRIMARY KEY,
    fecha DATE default NOW(),
    --hora TIME DEFAULT NOW(),
    total DOUBLE PRECISION default 0,
    ganancias DOUBLE PRECISION default 0,
    descuento  DOUBLE PRECISION default 0,
    idsucursal INT,
    idusuario INT,--Vendedor
	estado boolean default true,
    CONSTRAINT fk_sucursal FOREIGN KEY (idsucursal) REFERENCES sucursales(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_usuario FOREIGN KEY (idusuario) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS det_ventas (    
    idventa INT,
    idtela INT,
    precio DOUBLE PRECISION,
    cantidad DOUBLE PRECISION,
    total DOUBLE PRECISION,
	ganancias DOUBLE PRECISION,
	estado boolean default true,
	CONSTRAINT pk_venta_tela PRIMARY KEY (idventa, idtela),
    CONSTRAINT pk_venta FOREIGN KEY (idventa) REFERENCES ventas(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT pk_tela FOREIGN KEY (idtela) REFERENCES telas(id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS compras(
    id SERIAL PRIMARY KEY,
    fecha DATE DEFAULT NOW (),
    total DOUBLE PRECISION,
    totalag DOUBLE precision default 0,
    --idalmacen int,
    estado boolean default true,
    idproveedor int,
    CONSTRAINT fk_proveedor FOREIGN KEY (idproveedor) REFERENCES proveedores(id) ON DELETE CASCADE ON UPDATE RESTRICT
    --CONSTRAINT fk_almacen FOREIGN KEY (idalmacen) REFERENCES almacenes(id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS det_compras(
	idcompra INT,
	idtela INT,
	cantidad DOUBLE PRECISION,
	precio DOUBLE PRECISION,
	totalag DOUBLE precision default 0,
	total DOUBLE precision,
	estado boolean default true,
	CONSTRAINT pk_compra_tela PRIMARY KEY (idcompra, idtela),
	CONSTRAINT fk_compra FOREIGN KEY (idcompra) REFERENCES compras(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_tela FOREIGN KEY (idtela) REFERENCES telas(id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT exists tipogastos(
	id SERIAL PRIMARY KEY,
	descripcion varchar(100),
	estado boolean default true
);

CREATE TABLE IF NOT EXISTS adiciongastos(
	idcompra INT,
	idgasto INT,
	costo DOUBLE PRECISION,
	estado boolean default true,
	CONSTRAINT pk_compra_gasto PRIMARY KEY (idcompra, idgasto),
	CONSTRAINT fk_compra FOREIGN KEY (idcompra) REFERENCES compras(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_gasto FOREIGN KEY (idgasto) REFERENCES tipogastos(id) ON DELETE CASCADE ON UPDATE RESTRICT
);

create table if not exists recepciones(
	id SERIAL PRIMARY KEY,
	idcompra int,
	idalmacen int,
	idusuario int, --ENCARGADO DE ALMACEN
	fecha date DEFAULT NOW (),
	tiempo int,
	CONSTRAINT fk_compra FOREIGN KEY (idcompra) REFERENCES compras(id) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT fk_almacen FOREIGN KEY (idalmacen) REFERENCES almacenes(id) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT fk_usuario FOREIGN KEY (idusuario) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT	
);


