--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: id_hipodromo_seq; Type: SEQUENCE; Schema: public; Owner: darm
--

CREATE SEQUENCE id_hipodromo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 1000
    CACHE 1;


ALTER TABLE id_hipodromo_seq OWNER TO darm;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: hipodromo; Type: TABLE; Schema: public; Owner: darm; Tablespace: 
--

CREATE TABLE hipodromo (
    id_hipodromo integer DEFAULT nextval('id_hipodromo_seq'::regclass) NOT NULL,
    nombre character varying(30) NOT NULL
);


ALTER TABLE hipodromo OWNER TO darm;

--
-- Name: id_ejemplar_seq; Type: SEQUENCE; Schema: public; Owner: darm
--

CREATE SEQUENCE id_ejemplar_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 1000000
    CACHE 1;


ALTER TABLE id_ejemplar_seq OWNER TO darm;

--
-- Name: id_tabla_ejemplar_seq; Type: SEQUENCE; Schema: public; Owner: darm
--

CREATE SEQUENCE id_tabla_ejemplar_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 1000000
    CACHE 1;


ALTER TABLE id_tabla_ejemplar_seq OWNER TO darm;

--
-- Name: id_tabla_seq; Type: SEQUENCE; Schema: public; Owner: darm
--

CREATE SEQUENCE id_tabla_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 1000000
    CACHE 1;


ALTER TABLE id_tabla_seq OWNER TO darm;

--
-- Name: tabla; Type: TABLE; Schema: public; Owner: darm; Tablespace: 
--

CREATE TABLE tabla (
    id_tabla integer DEFAULT nextval('id_tabla_seq'::regclass) NOT NULL,
    id_hipodromo integer NOT NULL,
    login_correo character varying(200) NOT NULL,
    numero_carrera integer NOT NULL,
    fecha character varying(10) NOT NULL,
    fecha_num integer NOT NULL,
    precio double precision NOT NULL,
    activa boolean NOT NULL,
    cerrada boolean NOT NULL,
    fecha_publicacion character varying(10) NOT NULL,
    fecha_publicacion_num integer NOT NULL
);


ALTER TABLE tabla OWNER TO darm;

--
-- Name: tabla_ejemplar; Type: TABLE; Schema: public; Owner: darm; Tablespace: 
--

CREATE TABLE tabla_ejemplar (
    id_tabla_ejemplar integer DEFAULT nextval('id_tabla_ejemplar_seq'::regclass) NOT NULL,
    id_tabla integer NOT NULL,
    ejemplar_nombre character varying(255) NOT NULL,
    num_ejemplar integer NOT NULL,
    costo double precision,
    retirado boolean NOT NULL,
    nova boolean NOT NULL
);


ALTER TABLE tabla_ejemplar OWNER TO darm;

--
-- Name: usuario; Type: TABLE; Schema: public; Owner: darm; Tablespace: 
--

CREATE TABLE usuario (
    login_correo character varying(200) NOT NULL,
    pass character varying(128) NOT NULL,
    fecha_registro_num character varying(20) NOT NULL,
    admin boolean NOT NULL,
    nombre character varying(20) NOT NULL,
    apellido character varying(20) NOT NULL,
    fecha_registro character varying(10)
);


ALTER TABLE usuario OWNER TO darm;

--
-- Data for Name: hipodromo; Type: TABLE DATA; Schema: public; Owner: darm
--

INSERT INTO hipodromo VALUES (11, 'Valencia');
INSERT INTO hipodromo VALUES (13, 'Caracas');


--
-- Name: id_ejemplar_seq; Type: SEQUENCE SET; Schema: public; Owner: darm
--

SELECT pg_catalog.setval('id_ejemplar_seq', 8, true);


--
-- Name: id_hipodromo_seq; Type: SEQUENCE SET; Schema: public; Owner: darm
--

SELECT pg_catalog.setval('id_hipodromo_seq', 13, true);


--
-- Name: id_tabla_ejemplar_seq; Type: SEQUENCE SET; Schema: public; Owner: darm
--

SELECT pg_catalog.setval('id_tabla_ejemplar_seq', 62, true);


--
-- Name: id_tabla_seq; Type: SEQUENCE SET; Schema: public; Owner: darm
--

SELECT pg_catalog.setval('id_tabla_seq', 29, true);


--
-- Data for Name: tabla; Type: TABLE DATA; Schema: public; Owner: darm
--

INSERT INTO tabla VALUES (29, 13, 'admin', 1, '2018-02-28', 1519827342, 8600, false, true, '2018-02-03', 1517630400);


--
-- Data for Name: tabla_ejemplar; Type: TABLE DATA; Schema: public; Owner: darm
--

INSERT INTO tabla_ejemplar VALUES (58, 29, 'ff', 2, 5000, false, false);
INSERT INTO tabla_ejemplar VALUES (59, 29, 'ffeee', 3, 1500, false, false);
INSERT INTO tabla_ejemplar VALUES (60, 29, 'ghghg', 4, 1500, false, false);
INSERT INTO tabla_ejemplar VALUES (61, 29, 'bgbgb', 5, 2000, false, false);
INSERT INTO tabla_ejemplar VALUES (62, 29, 'hghg', 6, 3400, false, false);
INSERT INTO tabla_ejemplar VALUES (57, 29, 'dd', 1, 2000, true, false);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: darm
--

INSERT INTO usuario VALUES ('admin', 'e3867e684add0b890f14d88fc1addbea911aea4a8529d12846b0122406dd1cc38a09d713becf469db373d1801abe712acdda6c296e0735637bacf84fcf25c661', '1510162431', true, 'Administrador', '@', '2017-11-08');
INSERT INTO usuario VALUES ('tabla', '808d63ba47fcef6a7c52ec47cb63eb1b747a9d527a77385fc05c8a5ce8007586265d003b4130f6b0c8f3bb2ad89965a5da07289ba5d1e35321e160bea4f766f8', '1519826941', false, 'Tabla', 'Tabla', '2018-02-28');


--
-- Name: hipodromo_pkey; Type: CONSTRAINT; Schema: public; Owner: darm; Tablespace: 
--

ALTER TABLE ONLY hipodromo
    ADD CONSTRAINT hipodromo_pkey PRIMARY KEY (id_hipodromo);


--
-- Name: tabla_ejemplar_pkey; Type: CONSTRAINT; Schema: public; Owner: darm; Tablespace: 
--

ALTER TABLE ONLY tabla_ejemplar
    ADD CONSTRAINT tabla_ejemplar_pkey PRIMARY KEY (id_tabla_ejemplar);


--
-- Name: tabla_pkey; Type: CONSTRAINT; Schema: public; Owner: darm; Tablespace: 
--

ALTER TABLE ONLY tabla
    ADD CONSTRAINT tabla_pkey PRIMARY KEY (id_tabla);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: darm; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (login_correo);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--


