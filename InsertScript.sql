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


INSERT INTO usuarios(name,email,password) VALUES 
('Isela Huanca','ise@gmail.com','$2a$10$qAVkPAIHnamNzbDeMb94t.em.plQpqP8s/Bwy.LrZsCOqnWveg7He'),
('Mary Choque','mary@gmail.com','$2a$10$pyLUOKvtKEgB2PUyvCT.VO0Sm/2Lf3Y9zroRBg2ET8L6t5ja1n0rS');

INSERT INTO proveedores(nombre) values
('LIC');

INSERT INTO sucursales(direccion,zona,celular) VALUES 
('Local D4-E4 Shopping Miami','Feria Barrio Lindo','76627246'),
('Local F3-F4 Shopping Miami','Feria Barrio Lindo','73143557'),
('C/Parabano #315','Comercial Ramada','72170941');

INSERT INTO almacenes(direccion,celular) VALUES
('C/Cabo Quiroga #44','Ex Feria Barrio Lindo','70992450'),
('C/Ambaibos #243','Plan 3000 B/Cupesi','75076077');

INSERT INTO telas(nombre,precxmen, precxmay, precxrollo,precxcompra,idproveedor) VALUES
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
('Tull Ramas Ramada', 65,55,50,40,1);
 
 