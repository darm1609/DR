--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

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
    costo double precision NOT NULL,
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

SELECT pg_catalog.setval('id_tabla_ejemplar_seq', 23, true);


--
-- Name: id_tabla_seq; Type: SEQUENCE SET; Schema: public; Owner: darm
--

SELECT pg_catalog.setval('id_tabla_seq', 21, true);


--
-- Data for Name: tabla; Type: TABLE DATA; Schema: public; Owner: darm
--

INSERT INTO tabla VALUES (20, 11, 'admin', 4, '2017-12-28', 1514467662, 800300, false, true, '2017-12-28', 1514433600);
INSERT INTO tabla VALUES (17, 11, 'admin', 1, '2017-11-22', 1511378230, 8900, true, false, '2017-11-22', 1511323200);


--
-- Data for Name: tabla_ejemplar; Type: TABLE DATA; Schema: public; Owner: darm
--

INSERT INTO tabla_ejemplar VALUES (17, 17, 'aaa', 1, 1112, false, false);
INSERT INTO tabla_ejemplar VALUES (18, 17, 'ssd', 2, 232, false, false);
INSERT INTO tabla_ejemplar VALUES (19, 17, 'asda', 3, 12312, false, false);
INSERT INTO tabla_ejemplar VALUES (22, 20, 'sdfs', 1, 1231231, false, false);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: darm
--

INSERT INTO usuario VALUES ('admin', 'e3867e684add0b890f14d88fc1addbea911aea4a8529d12846b0122406dd1cc38a09d713becf469db373d1801abe712acdda6c296e0735637bacf84fcf25c661', '1510162431', true, 'Administrador', '@', '2017-11-08');
INSERT INTO usuario VALUES ('darm', 'b1586709d3b7235d76cfb1c3eb564d4237bdcdc2c8487bd6e56c6c9d9eb54913b5fd0c9716c00e483dde5e88640712f1f3e796dd21de40f038a2db147423642b', '1510163160', false, 'Daniel', 'Rodriguez', '2017-11-08');


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

