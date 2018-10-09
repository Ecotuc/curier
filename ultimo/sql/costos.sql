CREATE TABLE public.costos
(
    idd character(5) NOT NULL,
    ido character(5) NOT NULL,
    destino character(20) NOT NULL,
    origen character(20) NOT NULL,
    precio character(2) NOT NULL,
    CONSTRAINT costos_pkey PRIMARY KEY (idd, ido)
);