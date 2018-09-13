create table ordenes(
	orden integer,
	status integer,
	destinatario character (20),
	direccion character(20),
	destino character(20) not null,
	origen character(20) not null,
	primary key(orden),
	foreign key(destino, origen) references costos
);