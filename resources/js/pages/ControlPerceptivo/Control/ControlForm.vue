<template>
  <v-layout row justify-center>
    <v-form v-model="valid" :lazy-validation="true" ref="form">
      <app-form
        :action="action"
        :valid="valid"
        :loading="loading"
        v-on:cerrarModal="cerrarModal()"
        v-on:store="store()"
        v-on:reset="reset()"
        v-on:update="update()"
      >
        <template slot="title">CONTROL PERCEPTIVO</template>
        <template slot="fields">
          <v-container sm12 xs12>
            <v-layout row>
              <v-flex v-if="action !== 'upd'">
                <app-auto-complete
                  :model="controlForm.co_factura"
                  label="FACTURA PRINCIPAL"
                  searchUrl="invoices_by_number"
                  hint="Factura principal"
                  itemText="invoice_number"
                  @fieldBlurred="getAddition(controlForm)"
                  @fieldFocused="reset"
                  @fieldSetted="controlForm.co_factura = $event"
                />
              </v-flex>
              <v-flex v-else>
                <v-text-field
                  label="FACTURA PRINCIPAL"
                  v-model="controlForm.co_factura"
                  :rules="rules.required"
                  required
                  readonly
                  hint="Factura principal"
                  prepend-inner-icon="receipt"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-menu ref="calendar" full-width min-width="290px">
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      slot="activator"
                      v-model="fe_factura"
                      :rules="rules.fecha_no_requerida"
                      label="FECHA DE EMISION DE FACTURA"
                      prepend-inner-icon="event"
                      v-on="on"
                    ></v-text-field>
                  </template>

                  <v-date-picker
                    v-model="controlForm.fe_factura"
                    locale="es-419"
                    @input="calandar = false"
                  ></v-date-picker>
                </v-menu>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="MONTO DE FACTURA"
                  v-model="controlForm.mo_factura"
                  :rules="rules.required"
                  required
                  hint="Monto en Bs"
                  prepend-inner-icon="short_text"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>

          <v-container sm12 xs12>
            <v-layout row>
              <v-flex>
                <v-text-field
                  label="N° ORDEN DE COMPRA"
                  v-model="controlForm.co_orden_compra"
                  :rules="rules.required"
                  required
                  hint="N° Orden de Compra"
                  prepend-inner-icon="event_note"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-menu ref="calendar" full-width min-width="290px">
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      slot="activator"
                      v-model="fe_orden_compra"
                      :rules="rules.fecha_no_requerida"
                      label="FECHA ORDEN DE COMPRA"
                      prepend-inner-icon="event"
                      v-on="on"
                    ></v-text-field>
                  </template>

                  <v-date-picker
                    v-model="controlForm.fe_orden_compra"
                    locale="es-419"
                    @input="calandar = false"
                  ></v-date-picker>
                </v-menu>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="MONTO DE ORDEN DE COMPRA"
                  v-model="controlForm.mo_orden_compra"
                  :rules="rules.monto_no_requerido"
                  required
                  hint="Monto en Bs"
                  prepend-inner-icon="short_text"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>

          <v-container sm12 xs12>
            <v-layout row>
              <v-flex>
                <v-text-field
                  label="NOMBRE O RAZÓN SOCIAL (PROVEEDOR)"
                  v-model="controlForm.nb_vendedor"
                  :rules="rules.required"
                  required
                  hint="Nombre o razón social del proveedor"
                  prepend-inner-icon="business"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="VIGENCIA DE LA GARANTÍA"
                  v-model="controlForm.tx_garantia"
                  :rules="rules.required"
                  required
                  hint="Vigencia de la Garantía"
                  prepend-inner-icon="access_time"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-select
                  label="TIPO DE ENTREGA"
                  v-model="controlForm.tx_tipo_entrega"
                  :items="estatusEntrega"
                  :rules="rules.required"
                  required
                  hint="Seleccione el tipo de entrega"
                ></v-select>
              </v-flex>
            </v-layout>
          </v-container>

          <v-container sm12 xs12>
            <v-layout row>
              <v-flex>
                <v-text-field
                  label="UNIDAD SOLICITANTE"
                  v-model="controlForm.nb_unidad_solicitante"
                  :rules="rules.required"
                  required
                  hint="Unidad que solicitó los bienes"
                  prepend-inner-icon="group"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="RESPONSABLE PATRIMONIAL (RPP)"
                  v-model="controlForm.nb_responsable_patrimonial_primario"
                  :rules="rules.required"
                  required
                  hint="Responsable Patrimonial"
                  prepend-inner-icon="perm_identity"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="% I.V.A"
                  v-model="controlForm.pc_iva"
                  :rules="rules.required"
                  required
                  mask="##%"
                  hint="Porcentaje del I.V.A"
                  prepend-inner-icon="payment"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>

          <v-container sm12 xs12>
            <v-layout row>
              <v-flex>
                <v-select
                  label="CODIGO DE MONEDA"
                  v-model="controlForm.nb_moneda"
                  :items="currencyCodes"
                  :rules="rules.required"
                  item-value="nb_moneda"
                  item-text="nb_moneda"
                  required
                  hint="Seleccione el codigo de moneda"
                ></v-select>
              </v-flex>
              <v-flex v-if="action !== 'upd'">
                <v-text-field
                  label="N° CONTROL PERCEPTIVO"
                  v-model="controlForm.co_control_perceptivo"
                  :rules="rules.required"
                  required
                  hint="Numero de Control Perceptivo Correlativo"
                  prepend-inner-icon="content_paste"
                ></v-text-field>
              </v-flex>
              <v-flex v-else>
                <v-text-field
                  label="N° CONTROL PERCEPTIVO"
                  v-model="controlForm.co_control_perceptivo"
                  :rules="rules.required"
                  required
                  readonly
                  hint="Numero de Control Perceptivo Correlativo"
                  prepend-inner-icon="content_paste"
                ></v-text-field>
              </v-flex>

              <v-flex v-if="action !== 'upd'">
                <v-menu ref="calendar" v-model="calendar" full-width min-width="290px">
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      v-if="action !== 'upd'"
                      slot="activator"
                      v-model="fe_formulario"
                      :rules="rules.fecha"
                      label="FECHA FORMULARIO"
                      prepend-inner-icon="event"
                      required
                      v-on="on"
                    ></v-text-field>
                    <v-text-field
                      v-else
                      slot="activator"
                      v-model="fe_formulario"
                      :rules="rules.fecha"
                      label="FECHA FORMULARIO"
                      prepend-inner-icon="event"
                      required
                      readonly
                      v-on="on"
                    ></v-text-field>
                  </template>

                  <v-date-picker
                    v-if="action !== 'upd'"
                    v-model="controlForm.fe_formulario"
                    locale="es-419"
                    @input="calandar = false"
                  ></v-date-picker>
                </v-menu>
              </v-flex>
            </v-layout>
          </v-container>

          <v-flex md12 sm6 v-if="controlForm.activos.length > 0">
            <control-table :items="controlForm.activos" />
          </v-flex>

          <v-flex xs12 sm12>
            <v-text-field
              label="OBSERVACIONES"
              v-model="controlForm.tx_observacion"
              :rules="rules.required"
              required
              hint="Observaciones"
              prepend-inner-icon="short_text"
            ></v-text-field>
          </v-flex>

           <!-- ADD ASSET DIALOG -->
          <v-dialog v-model="isAddingNewAsset" max-width="500px">
            <template v-slot:activator="{ on }"></template>
            <v-card>
              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="newAsset.ca_activo" label="CANTIDAD"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="newAsset.tx_descripcion" label="DESCRIPCION"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="newAsset.md_activo" label="MEDIDAS"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="newAsset.tx_color_activo" label="COLOR"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="newAsset.nb_fabricante" label="MARCA"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="newAsset.co_modelo" label="MODELO"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="newAsset.co_serial" label="SERIAL"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="newAsset.co_etiqueta" label="SERIAL BANDES"></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  flat
                  @click="isAddingNewAsset = !isAddingNewAsset"
                >Cancel</v-btn>
                <v-btn color="blue darken-1" flat @click="saveNewAsset">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <!-- BUTTONS -->
          <v-container sm12 xs12>
            <v-layout row>
              <div v-if="controlForm.co_control_perceptivo">
                <v-flex sm12 sm6>
                  <v-btn
                    flat
                    small
                    color="primary"
                    @click="isFactDialogOpened = !isFactDialogOpened"
                  >FACTURAS ASOCIADAS</v-btn>
                </v-flex>
                <facturas-asociadas-component
                  :parentItems="controlForm.facturas"
                  :opened="isFactDialogOpened"
                  :principalInvoice="controlForm.co_factura"
                  @added="invoiceAddedEventHandler"
                  @deleted="invoiceDeletedEventHandler"
                  @closed="isFactDialogOpened = !isFactDialogOpened"
                />
              </div>
              <div>
                <v-flex sm12 sm6>
                  <v-btn flat small color="primary" @click="addNewAsset">AGREGAR ACTIVO</v-btn>
                </v-flex>
              </div>
            </v-layout>
          </v-container>

        </template>
      </app-form>
    </v-form>
  </v-layout>
</template>

<script>
import formMixin from "~/mixins/Appform";
import controlPerceptivoMixin from "../Mixins/controlPerceptivo";
import controlTable from "./ControlTable";
import facturasAsociadasComponent from "../Components/FacturasAsociadasComponent";

export default {
  mixins: [formMixin, controlPerceptivoMixin],
  components: {
    "control-table": controlTable,
    "facturas-asociadas-component": facturasAsociadasComponent
  },
  mounted() {
    this.getCurrencyCodes();
  },
  data() {
    return {
      newAsset: {},
      isAddingNewAsset: false,
      isFactDialogOpened: false,
      resource: "control_perceptivo",
      estatusEntrega: [
        { text: "PARCIAL", value: "PARCIAL" },
        { text: "TOTAL", value: "TOTAL" }
      ],
      currencyCodes: [],
      controlForm: {
        titulo: "CONTROL PERCEPTIVO",
        nombre: "control",
        tx_tipo_detalle: "control",
        nb_moneda: null,
        tx_tipo_entrega: null,
        mo_orden_compra: null,
        mo_factura: null,
        co_control_perceptivo: null,
        fe_formulario: null,
        co_orden_compra: null,
        fe_orden_compra: null,
        nb_unidad_solicitante: null,
        nb_responsable_patrimonial_primario: null,
        nb_vendedor: null,
        co_factura: null,
        fe_factura: null,
        tx_garantia: null,
        tx_observacion: null,
        activos: [],
        facturas: [],
        pc_iva: null,
        co_usuario: this.$store.getters.getUser.nb_usuario
      }
    };
  },
  computed: {
    fe_formulario: {
      get: function() {
        return this.formatDate(this.controlForm.fe_formulario);
      },
      set: function(value) {
        this.controlForm.fe_formulario = this.parseDate(value);
      }
    },
    fe_nota_entrega: {
      get: function() {
        return this.formatDate(this.controlForm.fe_nota_entrega);
      },
      set: function(value) {
        this.controlForm.fe_nota_entrega = this.parseDate(value);
      }
    },
    fe_factura: {
      get: function() {
        return this.formatDate(this.controlForm.fe_factura);
      },
      set: function(value) {
        this.controlForm.fe_factura = this.parseDate(value);
      }
    },
    fe_orden_compra: {
      get: function() {
        return this.formatDate(this.controlForm.fe_orden_compra);
      },
      set: function(value) {
        this.controlForm.fe_orden_compra = this.parseDate(value);
      }
    }
  },
  methods: {
    mapForm() {
      this.mapData();
    },
    store() {
      this.storeData(this.controlForm, this.resource);
    },
    update() {
      this.updateData(this.controlForm);
    },
    cerrarModal() {
      window.location = "/control%20perceptivo";
    },
    invoiceAddedEventHandler(e) {
      this.controlForm.facturas = e;
    },
    invoiceDeletedEventHandler(e) {
      this.controlForm.facturas = e;
    },
     addNewAsset() {
      this.newAsset = {};
      this.isAddingNewAsset = !this.isAddingNewAsset;
    },
    saveNewAsset() {
      this.recepcionForm.activos.push(this.newAsset);
      this.isAddingNewAsset = !this.isAddingNewAsset;
    }
  }
};
</script>