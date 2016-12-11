BEGIN;

DROP SCHEMA IF EXISTS udfsala CASCADE ;

CREATE SCHEMA udfsala;

CREATE TABLE udfsala.salas (
cod_sala serial NOT NULL,
nom_sala character varying(10) NOT NULL,
qtd_assentos smallint NOT NULL,
qtd_max_assentos smallint,
campus_sala character varying(4) NOT NULL,
CONSTRAINT pk_cod_sala PRIMARY KEY(cod_sala)
);


CREATE TABLE udfsala.ofertas (
cod_oferta serial NOT NULL,
nom_oferta character varying(20) NOT NULL,
cod_disciplina bigint,
nom_disciplina character varying(1000) NOT NULL,
nom_curso character varying(1000) NOT NULL,
nom_horario character varying(6) NOT NULL,
nom_periodo character varying(10) NOT NULL,
nom_professor character varying(1000),
nom_campus character varying(4) NOT NULL,
total_matriculados integer,
ser integer,
carga_horaria integer,
cod_sala bigint,
CONSTRAINT pk_cod_oferta PRIMARY KEY(cod_oferta),
CONSTRAINT fk_oferta_sala FOREIGN KEY (cod_sala)
	REFERENCES udfsala.salas (cod_sala) ON UPDATE CASCADE ON DELETE SET NULL
);


CREATE TABLE udfsala.reservas (
cod_reserva serial NOT NULL,
obs_reserva character varying(1000) NOT NULL,
nom_horario character varying(6) NOT NULL,
nom_periodo character varying(10) NOT NULL,
dat_inicio timestamp without time zone NOT NULL,
dat_termino timestamp without time zone,
cod_sala bigint NOT NULL,
CONSTRAINT pk_cod_reserva PRIMARY KEY(cod_reserva),
CONSTRAINT fk_reserva_sala FOREIGN KEY (cod_sala)
	REFERENCES udfsala.salas (cod_sala) ON UPDATE CASCADE ON DELETE SET NULL
);
COMMIT;