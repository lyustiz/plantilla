-- POSTGRES

DROP TABLE "control_perceptivo"."control_perceptivo";

CREATE TABLE "control_perceptivo"."control_perceptivo" (
  "id_control_perceptivo" serial NOT NULL,
  "co_control_perceptivo" character varying(15) NOT NULL,
  "co_usuario" character varying(50) NOT NULL,
  "id_status" numeric(3) DEFAULT 1 NOT NULL,
  "tx_observacion" character varying(150),
  "fe_creado" timestamp without time zone NOT NULL,
  "fe_actualizado" timestamp without time zone
);

ALTER TABLE "control_perceptivo"."control_perceptivo" ADD CONSTRAINT uk_control_perceptivo_co_control_perceptivo UNIQUE ("co_control_perceptivo");

DROP TABLE "control_perceptivo"."activo";
CREATE TABLE "control_perceptivo"."activo" (
  "id_detalle" numeric(15, 0) NOT NULL,
  "id_control_perceptivo" numeric(15, 0) NOT NULL,
  "id_activo" serial NOT NULL,
  "ca_activo" character varying(150) NOT NULL,
  "tx_descripcion" character varying(150),
  "md_activo" character varying(150),
  "tx_color_activo" character varying(150),
  "nb_fabricante" character varying(150),
  "co_modelo" character varying(150),
  "co_serial" character varying(150),
  "nb_moneda" character varying(150),
  "co_etiqueta" character varying(150),
  "mo_precio_unitario" character varying(150),
  "mo_precio_total" character varying(150),
  "co_usuario" character varying(50) NOT NULL,
  "id_status" numeric(3, 0) DEFAULT 1 NOT NULL,
  "tx_observacion" character varying(150),
  "fe_creado" timestamp without time zone NOT NULL,
  "fe_actualizado" timestamp without time zone
);

DROP TABLE "control_perceptivo"."detalle";
CREATE TABLE "control_perceptivo"."detalle" (
  "id_detalle" serial NOT NULL,
  "id_control_perceptivo" numeric(15, 0) NOT NULL,
  "tx_tipo_detalle" character varying(150) NOT NULL,
  "co_control_perceptivo" character varying(150) NOT NULL,
  "tx_tipo_entrega" character varying(150),
  "tx_tipo_asignacion" character varying(150),
  "mo_orden_compra" character varying(150),
  "mo_factura" character varying(150),
  "pc_iva" numeric(15, 0),
  "nb_moneda" character varying(150),
  "co_etiqueta" character varying(150),
  "co_activo" character varying(150),
  "fe_formulario" character varying(150),
  "nb_sede" character varying(150),
  "co_orden_compra" character varying(150),
  "fe_orden_compra" character varying(150),
  "nb_unidad_solicitante" character varying(150),
  "nb_responsable_patrimonial_primario" character varying(150),
  "nb_responsable_patrimonial_uso" character varying(150),
  "nu_cedula_responsable_patrimonial_uso" character varying(150),
  "nb_ubicacion" character varying(150),
  "co_nota_entrega" character varying(150),
  "fe_nota_entrega" character varying(150),
  "nb_vendedor" character varying(150),
  "fe_factura" character varying(150),
  "tx_garantia" character varying(150),
  "co_usuario" character varying(50) NOT NULL,
  "id_status" numeric(3, 0) DEFAULT 1 NOT NULL,
  "tx_observacion" character varying(150),
  "fe_creado" timestamp without time zone NOT NULL,
  "fe_actualizado" timestamp without time zone
);

DROP TABLE "control_perceptivo"."factura";
CREATE TABLE "control_perceptivo"."factura"(
    "id_factura" serial NOT NULL,
    "id_control_perceptivo" numeric (15, 0) NOT NULL,
    "co_factura" character varying(150),
    "co_usuario" character varying(50) NOT NULL,
    "id_status" numeric(3, 0) DEFAULT 1 NOT NULL,
    "tx_observacion" character varying(150),
    "fe_creado" timestamp without time zone NOT NULL,
    "fe_actualizado" timestamp without time zone
);

