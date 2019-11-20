create database tpcines;
use tpcines;
#drop database tpcines;

create table paises(
id_pais int auto_increment not null,
nombre_pais varchar(50),
constraint pk_paises primary key (id_pais)
);

create table provincias(
id_provincia int auto_increment not null,
nombre_provincia varchar(50),
id_pais1 int not null,
constraint fk_paises foreign key (id_pais1) references paises(id_pais)  on delete cascade,
constraint pk_provincias primary key(id_provincia)
);


create table ciudades(
id_ciudad int auto_increment not null,
nombre_ciudad varchar(50),
id_provincia1 int not null,
constraint fk_provincia foreign key(id_provincia1) references provincias(id_provincia)  on delete cascade,
constraint pk_cuidades primary key(id_ciudad)
);


create table cines(
id_cine int auto_increment not null,
nombre_cine varchar(50) not null,
direccion varchar(80) not null,
valor_entrada int not null,
id_ciudad1 int not null,
constraint fk_ciudad1 foreign key (id_ciudad1) references ciudades(id_ciudad)  on delete cascade,
constraint pk_cine primary key(id_cine)
);

create table salas(
id_sala int auto_increment not null,
id_cine1 int not null,
nombre_sala varchar(30) not null,
capacidad int not null,
is3d varchar(10) not null,
constraint fk_cine foreign key(id_cine1)references cines(id_cine)  on delete cascade,
constraint pk_salas primary key(id_sala)
);

create table peliculas(
	id_pelicula int not null unique,
    title varchar(100) not null,
    releaseDate date not null,
    overview varchar(1000),
    posterPath varchar(200),
    duration int,
    constraint pk_pelicula primary key(id_pelicula)
);

create table generos (
	id_genero int not null unique,
    nombre varchar(100),
    constraint pk_genero primary key(id_genero)
);
create table generosXpelicula (
	id_generoxpelicula varchar(100) not null ,
    id_pelicula int not null,
    id_genero int not null,
    constraint fk_pelicula foreign key(id_pelicula) references peliculas(id_pelicula) on delete cascade,
    constraint fk_genero foreign key(id_genero) references generos(id_genero)  on delete cascade,
    constraint pk_generosXpelicula primary key(id_generoxpelicula)
);

create table funciones(
id_funcion int auto_increment not null,
id_sala2 int not null,
id_pelicula1 int not null,
id_cine2 int not null,
lenguaje varchar(20) not null,
fecha date not null,
hora time not null,
constraint fk_salas1 foreign key(id_sala2) references salas(id_sala) on delete cascade,
constraint fk_cines2 foreign key(id_cine2) references cines(id_cine) on delete cascade,
constraint pk_funciones primary key(id_funcion)
);
create table asientos(
id_asiento int auto_increment unique,
nro_asiento int not null,
id_sala1 int not null,
constraint fk_salas foreign key(id_sala1) references salas(id_sala)  on delete cascade,
constraint pk_asientos primary key(id_asiento)
);
create table asientoXfuncion (
	id_asientoXfuncion int auto_increment unique,
    id_asiento2 int not null,
    id_funcion2 int not null,
    ocupada boolean not null,
	constraint fk_asiento foreign key(id_asiento2) references asientos(id_asiento)  on delete cascade,
    constraint fk_funcion foreign key(id_funcion2) references funciones(id_funcion)  on delete cascade,
	constraint pk_asientoXfuncion primary key(id_asientoXfuncion)
);


create table roles(
id_rol int auto_increment not null,
nombre_rol varchar(30),
constraint pk_rol primary key(id_rol) 
);

create table usuarios(
id_usuario int auto_increment not null,
nombre_user varchar(20) not null,
fecha_nac date not null,
email varchar(50) not null,
pass varchar(50) not null,
id_rol1 int not null,
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
constraint fk_medioPago foreign key(id_medioPago1) references medio_pagos(id_medioPago) ,
constraint pk_factura primary key(id_factura)
);

create table entradas(
id_entrada int auto_increment not null,
nro_asiento1 int not null,
id_funcion1 int not null,
id_usuario1 int not null,
id_factura1 int not null,
constraint fk_asiento_ foreign key (nro_asiento1) references asientos(id_asiento),
constraint fk_funcion_ foreign key (id_funcion1) references funciones(id_funcion),
constraint fk_usuario_ foreign key (id_usuario1) references usuarios(id_usuario),
constraint fk_factura_ foreign key (id_factura1) references facturas(id_factura),
constraint pk_entrada_ primary key (id_entrada)
);

#################INSERTAMOS DATOS#####################
#PAISES
insert into paises(nombre_pais) values('Argentina');
#PRIVINCIAS
insert into provincias(nombre_provincia,id_pais1) values('Buenos aires',1);
#CIUDADES
insert into ciudades(nombre_ciudad,id_provincia1) values('Mar del Plata',1);
insert into ciudades(nombre_ciudad,id_provincia1) values('Miramar',1);
# CINES
#ROLES
insert into roles(nombre_rol)values("Admin");
insert into roles(nombre_rol)values("Comun");
#USUARIOS
insert into usuarios(nombre_user,fecha_nac,email,pass,id_rol1) values("Jorge",'1995-01-29','jorge@utn','asd123',1);
insert into usuarios(nombre_user,fecha_nac,email,pass,id_rol1) values("Ivan",'1995-01-29','ivan@utn','asd123','1');
insert into usuarios(nombre_user,fecha_nac,email,pass,id_rol1) values("Ivaasdn",'1995-01-29','ivsdasan@utn','asd123','1');



/*select * from funciones;
select * from asientoxfuncion;
select * from generos;
select * from generosxpelicula;
select * from salas;
select * from cidades;*/ 
