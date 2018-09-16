CREATE TABLE costos
(
    destino character(20) NOT NULL,
    origen character(20) NOT NULL,
    idd integer NOT NULL,
    precio integer NOT NULL,
    PRIMARY KEY (destino, origen)
)
