create table genera(
	orden integer,
	nombre character(20),
	primary key (orden, nombre),
	foreign key (orden) references ordenes,
	foreign key (nombre) references tienda
)