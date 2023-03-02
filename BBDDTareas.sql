USE tareas;

-- El orden de borrado es importante
DROP TABLE if exists TAREA;
DROP TABLE if exists LISTA;
DROP TABLE if exists USUARIO;

-- Tabla de usuarios
CREATE TABLE USUARIO(
ID integer primary key,
USERNAME VARCHAR(35),
PASSWORD VARCHAR(100)
);

-- Tabla de listas de tareas
CREATE TABLE LISTA(
ID integer primary key,
NOMBRE VARCHAR(70),
USUARIO_ID INTEGER,
CONSTRAINT FK_LISTA_USUARIO FOREIGN KEY (USUARIO_ID) REFERENCES USUARIO(ID)
);

-- Tabla de tareas
CREATE TABLE TAREA(
ID integer primary key,
DESCRIPCION VARCHAR(70),
FECHA_VENCIMIENTO DATE,
REALIZADA BOOLEAN,
LISTA_ID INTEGER,
CONSTRAINT FK_TAREA_LISTA FOREIGN KEY (LISTA_ID) REFERENCES LISTA(ID)
);

--INSERTS
INSERT INTO USUARIO (ID, USERNAME, PASSWORD) VALUES (1, 'usuario1', '1234');
INSERT INTO USUARIO (ID, USERNAME, PASSWORD) VALUES (2, 'usuario2', 'abcd');

INSERT INTO LISTA (ID, NOMBRE, USUARIO_ID) VALUES (1, 'Lista de compras', 1);
INSERT INTO LISTA (ID, NOMBRE, USUARIO_ID) VALUES (2, 'Tareas del hogar', 1);
INSERT INTO LISTA (ID, NOMBRE, USUARIO_ID) VALUES (3, 'Tareas de trabajo', 2);

INSERT INTO TAREA (ID, DESCRIPCION, FECHA_VENCIMIENTO, REALIZADA, LISTA_ID) VALUES (1, 'Comprar leche', '2023-02-28', false, 1);
INSERT INTO TAREA (ID, DESCRIPCION, FECHA_VENCIMIENTO, REALIZADA, LISTA_ID) VALUES (2, 'Lavar los platos', '2023-02-20', false, 2);
INSERT INTO TAREA (ID, DESCRIPCION, FECHA_VENCIMIENTO, REALIZADA, LISTA_ID) VALUES (3, 'Preparar la presentaciÃ³n', '2023-03-01', false, 3);