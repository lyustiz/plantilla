-- ORACLE

DROP TABLE "FA"."FA_PERCEPTIVE_CONTROL";
DROP SEQUENCE "FA"."fa_perceptive_control_seq";

CREATE TABLE "FA"."FA_PERCEPTIVE_CONTROL" (
  "PERCEPTIVE_CONTROL_ID" NUMBER(15) NOT NULL,
  "PERCEPTIVE_CONTROL_NUMBER" VARCHAR2(15) NOT NULL,
  "INVOICE_NUMBER" VARCHAR2(50),
  "STATUS" NUMBER(3) DEFAULT 1 NOT NULL,
  "STATUS_DESCRIPTION" VARCHAR2(150) DEFAULT 'OK' NOT NULL,
  "OBSERVATIONS" VARCHAR2(150),
  "CREATED_AT" DATE NOT NULL,
  "UPDATED_AT" DATE NOT NULL
);
ALTER TABLE
  "FA"."FA_PERCEPTIVE_CONTROL"
ADD
  (
    CONSTRAINT fa_perceptive_control_pk PRIMARY KEY (PERCEPTIVE_CONTROL_ID)
  );
ALTER TABLE
  "FA"."FA_PERCEPTIVE_CONTROL"
ADD
  (
    CONSTRAINT fa_perceptive_control_in_un UNIQUE (INVOICE_NUMBER)
  );
ALTER TABLE
  "FA"."FA_PERCEPTIVE_CONTROL"
ADD
  (
    CONSTRAINT fa_perceptive_control_nu_un UNIQUE (PERCEPTIVE_CONTROL_NUMBER)
  );
CREATE SEQUENCE "FA"."fa_perceptive_control_seq" START WITH 1;
CREATE
  OR REPLACE TRIGGER "FA"."fa_perceptive_control_bir" BEFORE
INSERT
  ON "FA"."FA_PERCEPTIVE_CONTROL" FOR EACH ROW BEGIN
SELECT
  "FA"."fa_perceptive_control_seq".NEXTVAL INTO :new.PERCEPTIVE_CONTROL_ID
FROM
  dual;
END;
/ 

DROP TABLE "FA"."FA_PERCEPTIVE_CONTROL_ASSETS";
DROP SEQUENCE "FA"."fa_perceptive_control_a_seq";
CREATE TABLE "FA"."FA_PERCEPTIVE_CONTROL_ASSETS" (
  "PERCEPTIVE_CONTROL_DETAIL_ID" NUMBER(15, 0) NOT NULL ENABLE,
  "PERCEPTIVE_CONTROL_ID" NUMBER(15, 0) NOT NULL ENABLE,
  "PERCEPTIVE_CONTROL_ASSET_ID" NUMBER(15, 0) NOT NULL ENABLE,
  "QUANTITY" VARCHAR2(150),
  "DESCRIPTION" VARCHAR2(150),
  "MEASURES" VARCHAR2(150),
  "COLOR" VARCHAR2(150),
  "MANUFACTURER_NAME" VARCHAR2(150),
  "MODEL_NUMBER" VARCHAR2(150),
  "SERIAL_NUMBER" VARCHAR2(150),
  "CURRENCY_NAME" VARCHAR2(150),
  "TAG_NUMBER" VARCHAR2(150),
  "UNIT_COST" VARCHAR2(150),
  "TOTAL_COST" VARCHAR2(150),
  "STATUS" NUMBER(3, 0) DEFAULT 1 NOT NULL ENABLE,
  "STATUS_DESCRIPTION" VARCHAR2(150) DEFAULT 'OK' NOT NULL,
  "OBSERVATIONS" VARCHAR2(150 BYTE),
  "CREATED_AT" DATE NOT NULL ENABLE,
  "UPDATED_AT" DATE NOT NULL ENABLE
);
ALTER TABLE
  "FA"."FA_PERCEPTIVE_CONTROL_ASSETS"
ADD
  (
    CONSTRAINT fa_perceptive_control_a_pk PRIMARY KEY (PERCEPTIVE_CONTROL_ASSET_ID)
  );
CREATE SEQUENCE "FA"."fa_perceptive_control_a_seq" START WITH 1;
CREATE
  OR REPLACE TRIGGER "FA"."fa_perceptive_control_a_bir" BEFORE
INSERT
  ON "FA"."FA_PERCEPTIVE_CONTROL_ASSETS" FOR EACH ROW BEGIN
SELECT
  "FA"."fa_perceptive_control_a_seq".NEXTVAL INTO :new.PERCEPTIVE_CONTROL_ASSET_ID
FROM
  dual;
END;
/ 

DROP TABLE "FA"."FA_PERCEPTIVE_CONTROL_DETAIL";
DROP SEQUENCE "FA"."fa_perceptive_control_d_seq";
CREATE TABLE "FA"."FA_PERCEPTIVE_CONTROL_DETAIL" (
  "PERCEPTIVE_CONTROL_DETAIL_ID" NUMBER(15, 0) NOT NULL ENABLE,
  "PERCEPTIVE_CONTROL_ID" NUMBER(15, 0) NOT NULL ENABLE,
  "PERCEPTIVE_CONTROL_DETAIL_TYPE" VARCHAR2(150 BYTE) NOT NULL ENABLE,
  "PERCEPTIVE_CONTROL_NUMBER" VARCHAR2(150 BYTE) NOT NULL ENABLE,
  "DELIVERY_TYPE" VARCHAR2(150 BYTE),
  "PURCHASE_ORDER_AMMOUNT" VARCHAR2(150 BYTE),
  "INVOICE_AMOUNT" VARCHAR2(150 BYTE),
  "IVA_PERCENTAGE" NUMBER(15, 0),
  "CURRENCY_NAME" VARCHAR2(150),
  "ASSET_TAG" VARCHAR2(150 BYTE),
  "ASSET_NUMBER" VARCHAR2(150 BYTE),
  "FORM_DATE" VARCHAR2(150 BYTE),
  "HEADQUARTER" VARCHAR2(150 BYTE),
  "PURCHASE_ORDER" VARCHAR2(150 BYTE),
  "PURCHASE_ORDER_DATE" VARCHAR2(150 BYTE),
  "REQUESTING_UNIT" VARCHAR2(150 BYTE),
  "PRIMARY_ASSET_MANAGER" VARCHAR2(150 BYTE),
  "USE_ASSET_MANAGER" VARCHAR2(150 BYTE),
  "USE_ASSET_MANAGER_ID" VARCHAR2(150 BYTE),
  "UBICATION" VARCHAR2(150 BYTE),
  "DELIVERY_NOTE" VARCHAR2(150 BYTE),
  "DELIVERY_NOTE_DATE" VARCHAR2(150 BYTE),
  "VENDOR" VARCHAR2(150 BYTE),
  "INVOICE_NUMBER" VARCHAR2(150 BYTE),
  "INVOICE_DATE" VARCHAR2(150 BYTE),
  "WARRANTY_VALIDITY" VARCHAR2(150 BYTE),
  "STATUS" NUMBER(3, 0) DEFAULT 1 NOT NULL ENABLE,
  "STATUS_DESCRIPTION" VARCHAR2(150) DEFAULT 'OK' NOT NULL,
  "OBSERVATIONS" VARCHAR2(150 BYTE),
  "CREATED_AT" DATE NOT NULL ENABLE,
  "UPDATED_AT" DATE NOT NULL ENABLE
);
ALTER TABLE
  "FA"."FA_PERCEPTIVE_CONTROL_DETAIL"
ADD
  (
    CONSTRAINT fa_perceptive_control_d_pk PRIMARY KEY (PERCEPTIVE_CONTROL_DETAIL_ID)
  );
CREATE SEQUENCE "FA"."fa_perceptive_control_d_seq" START WITH 1;
CREATE
  OR REPLACE TRIGGER "FA"."fa_perceptive_control_d_bir" BEFORE
INSERT
  ON "FA"."FA_PERCEPTIVE_CONTROL_DETAIL" FOR EACH ROW BEGIN
SELECT
  "FA"."fa_perceptive_control_d_seq".NEXTVAL INTO :new.PERCEPTIVE_CONTROL_DETAIL_ID
FROM
  dual;
END;

