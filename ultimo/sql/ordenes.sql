CREATE TABLE public.ordenes
(
    orden serial NOT NULL,
    destinatario character(20) NOT NULL,
    direccion character(50) NOT NULL,
    destino character(20) NOT NULL,
    origen character(20) NOT NULL,
    idd character(5) NOT NULL,
    ido character(5) NOT NULL,
    status character(1) NOT NULL,
    tienda character(20) NOT NULL,
    CONSTRAINT ordenes_pkey PRIMARY KEY (orden),
    CONSTRAINT ordenes_idd_fkey FOREIGN KEY (idd, ido)
        REFERENCES public.costos (idd, ido) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);