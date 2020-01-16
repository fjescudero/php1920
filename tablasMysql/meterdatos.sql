use empleados1N;

insert into departamento (cod_dpto, nombre) values ('D001','COMPRAS');

insert into departamento (cod_dpto, nombre) values ('D002','RRHH');

COMMIT;

insert into empleado (dni, nombre, apellidos, fecha_nac, salario, cod_dpto)

values ('111A','ALFONSO','REBOLLEDA SANCHEZ','2000-01-01',50000,'D001');

insert into empleado (dni, nombre, apellidos, fecha_nac, salario, cod_dpto) 

values ('111A','FELIX','GOMEZ','1999-01-01',80000,'D002');

COMMIT;