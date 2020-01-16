use empleadosNN;

insert into departamento (cod_dpto, nombre_dpto) values ('D001','COMPRAS');

insert into departamento (cod_dpto, nombre_dpto) values ('D002','RRHH');

COMMIT;

insert into empleado (dni, nombre, apellidos, fecha_nac, salario)

values ('111A','ALFONSO','REBOLLEDA SANCHEZ','2000-01-01',50000);

insert into empleado (dni, nombre, apellidos, fecha_nac, salario) 

values ('111B','FELIX','GOMEZ','1999-01-01',80000);

COMMIT;

insert into emple_depart (dni,cod_dpto,fecha_ini,fecha_fin) 
values ('111A','D001','2000-01-01','2000-01-03');

insert into emple_depart (dni,cod_dpto,fecha_ini,fecha_fin) 
values ('111B','D002','2000-01-01','2000-01-03');

COMMIT;




