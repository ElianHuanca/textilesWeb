CREATE OR REPLACE FUNCTION insertar_en_sucursales_almacenes()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO sucursalesTelas (idsucursal, idtela)
    SELECT id, NEW.id
    FROM sucursales;
    RETURN NEW;
   
   INSERT INTO almacenesTelas (idalmacen, idtela)
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
    INSERT INTO sucursalesTelas (idsucursal, idtela)
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
    INSERT INTO almacenesTelas (idalmacen, idtela)
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

INSERT INTO sucursales(nombre) VALUES 
('Local D4-E4'),
('Local F3-F4'),
('Ramada Parabano');

INSERT INTO almacenes(nombre) VALUES
('Feria Barrio Lindo'),
('Plan 3000');

INSERT INTO telas(nombre,idproveedor) VALUES
('Razo Suizo Licra',1),
('Razo Suizo Rigido',1),
('Lipiur 3D', 1),
('Mostazilla', 1),
('Lipiur', 1),
('Razo Doble Ancho', 1),
('Razo',1),
('Tull Ramas',1),
('Blonda 15',1),
('Blonda 20',1),
('Blonda 50',1),
('Tull Ilusion',1),
('Tull Licra',1),
('Tull Frances',1),
('Can Can',1),
('Tull Maripozas LPZ',1),
('Tull Americano',1),
('lipiur AG',1),
('Tull Perlado', 1),
('Bonye',1),
('Tull Brilloso',1),
('Lipiur IH',1),
('Lipiur Blonda',1),
('gasa',1),
('Tull Ramas Ramada',1);
 
 