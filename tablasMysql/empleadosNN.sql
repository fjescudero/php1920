create database empleadosNN;

create table departamento (cod_dpto varchar(4), nombre_dpto varchar(40));

Alter table departamento add constraint pk_departamento primary key (cod_dpto);

create table empleado (dni varchar(9), nombre varchar(40), apellidos varchar(40), fecha_nac date, salario double);

Alter table empleado add constraint pk_empleado primary key (dni);

create table emple_depart(dni varchar(9), cod_dpto varchar(4), fecha_ini datetime, fecha_fin datetime);

Alter table emple_depart add constraint pk_emple_depart primary key (dni,cod_dpto,fecha_ini,fecha_fin);

Alter table emple_depart add constraint fk_empledepart_dni foreign key (dni) references empleado(dni);

Alter table emple_depart add constraint fj_empledepart_cd foreign key (cod_dpto) references departamento(cod_dpto);