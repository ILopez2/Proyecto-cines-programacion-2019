create database cines;
use cines;

create table paises(
id_pais int auto_increment not null,
nombre_pais varchar(50),
constraint pk_paises primary key (id_pais)
);
insert into paises(nombre_pais) values('argentina');

create table provincias(
id_provincia int auto_increment not null,
nombre_provincia varchar(50),
id_pais1 int not null,
constraint fk_paises foreign key (id_pais1) references paises(id_pais),
constraint pk_provincias primary key(id_provincia)
);
insert into provincias(nombre_provincia,id_pais1) values('Buenos aires',1);

create table ciudades(
id_ciudad int auto_increment not null,
nombre_ciudad varchar(50),
id_provincia1 int not null,
constraint fk_provincia foreign key(id_provincia1) references provincias(id_provincia),
constraint pk_cuidades primary key(id_ciudad)
);
insert into ciudades(nombre_ciudad,id_provincia1) values('Mar del Plata',1);

create table cines(
id_cine int auto_increment not null,
nombre_cine varchar(50),
direccion varchar(80),
valor_entrada int not null,
id_ciudad1 int not null,
constraint fk_ciudad1 foreign key (id_ciudad1) references ciudades(id_ciudad),
constraint pk_cine primary key(id_cine)
);

create table salas(
id_sala int auto_increment not null,
id_cine1 int not null,
nombre_sala varchar(30),
constraint fk_cine foreign key(id_cine1)references cines(id_cine),
constraint pk_salas primary key(id_sala)
);

#agrego capacidad y is3D ya que no lo contemplamos
alter table salas add (capacidad int not null,is3D boolean);
describe salas;

create table asientos(
nro_asiento int unique not null,
id_sala1 int not null,
tipo_de_asiento varchar(20),
constraint fk_salas foreign key(id_sala1) references salas(id_sala),
constraint pk_asientos primary key(nro_asiento)
);

create table tipoPeliculas(
id_tipoPelicula int auto_increment not null,
genero varchar(30),
descripcion varchar(300),
constraint pk_tipoPelicula primary key(id_tipoPelicula)
);

create table peliculas(
id_pelicula int auto_increment not null,
id_tipoPelicula1 int not null,
nombre_pelicula varchar(30),
descripcion varchar(300),
constraint fk_tipoPelicula foreign key(id_tipoPelicula1)references tipoPeliculas(id_tipoPelicula),
constraint pk_peliculas primary key(id_pelicula)
);

create table funciones(
id_funcion int auto_increment not null,
id_sala2 int not null,
id_pelicula1 int not null,
fecha_y_horario date,
constraint fk_salas1 foreign key(id_sala2) references salas(id_sala),
constraint fk_peliculas foreign key(id_pelicula1) references peliculas(id_pelicula),
constraint pk_funciones primary key(id_funcion)
);

create table clientes(
dni int unique not null,
nombre_cliente varchar(60),
fecha_nac date,
constraint pk_clientes primary key (dni)
);

create table roles(
id_rol int auto_increment not null,
nombre_rol varchar(30),
constraint pk_rol primary key(id_rol) 
);

create table usuarios(
id_usuario int auto_increment not null,
email varchar(50),
pass varchar(50),
dni1 int not null,
id_rol1 int not null,
constraint fk_cliente foreign key(dni1) references clientes(dni),
constraint fk_roles foreign key(id_rol1) references roles(id_rol),
constraint pk_users primary key(id_usuario)
);

create table medio_pagos(
id_medioPago int auto_increment not null,
medio_de_pago int not null,
constraint pk_medioPago primary key (id_medioPago)
);

create table facturas(
id_factura int auto_increment not null,
id_medioPago1 int not null,
monto int not null,
descuento float not null,
constraint fk_medioPago foreign key(id_medioPago1) references medio_pagos(id_medioPago),
constraint pk_factura primary key(id_factura)
);

create table entradas(
id_entrada int auto_increment not null,
nro_asiento1 int not null,
id_funcion1 int not null,
id_usuario1 int not null,
id_factura1 int not null,
constraint fk_asiento_ foreign key (nro_asiento1) references asientos(nro_asiento),
constraint fk_funcion_ foreign key (id_funcion1) references funciones(id_funcion),
constraint fk_usuario_ foreign key (id_usuario1) references usuarios(id_usuario),
constraint fk_factura_ foreign key (id_factura1) references facturas(id_factura),
constraint pk_entrada_ primary key (id_entrada)
);

# agrego 1 cine para mostrar
insert into cines(nombre_cine,direccion,valor_entrada,id_ciudad1)values("Del paseo","Ayacucho 12312",200,1);
insert into cines(nombre_cine,direccion,valor_entrada,id_ciudad1)values("Ambassador","Cordoba",300,1);
insert into cines(nombre_cine,direccion,valor_entrada,id_ciudad1)values("Aldrey","not cordoba",300,1);
insert into cines(nombre_cine,direccion,valor_entrada,id_ciudad1)values("Ambasarasa","Cba",300,1);

select * from cines;