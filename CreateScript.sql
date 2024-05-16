CREATE TABLE IF NOT EXISTS usuarios(
	id SERIAL PRIMARY KEY,
	name VARCHAR(100),
	email VARCHAR(100) unique,
	password VARCHAR(255),
	token text,
	estado boolean default true
);

CREATE TABLE IF NOT EXISTS proveedores(
	id SERIAL PRIMARY KEY,
	nombre VARCHAR(100),
	estado boolean default true
);

CREATE TABLE IF NOT EXISTS sucursales(
	id SERIAL PRIMARY KEY,
	nombre VARCHAR(100),
	estado boolean default true
);

CREATE TABLE IF NOT EXISTS almacenes(
	id SERIAL PRIMARY KEY,
	nombre VARCHAR(100),	
	estado boolean default true
);

CREATE TABLE IF NOT EXISTS telas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),	    
    precio  DOUBLE PRECISION default 0, --Precio Unitario De Compra
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
    CONSTRAINT fk_tela_almacen FOREIGN KEY (idtela) REFERENCES telas(id) ON DELETE CASCADE ON UPDATE RESTRICT
);


CREATE TABLE IF NOT EXISTS ventas (
    id SERIAL PRIMARY KEY,
    fecha DATE default NOW(),
    hora TIME DEFAULT NOW(),
    total DOUBLE PRECISION default 0,
    ganancias DOUBLE PRECISION default 0,
    descuento  DOUBLE PRECISION default 0,
    idsucursal INT,
    idusuario INT,--Vendedor
	estado boolean default true,
    CONSTRAINT fk_sucursal FOREIGN KEY (idsucursal) REFERENCES sucursales(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_usuario FOREIGN KEY (idusuario) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE RESTRICT
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
    totalAG DOUBLE PRECISION,
    idalmacen int,
    CONSTRAINT fk_almacen FOREIGN KEY (idalmacen) REFERENCES almacenes(id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS det_compras(
	idcompra INT,
	idtela INT,
	cantidad DOUBLE PRECISION,
	precio DOUBLE PRECISION,
	precioAG DOUBLE precision,
	CONSTRAINT pk_compra_tela PRIMARY KEY (idcompra, idtela),
	CONSTRAINT fk_compra FOREIGN KEY (idcompra) REFERENCES compras(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_tela FOREIGN KEY (idtela) REFERENCES telas(id) ON DELETE CASCADE ON UPDATE RESTRICT
);