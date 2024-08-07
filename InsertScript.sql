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
UPDATE users
SET metas=5000
WHERE id = 1;

UPDATE users
SET metas=3500
WHERE id = 2;

INSERT INTO proveedores(nombre) values
('LIC'),
('FENIX'),
('ASATEX');

INSERT INTO sucursales(direccion,zona,celular) VALUES 
--('Local D4-E4 Shopping Miami','Feria Barrio Lindo','76627246'),
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
('Blonda 50',50,45,43, 1);
/*('Tull Ilusion',10,8,6,3),
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
('Tull Ramas Ramada', 65,55,50,3);]*/

 INSERT INTO tipogastos(descripcion) VALUES
 ('Transporte Terrestre'),
 ('Transporte Aereo'),
 ('Transporte Maritimo'),
 ('Nacionalizacion'),
 ('Poliza'),
 ('Almacenaje'),
 ('Seguros');


insert into compras(fecha,total,totalag,idproveedor) values
('01-05-2024',5400,0,1),
('01-06-2024',5800,0,1);

 insert into det_compras(idtela,idcompra,cantidad,precio,total,totalag) values
(9,1,300,8,2400,0),
(10,1,300,10,3000,0),
(9,2,350,8,2800,0),
(10,2,300,10,3000,0);

insert into recepciones(idcompra,idalmacen,idusuario,fecha,tiempo) values
(1,1,1,'10-05-2024',10),
(2,1,1,'12-06-2024',12);

insert into ventas(fecha,total,ganancias,idsucursal,idusuario) values
('11-05-2024',405,135,1,1),
('12-05-2024',405,135,1,1),
('13-05-2024',405,135,1,1),
('14-05-2024',405,135,1,1),
('15-05-2024',405,135,1,1),
('16-05-2024',405,135,1,1),
('17-05-2024',405,135,1,1),
('18-05-2024',405,135,1,1),
('19-05-2024',405,135,1,1),
('20-05-2024',405,135,1,1),
('30-05-2024',3300,600,2,2),
('13-06-2024',465,155,1,1),
('14-06-2024',465,155,1,1),
('15-06-2024',465,155,1,1),
('16-06-2024',465,155,1,1),
('17-06-2024',465,155,1,1),
('18-06-2024',465,155,1,1),
('19-06-2024',465,155,1,1),
('20-06-2024',465,155,1,1),
('21-06-2024',465,155,1,1),
('22-06-2024',465,155,1,1),
('27-06-2024',3300,600,2,2),
('01-07-2024',1250,250,1,1),
('08-07-2024',600,150,1,1),
('01-07-2024',650,150,2,2),
('08-07-2024',400,120,2,2),
('15-06-2024',225,60,2,2);

insert into det_ventas(idventa,idtela,precio,cantidad,total,ganancias) values
(1,9,12,15,180,60),
(1,10,15,15,225,75),
(2,9,12,15,180,60),
(2,10,15,15,225,75),
(3,9,12,15,180,60),
(3,10,15,15,225,75),
(4,9,12,15,180,60),
(4,10,15,15,225,75),
(5,9,12,15,180,60),
(5,10,15,15,225,75),
(6,9,12,15,180,60),
(6,10,15,15,225,75),
(7,9,12,15,180,60),
(7,10,15,15,225,75),
(8,9,12,15,180,60),
(8,10,15,15,225,75),
(9,9,12,15,180,60),
(9,10,15,15,225,75),
(10,9,12,15,180,60),
(10,10,15,15,225,75),
(11,9,10,150,1500,300),
(11,10,12,150,1800,300),
(12,9,12,20,240,80),
(12,10,15,15,225,75),
(13,9,12,20,240,80),
(13,10,15,15,225,75),
(14,9,12,20,240,80),
(14,10,15,15,225,75),
(15,9,12,20,240,80),
(15,10,15,15,225,75),
(16,9,12,20,240,80),
(16,10,15,15,225,75),
(17,9,12,20,240,80),
(17,10,15,15,225,75),
(18,9,12,20,240,80),
(18,10,15,15,225,75),
(19,9,12,20,240,80),
(19,10,15,15,225,75),
(20,9,12,20,240,80),
(20,10,15,15,225,75),
(21,9,12,20,240,80),
(21,10,15,15,225,75),
(22,9,10,150,1500,300),
(22,10,12,150,1800,300),
(23,1,25,50,1250,250),
(24,2,20,30,600,150),
(25,3,130,5,650,150),
(26,5,100,4,400,120),
(27,6,15,15,225,60);


/*SELECT 
    telas_sucursales.idtela, 
    t.nombre as tela, 
    telas_sucursales.idsucursal, 
    s.direccion as sucursal, 
    COALESCE(SUM(dv.cantidad), 0) as demanda
FROM 
    (SELECT 
        t.id as idtela, 
        s.id as idsucursal 
    FROM 
        telas t, 
        sucursales s) telas_sucursales
LEFT JOIN ventas v ON v.idsucursal = telas_sucursales.idsucursal 
                    AND v.fecha BETWEEN '01-06-2024' AND '30-07-2024'
LEFT JOIN det_ventas dv ON dv.idventa = v.id 
                         AND dv.idtela = telas_sucursales.idtela
LEFT JOIN sucursales s ON s.id = telas_sucursales.idsucursal
LEFT JOIN telas t ON t.id = telas_sucursales.idtela
GROUP BY 
    telas_sucursales.idtela, 
    t.nombre, 
    telas_sucursales.idsucursal, 
    s.direccion
ORDER BY 
    telas_sucursales.idtela, 
    telas_sucursales.idsucursal;   */  


    
