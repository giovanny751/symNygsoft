--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: postgres
--

CREATE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO postgres;

SET search_path = public, pg_catalog;

--
-- Name: 'calibracion_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "'calibracion_equipo_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public."'calibracion_equipo_id_seq" OWNER TO postgres;

--
-- Name: 'calibracion_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"''calibracion_equipo_id_seq"', 1, false);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: Credencial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Credencial" (
    id integer NOT NULL,
    credencial character varying(50) NOT NULL
);


ALTER TABLE public."Credencial" OWNER TO postgres;

--
-- Name: alarmas_generadas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE alarmas_generadas (
    id integer NOT NULL,
    lectura_id integer NOT NULL,
    estado_id integer NOT NULL,
    examen_id integer NOT NULL,
    codigo_alarma integer NOT NULL,
    descripcion text NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    cedula numeric(10,0) NOT NULL,
    paciente_id integer NOT NULL,
    analisis_resultado text,
    nivel_alarma_id integer NOT NULL,
    descripcion_nivel_alarma text NOT NULL
);


ALTER TABLE public.alarmas_generadas OWNER TO postgres;

--
-- Name: alarmas_generadas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE alarmas_generadas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.alarmas_generadas_id_seq OWNER TO postgres;

--
-- Name: alarmas_generadas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('alarmas_generadas_id_seq', 1, false);


--
-- Name: alarmas_historial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE alarmas_historial (
    id integer NOT NULL,
    alarma_generada_id integer NOT NULL,
    comentario text,
    usuario_id integer NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL
);


ALTER TABLE public.alarmas_historial OWNER TO postgres;

--
-- Name: aseguradoras_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE aseguradoras_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.aseguradoras_id_seq OWNER TO postgres;

--
-- Name: aseguradoras_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('aseguradoras_id_seq', 36, true);


--
-- Name: aseguradoras; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE aseguradoras (
    id integer DEFAULT nextval('aseguradoras_id_seq'::regclass) NOT NULL,
    codigo_aseguradora integer NOT NULL,
    nombre character varying(50) NOT NULL,
    tipo character varying(20) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    estado bigint NOT NULL,
    direccion character varying(50) NOT NULL,
    telefono_fijo character varying(20) NOT NULL,
    celular character varying(20),
    mail character varying(50),
    borrado boolean
);


ALTER TABLE public.aseguradoras OWNER TO postgres;

--
-- Name: calibracion_equipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE calibracion_equipo (
    equipo_id integer NOT NULL,
    fecha_ultima_calibracion date NOT NULL,
    empresa_certificadoraw character varying(50) NOT NULL,
    certificado character varying(50),
    id integer NOT NULL,
    usuario_id integer NOT NULL
);


ALTER TABLE public.calibracion_equipo OWNER TO postgres;

--
-- Name: calibracion_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE calibracion_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.calibracion_equipo_id_seq OWNER TO postgres;

--
-- Name: calibracion_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE calibracion_equipo_id_seq OWNED BY calibracion_equipo.id;


--
-- Name: calibracion_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('calibracion_equipo_id_seq', 37, true);


--
-- Name: cambios_programas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cambios_programas (
    id integer NOT NULL,
    programa_id integer NOT NULL,
    fecha timestamp without time zone NOT NULL,
    uduario_id integer NOT NULL,
    cambio text NOT NULL
);


ALTER TABLE public.cambios_programas OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.clientes_id_seq OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('clientes_id_seq', 71, true);


--
-- Name: clientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE clientes (
    id integer DEFAULT nextval('clientes_id_seq'::regclass) NOT NULL,
    codigo_cliente integer NOT NULL,
    nombre character varying(50) NOT NULL,
    tipo_cliente integer NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    creado_por integer NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    modificado_por integer NOT NULL,
    fecha_inicio_contrato date NOT NULL,
    fecha_fin_contrato date NOT NULL,
    estado bigint NOT NULL,
    borrado boolean,
    mail character varying(50) NOT NULL
);


ALTER TABLE public.clientes OWNER TO postgres;

--
-- Name: company; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE company (
    id integer NOT NULL,
    nit character varying(50) NOT NULL,
    nombre character varying(50) NOT NULL,
    direccion character varying(100) NOT NULL,
    ciudad character varying(30) NOT NULL,
    telefono character varying(15) NOT NULL,
    email_equipo character varying(30) NOT NULL,
    equipo_programa character varying(30) NOT NULL,
    logo character varying(50) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL
);


ALTER TABLE public.company OWNER TO postgres;

--
-- Name: contacto_paciente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE contacto_paciente (
    contacto_id integer NOT NULL,
    paciente_id integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.contacto_paciente OWNER TO postgres;

--
-- Name: contacto_paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE contacto_paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.contacto_paciente_id_seq OWNER TO postgres;

--
-- Name: contacto_paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE contacto_paciente_id_seq OWNED BY contacto_paciente.id;


--
-- Name: contacto_paciente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('contacto_paciente_id_seq', 30, true);


--
-- Name: contactos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE contactos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.contactos_id_seq OWNER TO postgres;

--
-- Name: contactos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('contactos_id_seq', 14, true);


--
-- Name: contactos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE contactos (
    id integer DEFAULT nextval('contactos_id_seq'::regclass) NOT NULL,
    cedula_nit numeric(10,0) NOT NULL,
    nombre character varying(50) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    estado bigint NOT NULL,
    direccion character varying(50) NOT NULL,
    telefono_fijo character varying(20) NOT NULL,
    celular character varying(20),
    mail character varying(30),
    parentesco character varying(50),
    con_llaves bigint,
    cuidador bigint,
    borrado bigint
);


ALTER TABLE public.contactos OWNER TO postgres;

--
-- Name: equipo_examen_varibles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE equipo_examen_varibles (
    examen_equipo_id integer NOT NULL,
    variable_id integer NOT NULL,
    examne_id integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.equipo_examen_varibles OWNER TO postgres;

--
-- Name: equipo_examen_varibles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE equipo_examen_varibles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.equipo_examen_varibles_id_seq OWNER TO postgres;

--
-- Name: equipo_examen_varibles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE equipo_examen_varibles_id_seq OWNED BY equipo_examen_varibles.id;


--
-- Name: equipo_examen_varibles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('equipo_examen_varibles_id_seq', 41, true);


--
-- Name: equipos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE equipos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.equipos_id_seq OWNER TO postgres;

--
-- Name: equipos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('equipos_id_seq', 49, true);


--
-- Name: equipos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE equipos (
    id integer DEFAULT nextval('equipos_id_seq'::regclass) NOT NULL,
    tipo_equipo integer NOT NULL,
    codigo_equipo integer NOT NULL,
    descripcion character varying(50) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    estado_id integer NOT NULL,
    ubicacion character varying(50),
    serial numeric(10,0) NOT NULL,
    fabricante character varying(50),
    fecha_fabricacion date,
    imagen character varying(100),
    responsable character varying(50),
    observaciones text,
    borrado bigint,
    asignado bigint
);


ALTER TABLE public.equipos OWNER TO postgres;

--
-- Name: estado_equipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estado_equipo (
    id integer NOT NULL,
    estado character varying(50) NOT NULL
);


ALTER TABLE public.estado_equipo OWNER TO postgres;

--
-- Name: estados_alarmas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estados_alarmas (
    id integer NOT NULL,
    estado character varying(50)
);


ALTER TABLE public.estados_alarmas OWNER TO postgres;

--
-- Name: examen_equipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE examen_equipo (
    id integer NOT NULL,
    examen_id integer NOT NULL,
    equipo_id integer NOT NULL
);


ALTER TABLE public.examen_equipo OWNER TO postgres;

--
-- Name: examenes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE examenes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.examenes_id_seq OWNER TO postgres;

--
-- Name: examenes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('examenes_id_seq', 22, true);


--
-- Name: examenes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE examenes (
    id integer DEFAULT nextval('examenes_id_seq'::regclass) NOT NULL,
    codigo_examen integer NOT NULL,
    nombre character varying(50) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    borrado bigint
);


ALTER TABLE public.examenes OWNER TO postgres;

--
-- Name: historial_equipo_estado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE historial_equipo_estado (
    id character(10) NOT NULL,
    estadoeq_id integer NOT NULL,
    equipo_id integer NOT NULL,
    fecha timestamp without time zone NOT NULL,
    ubicacion character varying(50) NOT NULL
);


ALTER TABLE public.historial_equipo_estado OWNER TO postgres;

--
-- Name: hospitales_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE hospitales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.hospitales_id_seq OWNER TO postgres;

--
-- Name: hospitales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('hospitales_id_seq', 33, true);


--
-- Name: hospitales; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE hospitales (
    id integer DEFAULT nextval('hospitales_id_seq'::regclass) NOT NULL,
    codigo_hospital integer NOT NULL,
    nit character varying(50),
    razon_social character varying(50) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion time without time zone NOT NULL,
    estado bigint NOT NULL,
    direccion character varying(50) NOT NULL,
    telefono_fijo character varying(20) NOT NULL,
    celular character varying(20),
    mail character varying(30),
    borrado bigint
);


ALTER TABLE public.hospitales OWNER TO postgres;

--
-- Name: lectura_equipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE lectura_equipo (
    id integer NOT NULL,
    paciente_id integer NOT NULL,
    equipo_id integer NOT NULL,
    variable_id integer NOT NULL,
    lectura_numerica double precision,
    lectura_texto text,
    fecha_creacion timestamp without time zone NOT NULL
);


ALTER TABLE public.lectura_equipo OWNER TO postgres;

--
-- Name: medico_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE medico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.medico_id_seq OWNER TO postgres;

--
-- Name: medico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('medico_id_seq', 25, true);


--
-- Name: medico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE medico (
    id integer DEFAULT nextval('medico_id_seq'::regclass) NOT NULL,
    codigo_numerico integer NOT NULL,
    nombre character varying(50) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    estado bigint NOT NULL,
    direccion character varying(50) NOT NULL,
    telefono_fijo character varying(20) NOT NULL,
    celular character varying(20),
    borrado boolean,
    mail character varying(50),
    matricula_profesional character varying(50) NOT NULL
);


ALTER TABLE public.medico OWNER TO postgres;

--
-- Name: medico_cliente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE medico_cliente (
    id integer NOT NULL,
    medico_id integer NOT NULL,
    usuario_id integer NOT NULL,
    cliente_id integer NOT NULL
);


ALTER TABLE public.medico_cliente OWNER TO postgres;

--
-- Name: nivel_alarma_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE nivel_alarma_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.nivel_alarma_id_seq OWNER TO postgres;

--
-- Name: nivel_alarma_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('nivel_alarma_id_seq', 14, true);


--
-- Name: nivel_alarma; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE nivel_alarma (
    id integer DEFAULT nextval('nivel_alarma_id_seq'::regclass) NOT NULL,
    examen_id integer NOT NULL,
    codigo_nivel_alarma integer NOT NULL,
    descripcion text NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    analisis_resultado character varying(50) NOT NULL,
    nro_repeticiones_minima integer NOT NULL,
    nro_repeticiones_maximo integer NOT NULL,
    tiempo interval NOT NULL,
    frecuencia character varying(20) NOT NULL,
    color character varying(20) NOT NULL,
    protocolo_id integer NOT NULL,
    tipo_alarma integer NOT NULL,
    borrado bigint
);


ALTER TABLE public.nivel_alarma OWNER TO postgres;

--
-- Name: paciente_aseguradora; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paciente_aseguradora (
    aseguradora_id integer NOT NULL,
    paciente_id integer NOT NULL,
    tipo character varying(25) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.paciente_aseguradora OWNER TO postgres;

--
-- Name: paciente_aseguradora_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paciente_aseguradora_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.paciente_aseguradora_id_seq OWNER TO postgres;

--
-- Name: paciente_aseguradora_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paciente_aseguradora_id_seq OWNED BY paciente_aseguradora.id;


--
-- Name: paciente_aseguradora_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paciente_aseguradora_id_seq', 12, true);


--
-- Name: paciente_cliente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paciente_cliente (
    paciente_id integer NOT NULL,
    cliente_id integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.paciente_cliente OWNER TO postgres;

--
-- Name: paciente_cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paciente_cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.paciente_cliente_id_seq OWNER TO postgres;

--
-- Name: paciente_cliente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paciente_cliente_id_seq OWNED BY paciente_cliente.id;


--
-- Name: paciente_cliente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paciente_cliente_id_seq', 1, false);


--
-- Name: paciente_equipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paciente_equipo (
    paciente_id integer NOT NULL,
    equipo_id integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.paciente_equipo OWNER TO postgres;

--
-- Name: paciente_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paciente_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.paciente_equipo_id_seq OWNER TO postgres;

--
-- Name: paciente_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paciente_equipo_id_seq OWNED BY paciente_equipo.id;


--
-- Name: paciente_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paciente_equipo_id_seq', 28, true);


--
-- Name: paciente_hospital; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paciente_hospital (
    paciente_id integer NOT NULL,
    hospital_id integer NOT NULL,
    prioridad integer NOT NULL,
    tipo character varying(20) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.paciente_hospital OWNER TO postgres;

--
-- Name: paciente_hospital_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE paciente_hospital_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.paciente_hospital_id_seq OWNER TO postgres;

--
-- Name: paciente_hospital_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE paciente_hospital_id_seq OWNED BY paciente_hospital.id;


--
-- Name: paciente_hospital_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('paciente_hospital_id_seq', 18, true);


--
-- Name: pacientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pacientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pacientes_id_seq OWNER TO postgres;

--
-- Name: pacientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pacientes_id_seq', 81, true);


--
-- Name: pacientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pacientes (
    id integer DEFAULT nextval('pacientes_id_seq'::regclass) NOT NULL,
    cedula numeric(15,0) NOT NULL,
    nombres character varying(100) NOT NULL,
    apellidos character varying(100) NOT NULL,
    fecha_afiliacion timestamp without time zone NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    foto character varying(100) NOT NULL,
    direccion character varying(50) NOT NULL,
    barrio character varying(50) NOT NULL,
    ciudad character varying(50) NOT NULL,
    fecha_nacimiento date NOT NULL,
    estatura numeric(10,2) NOT NULL,
    peso numeric(10,2) NOT NULL,
    estado bigint NOT NULL,
    telefono_fijo character varying(20) NOT NULL,
    celular character varying(20) NOT NULL,
    mail character varying(20) NOT NULL,
    fecha_inicio_contrato date NOT NULL,
    fecha_fin_contrato date NOT NULL,
    observaciones text NOT NULL,
    borrado bigint
);


ALTER TABLE public.pacientes OWNER TO postgres;

--
-- Name: programa; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE programa (
    id integer NOT NULL,
    paciente_id integer NOT NULL,
    examen_id integer NOT NULL,
    variable_id integer NOT NULL,
    valor_frecuencia integer NOT NULL,
    frecuencia character varying(50) NOT NULL,
    valor_maximo double precision NOT NULL,
    valor_minimo double precision NOT NULL,
    documento character varying(50) NOT NULL,
    observaciones text,
    borrado bigint
);


ALTER TABLE public.programa OWNER TO postgres;

--
-- Name: protocolo_nivel_alarma; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE protocolo_nivel_alarma (
    id integer NOT NULL,
    protocolo_id integer NOT NULL,
    nivel_alarma_id integer NOT NULL
);


ALTER TABLE public.protocolo_nivel_alarma OWNER TO postgres;

--
-- Name: protocolos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE protocolos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.protocolos_id_seq OWNER TO postgres;

--
-- Name: protocolos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('protocolos_id_seq', 29, true);


--
-- Name: protocolos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE protocolos (
    id integer DEFAULT nextval('protocolos_id_seq'::regclass) NOT NULL,
    codigo_protocolo integer NOT NULL,
    nombre character varying(20) NOT NULL,
    descripcion text NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    version character varying(50) NOT NULL,
    estado bigint NOT NULL,
    sms bigint NOT NULL,
    mail bigint NOT NULL,
    borrado bigint
);


ALTER TABLE public.protocolos OWNER TO postgres;

--
-- Name: rol_credencial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rol_credencial (
    id integer NOT NULL,
    credencial_id integer NOT NULL,
    roles_id integer NOT NULL
);


ALTER TABLE public.rol_credencial OWNER TO postgres;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE roles (
    id integer NOT NULL,
    rol character varying(50) NOT NULL,
    orden integer
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: tipo_equipos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_equipos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipo_equipos_id_seq OWNER TO postgres;

--
-- Name: tipo_equipos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_equipos_id_seq', 7, true);


--
-- Name: tipo_equipos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_equipos (
    id integer DEFAULT nextval('tipo_equipos_id_seq'::regclass) NOT NULL,
    codigo_tipo integer NOT NULL,
    referencia character varying(50) NOT NULL,
    frecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    borrado boolean
);


ALTER TABLE public.tipo_equipos OWNER TO postgres;

--
-- Name: tipos_alarmas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipos_alarmas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipos_alarmas_id_seq OWNER TO postgres;

--
-- Name: tipos_alarmas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipos_alarmas_id_seq', 19, true);


--
-- Name: tipos_alarmas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipos_alarmas (
    id integer DEFAULT nextval('tipos_alarmas_id_seq'::regclass) NOT NULL,
    codigo_tipo_alarma integer NOT NULL,
    descripcion text NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    examen_id integer NOT NULL,
    borrado bigint
);


ALTER TABLE public.tipos_alarmas OWNER TO postgres;

--
-- Name: tipos_clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipos_clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipos_clientes_id_seq OWNER TO postgres;

--
-- Name: tipos_clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipos_clientes_id_seq', 13, true);


--
-- Name: tipos_clientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipos_clientes (
    id integer DEFAULT nextval('tipos_clientes_id_seq'::regclass) NOT NULL,
    codigo_tipo_cliente integer NOT NULL,
    descripcion character varying(50) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    creado_por integer NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    modificado_por integer NOT NULL,
    borrado bigint
);


ALTER TABLE public.tipos_clientes OWNER TO postgres;

--
-- Name: tiposa_nivela; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tiposa_nivela (
    id integer NOT NULL,
    nivel_alarma_id integer NOT NULL,
    tipos_alarma_id integer NOT NULL
);


ALTER TABLE public.tiposa_nivela OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_seq OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuarios_id_seq', 86, true);


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuarios (
    id integer DEFAULT nextval('usuarios_id_seq'::regclass) NOT NULL,
    cedula numeric(15,0) NOT NULL,
    nombres character varying(100),
    apellidos character varying(100),
    usuario character varying(100) NOT NULL,
    clave character varying(50) NOT NULL,
    roles integer NOT NULL,
    mail character varying(50) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    fecha_ultimo_ingreso timestamp without time zone NOT NULL,
    ultimo_tiempo_sesion time without time zone NOT NULL,
    estado boolean NOT NULL,
    borrado boolean NOT NULL
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: variables_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE variables_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.variables_id_seq OWNER TO postgres;

--
-- Name: variables_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('variables_id_seq', 20, true);


--
-- Name: variables; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE variables (
    id integer DEFAULT nextval('variables_id_seq'::regclass) NOT NULL,
    codigo_variable integer NOT NULL,
    hl7tag character varying(50),
    descripcion character varying(150) NOT NULL,
    fecha_creacion timestamp without time zone NOT NULL,
    fecha_modificacion timestamp without time zone NOT NULL,
    examen_id integer NOT NULL,
    borrado bigint
);


ALTER TABLE public.variables OWNER TO postgres;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY calibracion_equipo ALTER COLUMN id SET DEFAULT nextval('calibracion_equipo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contacto_paciente ALTER COLUMN id SET DEFAULT nextval('contacto_paciente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipo_examen_varibles ALTER COLUMN id SET DEFAULT nextval('equipo_examen_varibles_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_aseguradora ALTER COLUMN id SET DEFAULT nextval('paciente_aseguradora_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_cliente ALTER COLUMN id SET DEFAULT nextval('paciente_cliente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_equipo ALTER COLUMN id SET DEFAULT nextval('paciente_equipo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_hospital ALTER COLUMN id SET DEFAULT nextval('paciente_hospital_id_seq'::regclass);


--
-- Data for Name: Credencial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Credencial" (id, credencial) FROM stdin;
\.


--
-- Data for Name: alarmas_generadas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY alarmas_generadas (id, lectura_id, estado_id, examen_id, codigo_alarma, descripcion, fecha_creacion, cedula, paciente_id, analisis_resultado, nivel_alarma_id, descripcion_nivel_alarma) FROM stdin;
\.


--
-- Data for Name: alarmas_historial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY alarmas_historial (id, alarma_generada_id, comentario, usuario_id, fecha_creacion) FROM stdin;
\.


--
-- Data for Name: aseguradoras; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY aseguradoras (id, codigo_aseguradora, nombre, tipo, fecha_creacion, fecha_modificacion, estado, direccion, telefono_fijo, celular, mail, borrado) FROM stdin;
3	23123	Aseg	EPS/IPS	2015-07-31 00:00:00	2015-07-31 21:26:01	1	25 de mayo	123456	1234	jona1@gmail.com	t
12	7534	OSECAC pp	EPS/IPS	2015-08-10 23:27:03	2015-08-11 00:14:53	1	V lopez 1241	78967896	2354346	osecac@gmail.com	t
2	1233	Sancor 2	EPS/IPS	2015-07-31 00:00:00	2015-08-11 05:41:22	1	25 de mayo	12412	123123	jona1@gmail.com	t
9	23123	SwissMedical	Prepaga	2015-08-10 23:02:43	2015-08-10 23:21:43	1	25 de mayo	235235	5453352	swiss@gmail.com	f
11	23123	Medife	Red de ambulancias	2015-08-10 23:04:00	2015-08-10 23:22:00	1	25 de mayo	123456	1234	unmail@gmail.com	f
26	1672	asdas	EPS/IPS	2015-08-11 03:02:44	2015-08-11 03:02:44	1	asdasd	213123	123123	joan@gmail	f
27	2841	Medplus	EPS/IPS	2015-08-11 03:04:00	2015-08-11 03:04:00	1	calle 97 # 45-68	87372647	3208420669	giney@hotmail.com	f
28	13711	Medicina Medplus	Prepaga	2015-08-11 03:05:34	2015-08-11 03:05:34	1	calle 97 # 45-68	67654678	3208420669	gineypaola@hotmail.com	f
29	15368	Medicina Medplus2	EPS/IPS	2015-08-11 19:14:32	2015-08-11 19:15:31	1	calle 97 # 45-68	7378978	320897865	medplus@soporte.com	f
30	4418	AXA prepagada	EPS/IPS	2015-08-11 19:16:34	2015-08-11 19:39:01	1	calle 97 # 45-68	7865678		axa@contores.com	f
31	48901	Ospid	Prepaga	2015-08-11 19:34:12	2015-08-11 19:34:12	1	Alem 856	44098773	2284654994	ospid.informacion@ospid.com.ar	t
32	33474	Colmédica	Prepaga	2015-08-12 21:56:41	2015-08-12 21:56:41	1	Carrera 13  49 – 70 Bogotá 	7678976		atencionUsuarios@colmedica.com.co	f
1	123	Nativa4	EPS/IPS	2015-07-31 00:00:00	2015-08-11 00:21:13	1	25 de mayo	12412	123123	jona1@gmail.com	t
10	23123	Ioma	EPS/IPS	2015-08-10 23:02:53	2015-08-14 17:12:34	1	25 de mayo	123456	1234	unmail@gmail.com	f
\.


--
-- Data for Name: calibracion_equipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY calibracion_equipo (equipo_id, fecha_ultima_calibracion, empresa_certificadoraw, certificado, id, usuario_id) FROM stdin;
25	2015-08-02	thtff	\N	3	1
25	2015-08-15	214	\N	4	1
25	2015-08-13	asdasd	\N	5	1
25	2015-08-15	sdasdasd	\N	6	1
25	2015-08-15	sdasdasd	\N	7	1
25	2015-08-15	sdasdasd	\N	8	1
25	2015-08-15	sdasdasd	\N	9	1
25	2015-08-15	sdasdasd	\N	10	1
25	2015-08-15	sdasdasd	\N	11	1
25	2015-08-15	sdasdasd	\N	12	1
25	2015-08-15	sdasdasd	\N	13	1
25	2015-08-15	sdasdasd	\N	14	1
25	2015-08-15	sdasdasd	\N	15	1
30	2015-08-01	Calibradora S.A	\N	16	1
30	2015-08-28	Calibradora 2 S.a	\N	17	1
31	2015-08-01	Calibradora S.A	\N	18	1
31	2015-08-13	Calibradora 2 S.a	\N	19	1
31	2015-08-01	Calibrando equipos	\N	20	1
31	2015-10-03	Nueva calibracion	\N	23	1
31	2015-08-12	Calibrando equipos 2	\N	24	1
32	2015-08-12	asdasdas	\N	25	1
33	2015-08-12	asdasdasd	\N	26	1
33	2015-08-13		\N	27	1
34	2015-08-01	Calibradora S.A	\N	28	1
37	2015-08-26	onrom	\N	29	1
38	2015-03-03	asdasd	\N	30	1
41	2015-07-11	asdasd	\N	31	1
42	2015-08-01	asdDASDAS	\N	32	1
43	2015-08-08	zxvbjcbh	\N	33	1
43	2015-08-14		\N	34	1
46	2015-08-14		\N	35	1
48	2015-08-03	bsi	\N	36	1
49	2015-08-02		\N	37	1
\.


--
-- Data for Name: cambios_programas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cambios_programas (id, programa_id, fecha, uduario_id, cambio) FROM stdin;
\.


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY clientes (id, codigo_cliente, nombre, tipo_cliente, fecha_creacion, creado_por, fecha_modificacion, modificado_por, fecha_inicio_contrato, fecha_fin_contrato, estado, borrado, mail) FROM stdin;
49	28274	Roxana	1	2015-08-06 00:10:31	1	2015-08-06 00:10:31	1	2015-12-31	2015-12-31	1	t	info@sgm.co
51	91610	Alfredo camelo	2	2015-08-06 03:52:04	1	2015-08-10 18:21:44	1	2015-08-10	2015-08-10	1	t	info@sgm.co
52	5099	Vanesa2	2	2015-08-06 23:39:23	1	2015-08-10 20:47:11	1	2015-08-10	2015-08-10	1	t	info@sgm.co
55	29507	Valeria	2	2015-08-08 22:41:10	1	2015-08-08 22:41:10	1	2015-08-01	2015-08-31	1	f	info@sgm.co
57	10296	Umma	2	2015-08-09 01:48:50	1	2015-08-09 01:48:50	1	2015-08-01	2015-09-26	1	t	info@sgm.co
56	5099	Milagros L	1	2015-08-09 01:06:14	1	2015-08-09 01:11:07	1	2015-08-09	2015-08-09	1	t	info@sgm.co
58	45132	Lishen	2	2015-08-09 01:57:23	1	2015-08-10 18:59:45	1	2015-08-10	2015-08-10	1	f	info@sgm.co\n
61	80670	Lucas	2	2015-08-10 13:32:59	1	2015-08-10 13:32:59	1	2015-08-01	2015-08-30	1	t	info@sgm.co\n
62	16436	Medicina Medplus	2	2015-08-10 18:09:09	1	2015-08-10 18:19:40	1	2015-08-10	2015-08-10	1	t	info@sgm.co\n
63	14788	Cleinte	2	2015-08-10 18:47:16	1	2015-08-11 04:44:15	1	2015-08-11	2015-08-11	1	f	info@sgm.co\n
64	29345	medplus cerez	2	2015-08-10 21:33:27	1	2015-08-10 21:33:27	1	2015-08-10	2015-08-03	1	f	info@sgm.co\n
65	97747	sebastian	2	2015-08-11 00:43:29	1	2015-08-11 00:43:29	1	2015-08-20	2015-08-12	1	f	info@sgm.co\n
66	36181	Nativa	4	2015-08-11 03:56:55	1	2015-08-11 03:56:55	1	2015-08-01	2015-08-31	1	f	info@sgm.co\n
67	49819	asdasd-jjjj	6	2015-08-11 04:30:59	1	2015-08-11 20:36:39	1	2015-08-11	2015-08-11	1	f	info@sgm.co\n
68	97497	Medicina Medplus	8	2015-08-11 20:36:05	1	2015-08-11 20:36:05	1	2015-08-03	2015-08-01	1	f	info@sgm.co\n
69	97674	sebastian	6	2015-08-12 01:10:57	1	2015-08-12 01:13:54	1	2015-08-12	2015-08-12	1	f	sluguercio@yahoo.com.ar
70	72726	Hospital San Rafael	10	2015-08-13 05:29:20	1	2015-08-13 05:29:20	1	2015-08-03	2016-01-01	1	t	informacion@hospitalSanRafael.com
71	25726	compensar	13	2015-08-14 19:30:31	1	2015-08-14 19:30:31	1	2013-05-03	2014-06-07	1	f	co@compensar.com
\.


--
-- Data for Name: company; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY company (id, nit, nombre, direccion, ciudad, telefono, email_equipo, equipo_programa, logo, fecha_creacion) FROM stdin;
\.


--
-- Data for Name: contacto_paciente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY contacto_paciente (contacto_id, paciente_id, id) FROM stdin;
6	68	17
10	68	18
1	72	22
1	78	26
1	79	27
13	80	28
11	80	29
13	81	30
\.


--
-- Data for Name: contactos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY contactos (id, cedula_nit, nombre, fecha_creacion, fecha_modificacion, estado, direccion, telefono_fijo, celular, mail, parentesco, con_llaves, cuidador, borrado) FROM stdin;
6	5732889284	gina tatiana	2015-08-05 04:47:08	2015-08-05 04:47:08	1	calle 76 36 - 67	6765444	3202040	gijjbejnlgb	padre	1	1	1
2	12453	Contacto1	2015-07-31 00:00:00	2015-07-24 00:00:00	1	25 de mayo	22907898078	214124	jona1@gmail.com		1	0	1
1	12453	contacto	2015-07-31 00:00:00	2015-07-24 00:00:00	1	25 de mayo	22907898078	214124	jona1@gmail.com		1	0	1
7	124124	Contacto uno	2015-08-11 04:01:12	2015-08-11 04:01:12	1	calle 1565	516165	165654	jona@hotmail.com	Madre	1	1	0
9	525352	Marcelo	2015-08-11 05:11:56	2015-08-11 05:11:56	1	Beruti 3005	15660790	15601287	mlezaeta@gmail.com	Padre	1	1	0
10	124124	Rodrigo	2015-08-11 05:21:30	2015-08-11 05:21:30	1	14 de abril 	564654654	654165465	agomez@gmail.com	Tio	1	1	1
11	55678678	Javier Moreno	2015-08-11 18:57:21	2015-08-11 18:57:21	1	Calle 147 #45-68 Cedrtios, Bogotá	76546787	322	giney@hotmail.com	Hijo	1	0	0
12	55678678	pepe	2015-08-11 18:58:00	2015-08-11 18:58:00	1	Calle 147 #45-68 Cedrtios, Bogotá	78272882	3208765687	gijjbejnlgb	Hijo	1	1	0
8	1235512	gina tatiana2	2015-08-11 05:10:22	2015-08-11 05:10:22	1	Calle 1234	2041249	1534114	gmartinez@gmail.com	Madre	1	1	1
13	79648477	Alexander Moreno	2015-08-13 20:14:38	2015-08-13 20:14:38	1	Calle 127  20-45 Bogotá	5378967	320889778	aMoreno@hotmail.com	Hijo	1	0	0
14	89765	Cuadrante Policia	2015-08-14 19:01:17	2015-08-14 19:01:17	1	Cuadrante # 23	87987678	320678678	policia@gmail.com	policia	0	0	0
\.


--
-- Data for Name: equipo_examen_varibles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY equipo_examen_varibles (examen_equipo_id, variable_id, examne_id, id) FROM stdin;
34	12	3	18
34	13	3	19
34	9	3	20
34	15	1	21
34	16	1	22
38	10	3	23
38	12	3	24
38	13	3	25
41	10	3	26
41	12	3	27
42	10	3	28
42	12	3	29
43	15	1	36
44	13	3	39
46	17	20	40
46	18	20	41
\.


--
-- Data for Name: equipos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY equipos (id, tipo_equipo, codigo_equipo, descripcion, fecha_creacion, fecha_modificacion, estado_id, ubicacion, serial, fabricante, fecha_fabricacion, imagen, responsable, observaciones, borrado, asignado) FROM stdin;
13	1	116	Descripcion1	2015-08-05 12:38:09	2015-08-05 12:38:09	1	Tandil	12345	Fabricante Nuevo	2015-08-05	\N	resp	\N	1	1
14	1	30444	Descripcion de equipo	2015-08-12 03:20:58	2015-08-12 03:20:58	3	Tandil	12453521	Stanik	2015-08-12	\N	Martin	\N	1	1
15	1	68606	Un buen equipo	2015-08-12 03:22:15	2015-08-12 03:22:15	5	Olavarria	4654654	UPJ	2015-08-12	\N	Jorge	\N	1	1
17	1	3210	Equipo verde	2015-08-12 17:07:15	2015-08-12 17:07:15	1	Tandil	987908	saludfab	2015-08-12	\N	Pampa	No hay	0	1
21	1	93862	Descripcion 10	2015-08-12 17:41:16	2015-08-12 17:41:16	1	La Pampa	2135325	Techin	2015-08-12	\N	Pampa	No hay	0	1
31	1	91461	huuihui	2015-08-13 00:44:13	2015-08-13 00:44:13	1	asdfasdasd	12341234	iopjopj	2015-08-13	\N	asdadsa	asdasd	0	1
32	1	66018	adasd	2015-08-13 01:36:25	2015-08-13 01:36:25	1	asdas	213123	asddassda	2015-08-13	\N	asdas	asdasdasd	0	1
33	1	88525	asdasdasd	2015-08-13 01:40:57	2015-08-13 01:40:57	1	asdasd	12421	asddasasd	2015-08-13	\N	asdas	asdadas	0	1
34	1	62069	sfASC	2015-08-13 01:51:03	2015-08-13 01:51:03	2	IOIOJIOJI	16651651	ASCFASDFAF	2015-08-13	\N	ASDASD	asddasd	0	1
1	1	10	Descripcion1	2015-07-31 00:00:00	2015-07-31 00:00:00	1	Medelin	123	Fabri	2015-07-31	\N	res	obs	0	1
2	1	3422352	Descripcion1	2015-07-31 00:00:00	2015-07-31 00:00:00	1	Medelin	643352	Techin	2015-08-30	\N	res	obs	0	1
3	1	2009	Equipo de pureba	2015-08-30 00:00:00	2015-08-30 00:00:00	1	Olavarria	998348	Bosch	2015-08-31	\N	Roberto	No hay	0	1
30	1	70825	dsaasd	2015-08-13 00:28:33	2015-08-13 00:28:33	1	asdsdaasd	123124	asdasdasd	2015-08-13	\N	asdsd	asdasd	0	1
38	1	9310	asdasd	2015-08-13 18:24:30	2015-08-13 18:24:30	1	asdas	1243124	sada	2015-08-13	\N	asdas	asdsa	1	1
37	1	42092	Espirometro M3	2015-08-13 03:44:06	2015-08-13 03:44:06	1	almacen	65422	pepe	2015-08-13	\N		se debe realizar mantenimiento a final del mes	1	1
40	1	71914	Descripcion	2015-08-13 23:35:06	2015-08-13 23:35:06	1	tandil	124124	Fabricante Nuevo	2015-08-13	\N	res	Jona	1	1
42	1	68560	hljklh	2015-08-14 00:46:43	2015-08-14 00:46:43	1	HJKHK	3234132	OLNJJKLN	2015-08-14	\N	JHJKL	SDASD	1	1
41	1	7794	Descripcion	2015-08-13 23:36:11	2015-08-13 23:36:11	1	asdasd	123123	Fabricante Nuevo	2015-08-13	\N	asdas	asdasdasd	1	1
43	1	13400	asdas	2015-08-14 00:54:37	2015-08-14 00:54:37	1	asdas	61321	asdas	2015-08-14	\N	saddas	asdfas	1	1
44	1	32675	dasda	2015-08-14 01:29:59	2015-08-14 01:29:59	1	asdas	213123	asdasdasd	2015-08-14	\N	asdas	asdasd	1	1
23	1	26123434	Descripcion 11	2015-08-12 18:04:35	2015-08-12 18:04:35	1	Tandil	12412412	Techin	2015-08-12	\N	Diego	No hay	0	1
24	1	2643244	Descripcion 11	2015-08-12 18:18:53	2015-08-12 18:18:53	1	Tandil	12412412	Techin	2015-08-12	\N	Diego	No hay	0	1
25	1	2643444	Descripcion 11	2015-08-12 18:21:00	2015-08-12 18:21:00	1	Tandil	12412412	Techin	2015-08-12	\N	Diego	No hay	0	1
26	1	33	Descripcion 11	2015-08-12 18:34:28	2015-08-12 18:34:28	1	Tandil	12412412	Techin	2015-08-12	\N	Diego	No hay	0	1
28	1	273182	dasñodih	2015-08-13 00:26:31	2015-08-13 00:26:31	1	fasfas	124124	jiojio	2015-08-13	\N	sdffsd	asffasf	0	1
27	1	222134	dasñodih	2015-08-13 00:22:53	2015-08-13 00:22:53	1	fasfas	124124	jiojio	2015-08-13	\N	sdffsd	asffasf	0	1
16	1	94967	Equipo de ID	2015-08-12 16:49:14	2015-08-12 16:49:14	1	Tandil	3552123	Tech	2015-08-12	\N	Jonathan	No hay	1	1
18	1	93862	Descripcion 10	2015-08-12 17:21:02	2015-08-12 17:21:02	1	La Pampa	2135325	Techin	2015-08-12	\N	Pampa	No hay	1	1
46	1	96145	Monitor de signos vitales V30 	2015-08-14 11:51:05	2015-08-14 11:51:05	1	almacén	53768798	omron	2015-08-14	\N		el equipo debe llevarse a mantenimiento	0	0
48	1	58175	Monitor de signos vitales V30 	2015-08-14 11:58:03	2015-08-14 11:58:03	1	almacén	65789	omron	2015-08-14	\N			\N	1
49	1	69000	monitor signos vitales V30	2015-08-14 19:41:14	2015-08-14 19:41:14	1	almacen	675677	omron	2015-08-14	\N			\N	0
\.


--
-- Data for Name: estado_equipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estado_equipo (id, estado) FROM stdin;
1	DISPONIBLE
2	EN OPERACION
3	ASIGNADO
4	EN TRANSITO
5	MANTENIMIENTO
\.


--
-- Data for Name: estados_alarmas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estados_alarmas (id, estado) FROM stdin;
\.


--
-- Data for Name: examen_equipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY examen_equipo (id, examen_id, equipo_id) FROM stdin;
\.


--
-- Data for Name: examenes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY examenes (id, codigo_examen, nombre, fecha_creacion, fecha_modificacion, borrado) FROM stdin;
7	1	Audiometria	2015-08-04 00:00:00	2015-08-04 00:00:00	0
3	123	Diabetes	2015-07-31 00:00:00	2015-08-11 06:13:51	0
17	95318	Examen W	2015-08-11 06:20:40	2015-08-11 06:31:43	1
20	58538	Espirometria	2015-08-11 20:45:57	2015-08-11 20:45:57	0
15	64135	Examen AB	2015-08-11 06:19:26	2015-08-11 20:50:09	0
16	24453	Examen B	2015-08-11 06:20:09	2015-08-11 20:50:39	0
1	1234	Precion Arterial2	2015-07-31 00:00:00	2015-08-13 20:40:41	0
21	71936		2015-08-14 19:18:55	2015-08-14 19:18:55	0
22	97451	Tension arterial 	2015-08-14 19:19:27	2015-08-14 19:19:27	0
\.


--
-- Data for Name: historial_equipo_estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY historial_equipo_estado (id, estadoeq_id, equipo_id, fecha, ubicacion) FROM stdin;
\.


--
-- Data for Name: hospitales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY hospitales (id, codigo_hospital, nit, razon_social, fecha_creacion, fecha_modificacion, estado, direccion, telefono_fijo, celular, mail, borrado) FROM stdin;
10	99307	123465	Hospital de Tandil	2015-08-05 10:23:56	04:44:20	1	9 de julio 1942	1245323	2311552	hospitaldeprueba@gmail.com	0
19	16275	3241654	Clinica Chacabuco S.A	2015-08-05 11:16:12	11:16:12	1	Chacabuco 356	442231	1532652	cchacacbuco@gmail.com	1
21	73901	\N	Hospital Funcion	2015-08-07 05:02:14	05:02:44	0	Funciona	Funcion	Funciona	Funciona	1
22	90881	\N	hospital san Ignacio	2015-08-07 17:37:32	17:37:32	1	calle 76 36 - 67	888888	3208420669	giney{kdsckjsnv	0
20	61514		Cemeda2	2015-08-07 03:41:46	17:40:17	1	Prinlges y Trabajadores	21451212	12415151	cemeda@gmail.com	0
23	64932	\N	Hospital  Municipal	2015-08-08 22:38:29	22:38:29	1	Sarmiento 1245	12532	76567	hmunucipal@olava.com.ar	0
24	28222	\N	Chacabuco	2015-08-11 03:58:56	03:58:56	1	calee 652	2141251	124124	jona@hotmail.com	0
12	87576	546	Maria Auxiliadora2	2015-08-05 10:48:54	17:41:17	1	Calle falsa 1234	0897	89789	hbogota@gmail.com	1
25	74145	\N	Chacabuco	2015-08-11 04:48:46	04:49:09	1	Chacabuco 356	9079612	9878979	jonathan.lezaeta@gmail.com	1
29	24737	\N	UPJ S.A	2015-08-11 04:56:49	04:56:49	1	Ruta 225	2134124	214124	jonathan.lezaeta@gmail.com	0
32	29333	\N	Hospital san Ignacio	2015-08-11 18:16:27	18:24:39	1	 Cra. 7 #40 - 62, Bogotá	5315764	31075279037	atencion@hospitalIg.com	1
31	19293	\N	Hospital de Azul	2015-08-11 05:03:02	19:52:24	0	agasg3215	122345	123456	infoazul@hospital.com	1
30	26623	\N	UPJ S.A	2015-08-11 04:58:50	04:58:50	1	Ruta 225	54124214241	124421242144	info@upj.com.ar	1
33	38049	\N	Hospital Meredi	2015-08-14 18:53:53	18:53:53	1	Calle 26 30-42	768997654	320768765	meredic@gmail.com	0
\.


--
-- Data for Name: lectura_equipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY lectura_equipo (id, paciente_id, equipo_id, variable_id, lectura_numerica, lectura_texto, fecha_creacion) FROM stdin;
\.


--
-- Data for Name: medico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY medico (id, codigo_numerico, nombre, fecha_creacion, fecha_modificacion, estado, direccion, telefono_fijo, celular, borrado, mail, matricula_profesional) FROM stdin;
2	123412	Medico 1	2015-07-31 00:00:00	2015-07-31 00:00:00	1	Constitucion	124125	124342	\N	\N	asd41234
3	123412	Medico 1	2015-07-31 00:00:00	2015-07-31 00:00:00	1	Constitucion	124125	124342	\N	\N	asd41234
5	123412	Medico 1	2015-07-31 00:00:00	2015-07-31 00:00:00	1	Constitucion	124125	124342	\N	\N	asd41234
8	12345	Sebastian	2015-08-05 01:51:27	2015-08-05 01:51:27	1	25 de mayo	21435145	124151451	t	\N	asd41234
11	8	francisco gutierrez	2015-08-05 05:06:00	2015-08-05 05:06:00	1	calle 76 36 - 67	78272882	320859837	\N	\N	asd41234
12	98281	Doctora 	2015-08-11 00:29:19	2015-08-11 00:29:19	1	V lopez 1241	4565165		\N	\N	asd41234
13	36804	Juliana4	2015-08-11 00:39:09	2015-08-11 20:21:15	1	Necochea 12	15675644	12356612	\N		asd41234
14	7281	Lucas	2015-08-11 00:39:57	2015-08-11 00:39:57	1	Calle 1234	03210321	321321	\N	\N	asd41234
17	84002	Milagros	2015-08-11 00:54:12	2015-08-11 00:54:12	1	Calle falsa 1234	65152132	132313	\N	\N	asd41234
18	82675	Dr Sea 	2015-08-11 01:51:47	2015-08-11 02:04:37	1	Dorrego 3684	42002545	1211561321	t	doc@gmail.com	asd41234
22	50582	Jairo Beltrán	2015-08-11 20:18:58	2015-08-11 20:18:58	1	calle 97 # 45-68	787543567	310876567	f	Jbeltran@hotmail.com	asd41234
19	14047	Rovira	2015-08-11 05:47:54	2015-08-11 05:50:52	1	9 de julio 1254	1297689	67578675	t	rrovira@gmail.com	asd41234
23	40768	Jorge Rojas	2015-08-12 04:09:06	2015-08-12 04:09:06	1	calle 76 36 - 67	876567	3208975676	f		87653459POL
24	29562	Alfonso Medina	2015-08-12 23:56:01	2015-08-12 23:56:01	1	Calle 127  20-45 Bogotá	78764778	320897887	f	alfonsoMedina@gmail.com	6735373839KLJ
25	53799	Cesar camargo	2015-08-14 19:14:54	2015-08-14 19:14:54	1	Calle 26 30-42	78967567	345678678	f	Ccar@sgm.com	765467
\.


--
-- Data for Name: medico_cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY medico_cliente (id, medico_id, usuario_id, cliente_id) FROM stdin;
\.


--
-- Data for Name: nivel_alarma; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY nivel_alarma (id, examen_id, codigo_nivel_alarma, descripcion, fecha_creacion, fecha_modificacion, analisis_resultado, nro_repeticiones_minima, nro_repeticiones_maximo, tiempo, frecuencia, color, protocolo_id, tipo_alarma, borrado) FROM stdin;
5	1	37411	nivel de alarma 5	2015-08-12 00:26:05	2015-08-12 00:26:05	resultado	124	214	00:00:12	12	rojo	3	5	0
7	1	76974	descripcion	2015-08-12 00:28:59	2015-08-12 00:28:59	resultado	1234	234	00:00:23	234	rojo	3	5	0
6	1	76974	descripcion	2015-08-12 00:26:56	2015-08-12 00:26:56	resultado	1234	234	00:00:23	234	rojo	3	5	1
11	1	30068	alarma tensión arterial baja	2015-08-12 04:46:28	2015-08-12 04:46:28	baja	1	3	00:00:06	-1	negro	25	5	0
12	1	8685	saasd	2015-08-13 14:04:01	2015-08-13 14:04:01	Ninguno	2132	21312	00:03:33	Hora	red	2	10	0
13	1	62072	Alarma tensión arterial alta nivel bajo	2015-08-13 21:15:33	2015-08-13 21:15:33	Baja	1	2	00:00:01	Semana	yellow	25	16	0
1	1	1	sada	2015-01-01 00:00:00	2015-08-12 00:34:33	a	4	3	00:00:12	5	rojo	3	5	1
14	1	53210	tension arterial baja nivel 1	2015-08-14 19:36:03	2015-08-14 19:36:03	Baja	1	3	00:00:01	Semana	green	25	19	0
\.


--
-- Data for Name: paciente_aseguradora; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente_aseguradora (aseguradora_id, paciente_id, tipo, id) FROM stdin;
12	66	EPS/IPS	3
12	66	EPS/IPS	4
2	67	EPS/IPS	5
31	67	Prepaga	6
30	67	EPS/IPS	7
29	72	EPS/IPS	9
3	72	EPS/IPS	10
32	79	Prepaga	11
9	78	Prepaga	12
\.


--
-- Data for Name: paciente_cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente_cliente (paciente_id, cliente_id, id) FROM stdin;
\.


--
-- Data for Name: paciente_equipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente_equipo (paciente_id, equipo_id, id) FROM stdin;
61	2	1
62	1	2
62	3	3
62	1	4
62	3	5
62	21	6
62	23	7
62	21	8
64	13	9
64	13	10
64	16	11
67	17	12
67	17	13
67	15	14
67	15	15
67	15	16
67	15	17
68	13	18
72	30	24
78	14	25
79	15	26
79	34	27
80	48	28
\.


--
-- Data for Name: paciente_hospital; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente_hospital (paciente_id, hospital_id, prioridad, tipo, id) FROM stdin;
66	10	4	1	2
66	25	6	1	3
67	21	1	1	4
67	29	1	1	5
67	22	1	1	6
72	25	1	1	15
78	22	1	1	17
79	22	1	1	18
\.


--
-- Data for Name: pacientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pacientes (id, cedula, nombres, apellidos, fecha_afiliacion, fecha_creacion, fecha_modificacion, foto, direccion, barrio, ciudad, fecha_nacimiento, estatura, peso, estado, telefono_fijo, celular, mail, fecha_inicio_contrato, fecha_fin_contrato, observaciones, borrado) FROM stdin;
40	466546	Paciente 	De pureba	2015-08-05 11:45:58	2015-08-05 11:45:58	2015-08-05 11:45:58	imagen01	25 de mayo 1458	Lujan	Tandil	2015-08-05	1.70	100.00	1	13216	65165	adsgadsgadsgadsg	2015-08-05	2015-08-05	safdasfsafa	1
43	32123	Jonathan	Lezaeta	2015-08-05 11:53:22	2015-08-05 11:53:22	2015-08-05 11:53:22	imagen01	25 de mayo 1458	Lujan	Tandil	2015-08-13	1.77	80.00	1	516516	16565	adsgadsgadsgadsg	2015-08-13	2015-08-12	safdasfsafa	1
55	61651	Paciente 1	Apellido 1	2015-08-12 23:29:39	2015-08-12 23:29:39	2015-08-12 23:29:39	imagen01	ioasjdiop	jkoip	joip	2015-08-12	124.00	12.00	1	2141342	124124	adsgadsgadsgadsg	2015-08-01	2015-08-01	safdasfsafa	0
56	1354231	afsdfadsf	asdfasd	2015-08-13 00:29:37	2015-08-13 00:29:37	2015-08-13 00:29:37	imagen01	fasdfs	dfasdfas	dfasdf	2015-08-04	12.00	21.00	1	12412354	3412341	adsgadsgadsgadsg	2015-08-11	2015-08-07	safdasfsafa	0
59	214124	adsfa	sdfasd	2015-08-13 00:33:24	2015-08-13 00:33:24	2015-08-13 00:33:24	imagen01	fasdfafd	adsfa	dfasdf	2015-08-13	31.00	12.00	1	31252345	1235123	adsgadsgadsgadsg	2015-08-27	2015-08-20	safdasfsafa	0
61	31251325	efadfa	dsfasdf	2015-08-13 01:54:18	2015-08-13 01:54:18	2015-08-13 01:54:18	imagen01	asdfadsf	fdasdf	asdfasdf	2015-08-15	123.00	123.00	1	1234	21	adsgadsgadsgadsg	2015-08-19	2015-08-20	safdasfsafa	0
64	21341234	asdasd	sdasda	2015-08-13 23:12:51	2015-08-13 23:12:51	2015-08-13 23:12:51	imagen01	sdasd	sdasfa	dfasd	2015-08-28	4124.00	41.00	1	432141	124	adsgadsgadsgadsg	2015-08-06	2015-08-21	safdasfsafa	0
65	12412	iñj	ioj	2015-08-14 00:13:07	2015-08-14 00:13:07	2015-08-14 00:13:07	imagen01	ioj	ioji	oi	2015-12-31	123.00	21.00	1	21312	12414	adsgadsgadsgadsg	2015-12-31	2015-12-31	safdasfsafa	0
66	8676	joioj	ioj	2015-08-14 02:25:43	2015-08-14 02:25:43	2015-08-14 02:25:43	imagen01	oj	oj	oj	2015-12-31	12.00	12.00	1	213	12312	adsgadsgadsgadsg	2015-12-31	2015-12-31	safdasfsafa	0
67	13413453125	sdgdgaa	dgasgdasdg	2015-08-14 04:06:36	2015-08-14 04:06:36	2015-08-14 04:06:36	imagen01	sdgadg	asdgasg	sadgs	2015-08-14	12.00	12.00	1	213412345	2134512	adsgadsgadsgadsg	2015-08-06	2015-08-06	safdasfsafa	0
2	123	seba	seba	2015-07-24 00:00:00	2015-07-31 00:00:00	2015-07-12 00:00:00	lalala	seba	seba	seba	2015-07-24	12.00	12.00	1	12324	2413414	adsgadsgadsgadsg	2015-07-31	2015-07-31	safdasfsafa	0
30	12345656567	Sebastian	Luguercio	2015-08-05 10:53:04	2015-08-05 10:53:04	2015-08-05 10:53:04	imagen01	25 de mayo 1458	Santa Lucia	Azul	2015-08-27	1.77	80.00	1	23512345125	123512351235123	adsgadsgadsgadsg	2015-08-11	2015-08-18	safdasfsafa	0
62	13241351	ewfadsfasdf	asdfad	2015-08-13 21:24:37	2015-08-13 21:24:37	2015-08-13 21:24:37	imagen01	fadsfadfa	dfadfadf	adfadf	2015-08-14	13.00	122.00	1	412451325	123521	adsgadsgadsgadsg	2015-08-19	2015-08-27	safdasfsafa	1
68	36745398	jonathan	Lezaeta	2015-08-14 05:32:11	2015-08-14 05:32:11	2015-08-14 05:32:11	imagen01	asd	asd	asd	2015-12-31	177.00	82.00	1	213241	12341	adsgadsgadsgadsg	2015-12-31	2015-12-31	safdasfsafa	0
69	41241244	asd	jn	2015-08-14 05:43:05	2015-08-14 05:43:05	2015-08-14 05:43:05	imagen01	n	jk	nk	2015-12-31	166.00	122.00	1	2213	1234	adsgadsgadsgadsg	2015-12-30	2015-12-31	safdasfsafa	0
70	41241244	asd	jn	2015-08-14 05:44:53	2015-08-14 05:44:53	2015-08-14 05:44:53	imagen01	n	jk	nk	2015-12-31	166.00	122.00	1	2213	1234	adsgadsgadsgadsg	2015-12-30	2015-12-31	safdasfsafa	0
71	1234	fsadfdsf	sadfadsf	2015-08-14 06:00:11	2015-08-14 06:00:11	2015-08-14 06:00:11	imagen01	afdfadf	asdfas	dfasdfads	2015-08-24	123.00	121.00	1	3153251325123	512351235	adsgadsgadsgadsg	2015-07-30	2015-08-20	safdasfsafa	0
72	786876	huihi	hiu	2015-08-14 06:13:48	2015-08-14 06:13:48	2015-08-14 06:13:48	imagen01	h	iuhi	hi	2015-12-31	87.00	9.00	1	19	87	adsgadsgadsgadsg	2014-12-31	2015-12-31	safdasfsafa	0
73	20679665	Ana maría	Rodríguez 	2015-08-14 12:12:23	2015-08-14 12:12:23	2015-08-14 12:12:23	imagen01	calle 116 # 89-56 	Cedritos	bogota	1965-11-04	1.62	68.00	1	7876565	320789678	adsgadsgadsgadsg	2015-01-01	2015-12-31	safdasfsafa	0
74	2412	Diego	Gonzales	2015-08-14 13:14:28	2015-08-14 13:14:28	2015-08-14 13:14:28	imagen01	Alem 856	Centro	Tandil	1992-08-14	177.00	80.00	1	1233211223	421423	adsgadsgadsgadsg	2014-11-01	2015-08-30	safdasfsafa	0
75	2412	Diego	Gonzales	2015-08-14 13:15:13	2015-08-14 13:15:13	2015-08-14 13:15:13	imagen01	Alem 856	Centro	Tandil	1992-08-14	177.00	80.00	1	1233211223	421423	adsgadsgadsgadsg	2014-11-01	2015-08-30	safdasfsafa	0
76	2412	Diego	Gonzales	2015-08-14 13:15:25	2015-08-14 13:15:25	2015-08-14 13:15:25	imagen01	Alem 856	Centro	Tandil	1992-08-14	177.00	80.00	1	1233211223	421423	adsgadsgadsgadsg	2014-11-01	2015-08-30	safdasfsafa	0
77	2412	Diego	Gonzales	2015-08-14 13:16:09	2015-08-14 13:16:09	2015-08-14 13:16:09	imagen01	Alem 856	Centro	Tandil	1992-08-14	177.00	80.00	1	1233211223	421423	adsgadsgadsgadsg	2014-11-01	2015-08-30	safdasfsafa	0
78	2412	Diego	Gonzales	2015-08-14 13:17:14	2015-08-14 13:17:14	2015-08-14 13:17:14	imagen01	Alem 856	Centro	Tandil	1992-08-14	177.00	80.00	1	1233211223	421423	adsgadsgadsgadsg	2014-11-01	2015-08-30	safdasfsafa	0
79	3252545	Sebastian	Luguercio	2015-08-14 13:23:28	2015-08-14 13:23:28	2015-08-14 13:23:28	imagen01	Calle 3 221	Santa Lucia	Azul	2015-08-26	12.00	213.00	1	32152352555551	1231	adsgadsgadsgadsg	2015-08-01	2015-08-14	safdasfsafa	0
80	79678654	Alexander	Sierra	2015-08-14 17:19:52	2015-08-14 17:19:52	2015-08-14 17:19:52	imagen01	Calle 147 #45-68	Cedritos	bogota	1965-01-28	1.65	69.00	1	7898789	310789789	adsgadsgadsgadsg	2015-01-01	2015-12-31	safdasfsafa	0
81	52789678	gina paola	ramirez	2015-08-14 19:47:53	2015-08-14 19:47:53	2015-08-14 19:47:53	imagen01	Calle 94 14-49	chico	Bogota	1963-02-02	1.70	56.00	1	7678967	320897867	adsgadsgadsgadsg	2015-08-02	2016-12-31	safdasfsafa	0
\.


--
-- Data for Name: programa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY programa (id, paciente_id, examen_id, variable_id, valor_frecuencia, frecuencia, valor_maximo, valor_minimo, documento, observaciones, borrado) FROM stdin;
1	2	1	1	23	23	23	23	23	Ninguna	0
\.


--
-- Data for Name: protocolo_nivel_alarma; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY protocolo_nivel_alarma (id, protocolo_id, nivel_alarma_id) FROM stdin;
\.


--
-- Data for Name: protocolos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY protocolos (id, codigo_protocolo, nombre, descripcion, fecha_creacion, fecha_modificacion, version, estado, sms, mail, borrado) FROM stdin;
3	1342512	Sebastian 	Descripcion	2015-08-05 12:28:26	2015-08-11 07:26:56	1.0	1	1	1	1
1	351251	sebastian peréz	asfad	2015-08-19 00:00:00	2015-08-11 07:27:29	2.0	1	1	1	1
14	999	uiiouhhio	vcbvjuysusgjhshgjxvjxvf hdhfhkjfhshfsfshf	2015-08-09 04:23:48	2015-08-09 04:23:48	1.0	1	1	1	1
2	456	Jonathan pp	asfad	2015-08-19 00:00:00	2015-08-11 20:44:29	3.0	1	1	1	1
25	45495	azucar baja	se debe llamar al señor......\r\nlvkldfkdgkgjdkflsdglkdlgkdñlfldkgldmfgfb\r\nsfldglfdfmmb,dmmdbldfkbfdbmdfbkdmblkmblmb\r\nfdmdmmggmm,m,dmmdmd.fm\r\ndddlkgldgdgdkngdgkddkngnnkdmldmmgdmmgll\r\ndldkglllfgldkgmdkfmdkglglmg\r\nadslfklslgldg{dlglggkdgkdkgldkglklgkff	2015-08-12 04:14:22	2015-08-12 04:14:22	1.0	1	1	1	0
28	78814	pp	1. Se debe dgdffghnjkjhgfdxghccgbbbjnn\r\nGhihgjnvgyfdyjhgffgjknugfgjkknhgffvvjikkk\r\nGhjkkjhj	2015-08-13 23:13:58	2015-08-13 23:13:58	1.0	1	1	1	0
29	78814	pp	1. Se debe dgdffghnjkjhgfdxghccgbbbjnn\r\nGhihgjnvgyfdyjhgffgjknugfgjkknhgffvvjikkk\r\nGhjkkjhj	2015-08-14 00:12:52	2015-08-14 00:12:52	1.0	1	1	1	0
\.


--
-- Data for Name: rol_credencial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rol_credencial (id, credencial_id, roles_id) FROM stdin;
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY roles (id, rol, orden) FROM stdin;
1	Administrador	1
2	Medico	1
\.


--
-- Data for Name: tipo_equipos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_equipos (id, codigo_tipo, referencia, frecha_creacion, fecha_modificacion, borrado) FROM stdin;
1	123	Referenciado 	2015-06-06 00:00:00	2015-08-12 00:31:11	f
2	69000	Rerferencia 205	2015-08-11 02:49:00	2015-08-12 00:34:01	f
3	91656	Ejemplo 1	2015-08-12 01:08:05	2015-08-12 01:08:29	t
4	94784	Ejemplo 4	2015-08-12 01:14:37	2015-08-12 01:15:12	f
5	31726	Espirometros2	2015-08-12 04:19:26	2015-08-12 04:20:49	f
6	61050	Monitor Signos Vitales	2015-08-13 05:04:01	2015-08-13 05:04:01	f
7	29440	Monitor signos vitales	2015-08-14 19:37:16	2015-08-14 19:37:16	f
\.


--
-- Data for Name: tipos_alarmas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipos_alarmas (id, codigo_tipo_alarma, descripcion, fecha_creacion, fecha_modificacion, examen_id, borrado) FROM stdin;
4	122	descripcion1	2015-07-31 00:00:00	2015-08-10 20:34:30	1	1
15	82846	Alarma test	2015-08-11 07:09:34	2015-08-11 07:09:49	15	1
10	64718	Alarma BA	2015-08-11 06:48:46	2015-08-11 07:03:24	3	1
5	4495	Alarma A	2015-08-11 06:44:00	2015-08-11 06:44:00	1	0
11	93566	Alarma Z	2015-08-11 06:50:15	2015-08-11 06:50:15	16	0
12	54257	Alarma X	2015-08-11 06:53:18	2015-08-11 06:53:18	7	0
13	2297	Alarma K	2015-08-11 06:54:29	2015-08-11 06:54:29	16	0
17	17559	espirometria alta	2015-08-12 04:23:15	2015-08-12 04:23:15	20	0
16	46124	Alarma tensión arterial alta	2015-08-11 20:52:41	2015-08-11 20:52:41	1	0
18	12750	tension alta	2015-08-14 00:14:12	2015-08-14 00:14:12	1	0
14	2297	Alarma K	2015-08-11 06:54:56	2015-08-11 06:54:56	16	1
19	31033	tension arterial baja	2015-08-14 19:32:31	2015-08-14 19:32:31	22	0
\.


--
-- Data for Name: tipos_clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipos_clientes (id, codigo_tipo_cliente, descripcion, fecha_creacion, creado_por, fecha_modificacion, modificado_por, borrado) FROM stdin;
3	15921	Cliente C	2015-08-11 00:53:18	1	2015-08-11 00:53:18	1	0
1	1	Cliente B	2015-06-06 00:00:00	1	2015-06-06 00:00:00	1	1
2	2	Tipo cliente 22	2015-06-09 00:00:00	1	2015-09-09 00:00:00	1	1
4	159212	Cliente B3	2015-08-11 00:55:22	1	2015-08-11 00:55:22	1	0
10	1315	Hospitales	2015-08-13 05:21:38	1	2015-08-13 05:21:38	1	1
7	55480	Premium	2015-08-11 07:41:54	1	2015-08-11 07:41:54	1	0
6	9735	Clience D	2015-08-11 06:10:03	1	2015-08-11 06:10:03	1	0
5	93286	Cliente W	2015-08-11 04:39:27	1	2015-08-11 04:39:27	1	1
11	47592	Cliente de prueba	2015-08-13 19:40:53	1	2015-08-13 19:40:53	1	0
8	32583	EPS	2015-08-11 20:28:41	1	2015-08-11 20:28:41	1	0
12	23086	Prepagada	2015-08-13 20:52:30	1	2015-08-13 20:52:30	1	0
13	29296	IPS	2015-08-14 19:27:26	1	2015-08-14 19:27:26	1	0
\.


--
-- Data for Name: tiposa_nivela; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tiposa_nivela (id, nivel_alarma_id, tipos_alarma_id) FROM stdin;
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuarios (id, cedula, nombres, apellidos, usuario, clave, roles, mail, fecha_creacion, fecha_modificacion, fecha_ultimo_ingreso, ultimo_tiempo_sesion, estado, borrado) FROM stdin;
65	872474	Marcelo	Lezaeta	mlezaeta	420768	1	jona@gmail.com	2015-08-11 04:47:56	2015-08-11 04:47:56	2015-08-01 00:00:00	00:00:00	t	f
82	52865386	pepe	Argento	pmantilla	12345	1	pmantill	2015-08-11 04:47:01	2015-08-11 04:47:01	2015-08-10 18:06:48	00:00:00	t	t
83	52865386	gina paola	Ramirez	gramirez	876655555	1	gineypaola@hotmail.com	2015-08-11 15:54:24	2015-08-11 15:54:24	2015-08-11 15:54:24	15:54:24	t	f
84	52865386	Jose Fernando2	Peña	JPeña	*****************	2	JosePena@hotmail.com	2015-08-11 17:43:32	2015-08-11 17:43:32	2015-08-11 17:32:25	00:00:00	t	f
69	49849	Juan Andrez	Ortiz	jao	123456	1	vortiz@gmail.com	2015-08-06 23:40:57	2015-08-06 23:40:57	2015-08-06 23:40:57	23:40:57	t	f
67	124312	Martin 	Rodriguez	mcavallieri	1234563	2	mcavallieri@gmail.com	2015-08-11 17:50:21	2015-08-11 17:50:21	2015-08-05 11:26:15	00:00:00	t	t
1	1	jonathan	lezaeta	adm	1	1	jonathan.lezaeta@gmail.com	2015-05-05 00:00:00	2015-06-06 00:00:00	2015-05-05 00:00:00	00:00:01	t	f
62	152639	Maria	prueba	mprueba	123456	1	maria@gmail.com	2015-08-08 00:55:31	2015-08-08 00:55:31	2015-07-31 00:00:00	00:00:00	t	t
75	45675	Alfredo	Gomez	agomez	654321	2	agomez@gmail.com	2015-08-07 00:37:44	2015-08-07 00:37:44	2015-08-07 00:31:29	00:00:00	t	f
76	165132	Gina	Martinez	gmartinez	599852	2	gmartinez@gmail.com	2015-08-07 00:43:45	2015-08-07 00:43:45	2015-08-07 00:42:09	00:00:00	t	f
68	49849	Vanesa	Ortiz	vortiz	123456	2	vortiz@gmail.com	2015-08-06 23:40:17	2015-08-06 23:40:17	2015-08-06 23:40:17	23:40:17	t	t
66	124124	Roberto2	Rodriguez	rrodriguez	123456	1	rrodriguez@gmail.com	2015-08-07 17:43:01	2015-08-07 17:43:01	2015-08-05 03:18:33	00:00:00	t	t
59	36745398	Jonathan	Lezaeta2	jlezaeta	420768	1	jona1@gmail.com	2015-08-07 17:41:44	2015-08-07 17:41:44	2015-12-31 00:00:00	00:00:00	t	t
78	52865879	gina paola	Ramirez belran	gramirez	gramirez	1	gramirez@hotmail.com	2015-08-07 01:09:19	2015-08-07 01:09:19	2015-08-07 01:06:50	00:00:00	t	t
79	52865386	Oscar	Peréz	Operez	8	1	operez	2015-08-07 14:03:06	2015-08-07 14:03:06	2015-08-07 14:03:06	14:03:06	t	f
80	52865386	Maria	Perez	mperez	8888	1	mperez	2015-08-07 14:04:16	2015-08-07 14:04:16	2015-08-07 14:04:16	14:04:16	t	f
81	528964393849	woiiruoiee	rodriguez	gramire		1	hhhhhhhhh	2015-08-07 14:14:25	2015-08-07 14:14:25	2015-08-07 14:12:25	00:00:00	t	t
74	876555	Sofia	Luna	sluna	420768	1	uuu	2015-08-11 17:47:36	2015-08-11 17:47:36	2015-08-07 00:30:46	00:00:00	t	t
85	52678567	gina paola2	ramirez	gramirez	45435	1	grsmirez@sgm.com.co	2015-08-14 18:45:46	2015-08-14 18:45:46	2015-08-14 18:41:26	00:00:00	t	f
86	78678567					1		2015-08-14 18:49:28	2015-08-14 18:49:28	2015-08-14 18:49:28	18:49:28	t	f
\.


--
-- Data for Name: variables; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY variables (id, codigo_variable, hl7tag, descripcion, fecha_creacion, fecha_modificacion, examen_id, borrado) FROM stdin;
1	87963	No se que es	Variable 1	2015-06-06 00:00:00	2015-06-06 00:00:00	1	1
17	82754	CVF	CVF	2015-08-13 04:51:19	2015-08-13 04:51:19	20	1
7	34134	Algo	Descripcion	2015-08-05 13:16:39	2015-08-05 13:16:39	1	0
8	341351	hl7tag	Descripcion	2015-08-05 13:17:23	2015-08-05 13:17:23	1	0
9	61486	Valor	Variable 1 Diabetes	2015-08-12 15:08:32	2015-08-12 15:08:32	3	0
10	61486	Valor	Pico alto Diabetes	2015-08-12 15:08:33	2015-08-12 15:08:33	3	0
11	61486	Valor	Variable 3	2015-08-12 15:08:54	2015-08-12 15:08:54	1	0
12	29937	Valor	Glucosa Baja	2015-08-12 15:11:31	2015-08-12 15:11:31	3	0
13	29937	Valor	Glucosa Media	2015-08-12 15:12:57	2015-08-12 15:12:57	3	0
14	26660	Valor	Variable 2 diabetes	2015-08-12 15:18:38	2015-08-12 15:18:38	1	0
15	79141	Valor	Alta	2015-08-12 15:29:37	2015-08-12 15:29:37	1	0
16	48931	Valor	Baja	2015-08-12 15:29:50	2015-08-12 15:29:50	1	0
18	45288	SPO2	SPO2	2015-08-13 22:24:22	2015-08-13 22:24:22	20	0
20	6982	SIS	sistole	2015-08-14 19:22:29	2015-08-14 19:22:29	22	1
19	94189	DIS	diastole	2015-08-14 19:21:42	2015-08-14 19:21:42	22	1
\.


--
-- Name: PK1; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Credencial"
    ADD CONSTRAINT "PK1" PRIMARY KEY (id);


--
-- Name: PK10; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY medico_cliente
    ADD CONSTRAINT "PK10" PRIMARY KEY (id);


--
-- Name: PK11; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY medico
    ADD CONSTRAINT "PK11" PRIMARY KEY (id);


--
-- Name: PK13; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pacientes
    ADD CONSTRAINT "PK13" PRIMARY KEY (id);


--
-- Name: PK15; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contactos
    ADD CONSTRAINT "PK15" PRIMARY KEY (id);


--
-- Name: PK17; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY equipos
    ADD CONSTRAINT "PK17" PRIMARY KEY (id);


--
-- Name: PK19; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_equipos
    ADD CONSTRAINT "PK19" PRIMARY KEY (id);


--
-- Name: PK2; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rol_credencial
    ADD CONSTRAINT "PK2" PRIMARY KEY (id, credencial_id, roles_id);


--
-- Name: PK20; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estado_equipo
    ADD CONSTRAINT "PK20" PRIMARY KEY (id);


--
-- Name: PK21; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY historial_equipo_estado
    ADD CONSTRAINT "PK21" PRIMARY KEY (id, estadoeq_id);


--
-- Name: PK23; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY aseguradoras
    ADD CONSTRAINT "PK23" PRIMARY KEY (id);


--
-- Name: PK25; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY hospitales
    ADD CONSTRAINT "PK25" PRIMARY KEY (id);


--
-- Name: PK26; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY lectura_equipo
    ADD CONSTRAINT "PK26" PRIMARY KEY (id);


--
-- Name: PK27; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY variables
    ADD CONSTRAINT "PK27" PRIMARY KEY (id);


--
-- Name: PK28; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY programa
    ADD CONSTRAINT "PK28" PRIMARY KEY (id);


--
-- Name: PK29; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cambios_programas
    ADD CONSTRAINT "PK29" PRIMARY KEY (id);


--
-- Name: PK31; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY examen_equipo
    ADD CONSTRAINT "PK31" PRIMARY KEY (id);


--
-- Name: PK34; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY examenes
    ADD CONSTRAINT "PK34" PRIMARY KEY (id);


--
-- Name: PK35; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY alarmas_generadas
    ADD CONSTRAINT "PK35" PRIMARY KEY (id);


--
-- Name: PK36; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estados_alarmas
    ADD CONSTRAINT "PK36" PRIMARY KEY (id);


--
-- Name: PK37; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY alarmas_historial
    ADD CONSTRAINT "PK37" PRIMARY KEY (id);


--
-- Name: PK38; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipos_alarmas
    ADD CONSTRAINT "PK38" PRIMARY KEY (id);


--
-- Name: PK39; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tiposa_nivela
    ADD CONSTRAINT "PK39" PRIMARY KEY (id);


--
-- Name: PK4; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY roles
    ADD CONSTRAINT "PK4" PRIMARY KEY (id);


--
-- Name: PK40; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nivel_alarma
    ADD CONSTRAINT "PK40" PRIMARY KEY (id);


--
-- Name: PK41; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY protocolo_nivel_alarma
    ADD CONSTRAINT "PK41" PRIMARY KEY (id);


--
-- Name: PK42; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY protocolos
    ADD CONSTRAINT "PK42" PRIMARY KEY (id);


--
-- Name: PK5; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT "PK5" PRIMARY KEY (id);


--
-- Name: PK6; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY company
    ADD CONSTRAINT "PK6" PRIMARY KEY (id);


--
-- Name: PK8; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY clientes
    ADD CONSTRAINT "PK8" PRIMARY KEY (id);


--
-- Name: PK9; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipos_clientes
    ADD CONSTRAINT "PK9" PRIMARY KEY (id);


--
-- Name: calibracion_equipo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY calibracion_equipo
    ADD CONSTRAINT calibracion_equipo_pkey PRIMARY KEY (id);


--
-- Name: contacto_paciente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contacto_paciente
    ADD CONSTRAINT contacto_paciente_pkey PRIMARY KEY (id);


--
-- Name: equipo_examen_varibles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY equipo_examen_varibles
    ADD CONSTRAINT equipo_examen_varibles_pkey PRIMARY KEY (id);


--
-- Name: paciente_aseguradora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paciente_aseguradora
    ADD CONSTRAINT paciente_aseguradora_pkey PRIMARY KEY (id);


--
-- Name: paciente_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paciente_cliente
    ADD CONSTRAINT paciente_cliente_pkey PRIMARY KEY (id);


--
-- Name: paciente_equipo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paciente_equipo
    ADD CONSTRAINT paciente_equipo_pkey PRIMARY KEY (id);


--
-- Name: paciente_hospital_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paciente_hospital
    ADD CONSTRAINT paciente_hospital_pkey PRIMARY KEY (id);


--
-- Name: RefCredencial109; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rol_credencial
    ADD CONSTRAINT "RefCredencial109" FOREIGN KEY (credencial_id) REFERENCES "Credencial"(id);


--
-- Name: RefEquipo88; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipo_examen_varibles
    ADD CONSTRAINT "RefEquipo88" FOREIGN KEY (examen_equipo_id) REFERENCES equipos(id);


--
-- Name: Refalarmas_generadas95; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alarmas_historial
    ADD CONSTRAINT "Refalarmas_generadas95" FOREIGN KEY (alarma_generada_id) REFERENCES alarmas_generadas(id);


--
-- Name: Refaseguradoras67; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_aseguradora
    ADD CONSTRAINT "Refaseguradoras67" FOREIGN KEY (aseguradora_id) REFERENCES aseguradoras(id);


--
-- Name: Refclientes39; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medico_cliente
    ADD CONSTRAINT "Refclientes39" FOREIGN KEY (usuario_id) REFERENCES clientes(id);


--
-- Name: Refclientes43; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_cliente
    ADD CONSTRAINT "Refclientes43" FOREIGN KEY (cliente_id) REFERENCES clientes(id);


--
-- Name: Refequipos56; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_equipo
    ADD CONSTRAINT "Refequipos56" FOREIGN KEY (equipo_id) REFERENCES equipos(id);


--
-- Name: Refequipos57; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY calibracion_equipo
    ADD CONSTRAINT "Refequipos57" FOREIGN KEY (equipo_id) REFERENCES equipos(id);


--
-- Name: Refequipos63; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY historial_equipo_estado
    ADD CONSTRAINT "Refequipos63" FOREIGN KEY (equipo_id) REFERENCES equipos(id);


--
-- Name: Refequipos71; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lectura_equipo
    ADD CONSTRAINT "Refequipos71" FOREIGN KEY (equipo_id) REFERENCES equipos(id);


--
-- Name: Refequipos84; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY examen_equipo
    ADD CONSTRAINT "Refequipos84" FOREIGN KEY (equipo_id) REFERENCES equipos(id);


--
-- Name: Refestado_equipo61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipos
    ADD CONSTRAINT "Refestado_equipo61" FOREIGN KEY (estado_id) REFERENCES estado_equipo(id);


--
-- Name: Refestado_equipo64; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY historial_equipo_estado
    ADD CONSTRAINT "Refestado_equipo64" FOREIGN KEY (estadoeq_id) REFERENCES estado_equipo(id);


--
-- Name: Refestados_alarmas91; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alarmas_generadas
    ADD CONSTRAINT "Refestados_alarmas91" FOREIGN KEY (estado_id) REFERENCES estados_alarmas(id);


--
-- Name: Refexamenes85; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY variables
    ADD CONSTRAINT "Refexamenes85" FOREIGN KEY (examen_id) REFERENCES examenes(id);


--
-- Name: Refexamenes86; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY programa
    ADD CONSTRAINT "Refexamenes86" FOREIGN KEY (examen_id) REFERENCES examenes(id);


--
-- Name: Refexamenes87; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipo_examen_varibles
    ADD CONSTRAINT "Refexamenes87" FOREIGN KEY (examne_id) REFERENCES examenes(id);


--
-- Name: Refexamenes88; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY examen_equipo
    ADD CONSTRAINT "Refexamenes88" FOREIGN KEY (examen_id) REFERENCES examenes(id);


--
-- Name: Refexamenes92; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alarmas_generadas
    ADD CONSTRAINT "Refexamenes92" FOREIGN KEY (examen_id) REFERENCES examenes(id);


--
-- Name: Refexamenes96; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_alarmas
    ADD CONSTRAINT "Refexamenes96" FOREIGN KEY (examen_id) REFERENCES examenes(id);


--
-- Name: Refexamenes98; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nivel_alarma
    ADD CONSTRAINT "Refexamenes98" FOREIGN KEY (examen_id) REFERENCES examenes(id);


--
-- Name: Refhospitales68; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_hospital
    ADD CONSTRAINT "Refhospitales68" FOREIGN KEY (hospital_id) REFERENCES hospitales(id);


--
-- Name: Reflectura_equipo89; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alarmas_generadas
    ADD CONSTRAINT "Reflectura_equipo89" FOREIGN KEY (lectura_id) REFERENCES lectura_equipo(id);


--
-- Name: Refmedico41; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medico_cliente
    ADD CONSTRAINT "Refmedico41" FOREIGN KEY (medico_id) REFERENCES medico(id);


--
-- Name: Refnivel_alarma103; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY protocolo_nivel_alarma
    ADD CONSTRAINT "Refnivel_alarma103" FOREIGN KEY (nivel_alarma_id) REFERENCES nivel_alarma(id);


--
-- Name: Refpacientes112; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alarmas_generadas
    ADD CONSTRAINT "Refpacientes112" FOREIGN KEY (paciente_id) REFERENCES pacientes(id);


--
-- Name: Refpacientes45; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_cliente
    ADD CONSTRAINT "Refpacientes45" FOREIGN KEY (paciente_id) REFERENCES pacientes(id);


--
-- Name: Refpacientes47; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_equipo
    ADD CONSTRAINT "Refpacientes47" FOREIGN KEY (paciente_id) REFERENCES pacientes(id);


--
-- Name: Refpacientes66; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_aseguradora
    ADD CONSTRAINT "Refpacientes66" FOREIGN KEY (paciente_id) REFERENCES pacientes(id);


--
-- Name: Refpacientes70; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente_hospital
    ADD CONSTRAINT "Refpacientes70" FOREIGN KEY (paciente_id) REFERENCES pacientes(id);


--
-- Name: Refpacientes73; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lectura_equipo
    ADD CONSTRAINT "Refpacientes73" FOREIGN KEY (paciente_id) REFERENCES pacientes(id);


--
-- Name: Refpacientes78; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY programa
    ADD CONSTRAINT "Refpacientes78" FOREIGN KEY (paciente_id) REFERENCES pacientes(id);


--
-- Name: Refprograma82; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cambios_programas
    ADD CONSTRAINT "Refprograma82" FOREIGN KEY (programa_id) REFERENCES programa(id);


--
-- Name: Refprotocolos102; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY protocolo_nivel_alarma
    ADD CONSTRAINT "Refprotocolos102" FOREIGN KEY (protocolo_id) REFERENCES protocolos(id);


--
-- Name: Refroles110; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rol_credencial
    ADD CONSTRAINT "Refroles110" FOREIGN KEY (roles_id) REFERENCES roles(id);


--
-- Name: Refroles111; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT "Refroles111" FOREIGN KEY (roles) REFERENCES roles(id);


--
-- Name: Reftipo_equipos60; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipos
    ADD CONSTRAINT "Reftipo_equipos60" FOREIGN KEY (tipo_equipo) REFERENCES tipo_equipos(id);


--
-- Name: Reftipos_alarmas100; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nivel_alarma
    ADD CONSTRAINT "Reftipos_alarmas100" FOREIGN KEY (tipo_alarma) REFERENCES tipos_alarmas(id);


--
-- Name: Reftipos_alarmas97; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tiposa_nivela
    ADD CONSTRAINT "Reftipos_alarmas97" FOREIGN KEY (tipos_alarma_id) REFERENCES tipos_alarmas(id);


--
-- Name: Reftipos_clientes29; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clientes
    ADD CONSTRAINT "Reftipos_clientes29" FOREIGN KEY (tipo_cliente) REFERENCES tipos_clientes(id);


--
-- Name: Refusuarios22; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_clientes
    ADD CONSTRAINT "Refusuarios22" FOREIGN KEY (creado_por) REFERENCES usuarios(id);


--
-- Name: Refusuarios24; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_clientes
    ADD CONSTRAINT "Refusuarios24" FOREIGN KEY (modificado_por) REFERENCES usuarios(id);


--
-- Name: Refvariables76; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lectura_equipo
    ADD CONSTRAINT "Refvariables76" FOREIGN KEY (variable_id) REFERENCES variables(id);


--
-- Name: Refvariables81; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY programa
    ADD CONSTRAINT "Refvariables81" FOREIGN KEY (variable_id) REFERENCES variables(id);


--
-- Name: Refvariables83; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipo_examen_varibles
    ADD CONSTRAINT "Refvariables83" FOREIGN KEY (variable_id) REFERENCES variables(id);


--
-- Name: calibracion_equipo_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY calibracion_equipo
    ADD CONSTRAINT calibracion_equipo_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES usuarios(id);


--
-- Name: contacto_paciente_contacto_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contacto_paciente
    ADD CONSTRAINT contacto_paciente_contacto_id_fkey FOREIGN KEY (paciente_id) REFERENCES pacientes(id);


--
-- Name: contacto_paciente_paciente_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contacto_paciente
    ADD CONSTRAINT contacto_paciente_paciente_id_fkey FOREIGN KEY (contacto_id) REFERENCES contactos(id);


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

