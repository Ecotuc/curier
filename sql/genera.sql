CREATE TABLE public.genera
(
    orden integer NOT NULL,
    nombre character(20) NOT NULL,
    CONSTRAINT genera_pkey PRIMARY KEY (orden, nombre),
    CONSTRAINT genera_nombre_fkey FOREIGN KEY (nombre)
        REFERENCES public.tienda (nombre) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);