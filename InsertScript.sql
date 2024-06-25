CREATE OR REPLACE FUNCTION insertar_en_sucursales_almacenes()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO sucursalestelas (idsucursal, idtela)
    SELECT id, NEW.id
    FROM sucursales;    
   
   INSERT INTO almacenestelas (idalmacen, idtela)
    SELECT id, NEW.id
    FROM almacenes;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_insertar_en_sucursales_almacenes
AFTER INSERT ON telas
FOR EACH ROW
EXECUTE FUNCTION insertar_en_sucursales_almacenes();


CREATE OR REPLACE FUNCTION insertar_en_telas()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO sucursalestelas (idsucursal, idtela)
    SELECT NEW.id, id
    FROM telas;
    RETURN NEW;   
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_insertar_en_telas
AFTER INSERT ON sucursales
FOR EACH ROW
EXECUTE FUNCTION insertar_en_telas();


CREATE OR REPLACE FUNCTION insertar_en_telas2()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO almacenestelas (idalmacen, idtela)
    SELECT NEW.id, id
    FROM telas;
    RETURN NEW;   
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_insertar_en_telas2
AFTER INSERT ON almacenes
FOR EACH ROW
EXECUTE FUNCTION insertar_en_telas2();


/*INSERT INTO usuarios(name,email,password) VALUES 
('Isela Huanca','ise@gmail.com','$2a$10$qAVkPAIHnamNzbDeMb94t.em.plQpqP8s/Bwy.LrZsCOqnWveg7He'),
('Mary Choque','mary@gmail.com','$2a$10$pyLUOKvtKEgB2PUyvCT.VO0Sm/2Lf3Y9zroRBg2ET8L6t5ja1n0rS');*/
insert into users(name,email,password) values
('Isela Huanca','ise@gmail.com','$2a$10$qAVkPAIHnamNzbDeMb94t.em.plQpqP8s/Bwy.LrZsCOqnWveg7He'),
('Mary Choque','mary@gmail.com','$2a$10$pyLUOKvtKEgB2PUyvCT.VO0Sm/2Lf3Y9zroRBg2ET8L6t5ja1n0rS');

INSERT INTO proveedores(nombre) values
('LIC'),
('FENIX'),
('ASATEX');

INSERT INTO sucursales(direccion,zona,celular) VALUES 
('Local D4-E4 Shopping Miami','Feria Barrio Lindo','76627246'),
('Local F3-F4 Shopping Miami','Feria Barrio Lindo','73143557'),
('C/Parabano #315','Comercial Ramada','72170941');

INSERT INTO almacenes(direccion,zona,celular) VALUES
('C/Cabo Quiroga #44','Ex Feria Barrio Lindo','70992450'),
('C/Ambaibos #243','Plan 3000 B/Cupesi','75076077');

/*INSERT INTO telas(nombre,precioxmen, precioxmay, precioxrollo,precioxcompra,idproveedor) VALUES
('Razo Suizo Licra', 30, 25, 23, 20,1),
('Razo Suizo Rigido', 25, 20, 18, 15,1),
('Lipiur 3D', 160, 130, 110, 100,1),
('Mostazilla', 180, 150, 140, 110,1),
('Lipiur', 130, 100, 85, 70,1),
('Razo Doble Ancho', 20, 15, 14, 11,1),
('Razo', 10, 8, 6, 5.5,1),
('Tull Ramas',65,55,50, 40,1),
('Blonda 15',15,12,10,8,1),
('Blonda 20',20,15,12, 10,1),
('Blonda 50',50,45,43, 35,1),
('Tull Ilusion',10,8,6, 5.5,1),
('Tull Licra',20,16,15,8,1),
('Tull Frances',25,20,18,16,1),
('Can Can',20,17,14,12,1),
('Tull Maripozas LPZ',65,50,45,40,1),
('Tull Americano', 20,17,15,11.5,1),
('lipiur AG', 130,100,85,62,1),
('Tull Perlado', 100,80,70,46,1),
('Bonye', 10,8,6,5.5,1),
('Tull Brilloso',23,18,15,12,1),
('Lipiur IH',130,100,85,57,1),
('Lipiur Blonda',60,50,45,40,1),
('gasa',15,12,10,9,1),
('Tull Ramas Ramada', 65,55,50,40,1);*/
 
INSERT INTO telas(nombre, precioxmen, precioxmay, precioxrollo,idproveedor) VALUES
('Razo Suizo Licra', 30, 25, 23, 1),
('Razo Suizo Rigido', 25, 20, 18, 1),
('Lipiur 3D', 160, 130, 110, 1),
('Mostazilla', 180, 150, 140, 1),
('Lipiur', 130, 100, 85, 1),
('Razo Doble Ancho', 20, 15, 14, 1),
('Razo', 10, 8, 6,1),
('Tull Ramas',65,55,50, 1),
('Blonda 15',15,12,10,1),
('Blonda 20',20,15,12, 1),
('Blonda 50',50,45,43, 1),
('Tull Ilusion',10,8,6,3),
('Tull Licra',20,16,15,3),
('Tull Frances',25,20,18,2),
('Can Can',20,17,14,2),
('Tull Maripozas LPZ',65,50,45,2),
('Tull Americano', 20,17,15,2),
('lipiur AG', 130,100,85,2),
('Tull Perlado', 100,80,70,2),
('Bonye', 10,8,6,2),
('Tull Brilloso',23,18,15,3),
('Lipiur IH',130,100,85,3),
('Lipiur Blonda',60,50,45,3),
('gasa',15,12,10,3),
('Tull Ramas Ramada', 65,55,50,3);

 INSERT INTO tipogastos(descripcion) VALUES
 ('Transporte Terrestre'),
 ('Transporte Aereo'),
 ('Transporte Maritimo'),
 ('Nacionalizacion'),
 ('Poliza'),
 ('Almacenaje'),
 ('Seguros');


insert into compras(fecha,total,totalag,idproveedor) values
('01-05-2024',4600,0,1),
('01-06-2024',4400,0,1);

 insert into det_compras(idtela,idcompra,cantidad,precio,total,totalag) values
(9,1,200,8,1600,0),
(10,1,300,10,3000,0),
(9,2,300,8,2400,0),
(10,2,200,10,2000,0);

insert into recepciones(idcompra,idalmacen,idusuario,fecha,tiempo) values
(1,1,1,'10-05-2024',10),
(2,1,1,'12-06-2024',12);

insert into ventas(fecha,total,ganancias,idsucursal,idusuario) values
('11-05-2024',345,115,1,1),
('12-05-2024',345,115,1,1),
('13-05-2024',345,115,1,1),
('14-05-2024',345,115,1,1),
('15-05-2024',345,115,1,1),
('16-05-2024',345,115,1,1),
('17-05-2024',345,115,1,1),
('18-05-2024',345,115,1,1),
('19-05-2024',345,115,1,1),
('20-05-2024',345,115,1,1),
('30-05-2024',3450,1150,2,2),
('13-06-2024',330,110,1,1),
('14-06-2024',330,110,1,1),
('15-06-2024',330,110,1,1),
('16-06-2024',330,110,1,1),
('17-06-2024',330,110,1,1),
('18-06-2024',330,110,1,1),
('19-06-2024',330,110,1,1),
('20-06-2024',330,110,1,1),
('21-06-2024',330,110,1,1),
('22-06-2024',330,110,1,1),
('27-06-2024',3300,1100,2,2);

insert into det_ventas(idventa,idtela,precio,cantidad,total,ganancias) values
(1,9,12,10,120,40),
(1,10,15,15,225,75),
(2,9,12,10,120,40),
(2,10,15,15,225,75),
(3,9,12,10,120,40),
(3,10,15,15,225,75),
(4,9,12,10,120,40),
(4,10,15,15,225,75),
(5,9,12,10,120,40),
(5,10,15,15,225,75),
(6,9,12,10,120,40),
(6,10,15,15,225,75),
(7,9,12,10,120,40),
(7,10,15,15,225,75),
(8,9,12,10,120,40),
(8,10,15,15,225,75),
(9,9,12,10,120,40),
(9,10,15,15,225,75),
(10,9,12,10,120,40),
(10,10,15,15,225,75),
(11,9,12,100,1200,400),
(11,10,15,150,2250,750),
(12,9,12,15,180,60),
(12,10,15,10,150,50),
(13,9,12,15,180,60),
(13,10,15,10,150,50),
(14,9,12,15,180,60),
(14,10,15,10,150,50),
(15,9,12,15,180,60),
(15,10,15,10,150,50),
(16,9,12,15,180,60),
(16,10,15,10,150,50),
(17,9,12,15,180,60),
(17,10,15,10,150,50),
(18,9,12,15,180,60),
(18,10,15,10,150,50),
(19,9,12,15,180,60),
(19,10,15,10,150,50),
(20,9,12,15,180,60),
(20,10,15,10,150,50),
(21,9,12,15,180,60),
(21,10,15,10,150,50),
(22,9,12,150,1800,600),
(22,10,15,100,1500,500);
