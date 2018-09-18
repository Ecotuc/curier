CREATE TABLE public.users
(
    username character(20) NOT NULL,
    password character(30) NOT NULL,
    CONSTRAINT users_pkey PRIMARY KEY (username)
);

INSERT INTO users(username, password) VALUES ("admin", "1998");