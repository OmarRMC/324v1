-- Active: 1713682591528@@localhost@3306
CREATE DATABASE 
    DEFAULT CHARACTER SET = 'utf8mb4';

 CREATE TABLE Persona (
    ci INT NOT NULL PRIMARY KEY, 
    nombre VARCHAR(50) not null ,
    ap_paterno VARCHAR(30) not null ,
    ap_materno VARCHAR(30), 
    dirección VARCHAR(100), 
    correo VARCHAR(50), 
    telefono INT 
);

ALTER TABLE persona
CHANGE dirección direccion VARCHAR(100);
ALTER TABLE persona
ADD borrado TINYINT NOT NULL DEFAULT  0

select * from persona 

UPDATE persona SET borrado=0 ;
UPDATE Cuenta SET borrado=0 ;

UPDATE persona SET borrado=1 WHERE ci=123


describe  persona

CREATE TABLE Cuenta (
    nro_cuenta INT AUTO_INCREMENT PRIMARY KEY,
    tipo_Cuenta VARCHAR(20),
    saldo DECIMAL(10, 2),
    ci INT,
    FOREIGN KEY (ci) REFERENCES Persona(ci)
);
ALTER TABLE Cuenta
ADD borrado TINYINT NOT NULL DEFAULT  0

select * from cuenta ; 


INSERT into cuenta (tipo_Cuenta, saldo , ci) values ("Ahorro",100.5,132)
INSERT into cuenta (tipo_Cuenta, saldo , ci) values ("Ahorro",10,123)


select * from cuenta c , persona p where c.ci=p.ci

select * from persona 


select * from persona 
CREATE TABLE Transaccion (
    id_transacción INT AUTO_INCREMENT PRIMARY KEY,
    tipo_Transacción VARCHAR(20) not null ,
    monto DECIMAL(10, 2),
    fecha DATE,
    nro_cuenta INT,
    FOREIGN KEY (nro_cuenta) REFERENCES Cuenta(nro_cuenta)
);


-- Consultas 
SELECT * from persona