USE tareas;

-- El orden de borrado es importante
DROP TABLE if exists TAREA;
DROP TABLE if exists LISTA;
DROP TABLE if exists USUARIO;
DROP TABLE if exists SESSION;


-- Tabla de usuarios
CREATE TABLE USUARIO(
ID integer primary key,
USERNAME VARCHAR(35),
PASSWORD VARCHAR(100)
);

-- Tabla sessión de usuarios
CREATE TABLE SESSION(
ID integer primary key,
USER_ID INTEGER,
TOKEN VARCHAR(100),
EXPIRATION_DATE TIMESTAMP,
CONSTRAINT FK_SESSION_USUARIO FOREIGN KEY (USER_ID) REFERENCES USUARIO(ID)
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
INSERT INTO USUARIO (ID, USERNAME, PASSWORD) VALUES
(1, 'juanperez', 'password1'),
(2, 'mariagarcia', 'password2'),
(3, 'pedrosanchez', 'password3'),
(4, 'anacastro', 'password4'),
(5, 'carlosgomez', 'password5'),
(6, 'luciacastillo', 'password6'),
(7, 'davidsantos', 'password7'),
(8, 'elenamartinez', 'password8'),
(9, 'pablojimenez', 'password9'),
(10, 'lauragomez', 'password10');

INSERT INTO LISTA (ID, NOMBRE, USUARIO_ID) VALUES
(1, 'Lista de compras', 1),
(2, 'Tareas del hogar', 1),
(3, 'Proyectos de trabajo', 2),
(4, 'Lista de pendientes', 3),
(5, 'Ideas de viaje', 4),
(6, 'Tareas del jardín', 5),
(7, 'Comidas de la semana', 6),
(8, 'Lista de libros por leer', 7),
(9, 'Tareas de la universidad', 8),
(10, 'Ideas de regalos', 9);

INSERT INTO TAREA (ID, DESCRIPCION, FECHA_VENCIMIENTO, REALIZADA, LISTA_ID) VALUES
(1, 'Comprar leche', '2023-03-15', 0, 1),
(2, 'Lavar los platos', '2023-03-20', 0, 2),
(3, 'Presentación para cliente A', '2023-03-31', 0, 3),
(4, 'Llamar al banco', '2023-03-12', 0, 4),
(5, 'Investigar sobre pasajes a Europa', '2023-03-25', 0, 5),
(6, 'Cortar el césped', '2023-03-18', 0, 6),
(7, 'Preparar comida para lunes', '2023-03-13', 0, 7),
(8, 'Leer "Cien años de soledad"', '2023-03-24', 0, 8),
(9, 'Entregar ensayo de historia', '2023-04-01', 0, 9),
(10, 'Comprar regalo para cumpleaños de mamá', '2023-03-21', 0, 10),
(11, 'Comprar pan', '2023-03-15', 0, 1),
(12, 'Barrer el suelo', '2023-03-20', 0, 2),
(13, 'Revisar documento para cliente B', '2023-03-31', 0, 3),
(14, 'Pagar factura de internet', '2023-03-12', 0, 4),
(15, 'Buscar alojamiento en París', '2023-03-25', 0, 5),
(16, 'Podar los arbustos', '2023-03-18', 0, 6),
(17, 'Preparar comida para martes', '2023-03-14', 0, 7),
(18, 'Sacar la basura', '2023-03-18', 0, 2),
(19, 'Revisar informe financiero', '2023-03-25', 0, 3),
(20, 'Comprar boletos de avión', '2023-03-28', 0, 5),
(21, 'Sembrar plantas nuevas', '2023-03-22', 0, 6),
(22, 'Preparar comida para miércoles', '2023-03-15', 0, 7),
(23, 'Leer "El gran Gatsby"', '2023-03-27', 0, 8),
(24, 'Estudiar para examen de matemáticas', '2023-03-30', 0, 9),
(25, 'Comprar regalo para aniversario de bodas', '2023-03-29', 0, 10);