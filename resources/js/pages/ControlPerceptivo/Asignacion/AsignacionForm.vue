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
        <template slot="title">ASIGNACION DE BIENES DE USO</template>
        <template slot="fields">
          <v-container sm12 xs12>
            <v-layout row>
              <v-flex v-if="action !== 'upd' && multipleInvoices !== true">
                <app-auto-complete
                  :model="asignacionForm.co_factura"
                  label="FACTURA PRINCIPAL"
                  searchUrl="invoices_by_number"
                  hint="Factura principal"
                  itemText="invoice_number"
                  @fieldBlurred="getAddition(asignacionForm)"
                  @fieldFocused="reset"
                  @fieldSetted="asignacionForm.co_factura = $event"
                />
              </v-flex>
              <v-flex v-else>
                <v-text-field
                  label="FACTURA PRINCIPAL"
                  v-model="asignacionForm.co_factura"
                  :rules="rules.required"
                  required
                  readonly
                  hint="Factura principal"
                  prepend-inner-icon="receipt"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>

          <v-container sm12 xs12>
            <v-layout row>
              <v-flex>
                <v-text-field
                  label="RESPONSABLE PATRIMONIAL (RPP)"
                  v-model="asignacionForm.nb_responsable_patrimonial_primario"
                  :rules="rules.required"
                  required
                  hint="Responsable Patrimonial"
                  prepend-inner-icon="perm_identity"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="RESPONSABLE PATRIMONIAL DE USO (RPU)"
                  v-model="asignacionForm.nb_responsable_patrimonial_uso"
                  :rules="rules.required"
                  required
                  hint="Porcentaje del I.V.A"
                  prepend-inner-icon="perm_identity"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="CEDULA RESPONSABLE PATRIMONIAL DE USO (RPU)"
                  v-model="asignacionForm.nu_cedula_responsable_patrimonial_uso"
                  :rules="rules.required"
                  required
                  hint="Porcentaje del I.V.A"
                  prepend-inner-icon="perm_identity"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>

          <v-container sm12 xs12>
            <v-layout row>
              <v-flex>
                <v-text-field
                  label="SEDE"
                  v-model="asignacionForm.nb_sede"
                  :rules="rules.required"
                  required
                  hint="Sede"
                  prepend-inner-icon="content_paste"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="UNIDAD SOLICITANTE"
                  v-model="asignacionForm.nb_unidad_solicitante"
                  :rules="rules.required"
                  required
                  hint="Unidad que solicitó los bienes"
                  prepend-inner-icon="group"
                ></v-text-field>
              </v-flex>

              <v-flex>
                <v-text-field
                  label="UBICACION"
                  v-model="asignacionForm.nb_ubicacion"
                  :rules="rules.required"
                  required
                  hint="Ubicacion"
                  prepend-inner-icon="group"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>

          <v-container sm12 xs12>
            <v-layout row>

               <v-flex>
                <v-select
                  label="TIPO ASIGNACION"
                  v-model="asignacionForm.tx_tipo_asignacion"
                  :items="estatusAsignacion"
                  :rules="rules.required"
                  required
                  hint="Seleccione el tipo de asignacion"
                ></v-select>
              </v-flex>

              <v-flex v-if="action !== 'upd'">
                <v-text-field
                  label="N° CONTROL PERCEPTIVO"
                  v-model="asignacionForm.co_control_perceptivo"
                  :rules="rules.required"
                  required
                  hint="Numero de Control Perceptivo Correlativo"
                  prepend-inner-icon="content_paste"
                ></v-text-field>
              </v-flex>
              <v-flex v-else>
                <v-text-field
                  label="N° CONTROL PERCEPTIVO"
                  v-model="asignacionForm.co_control_perceptivo"
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
                    v-model="asignacionForm.fe_formulario"
                    locale="es-419"
                    @input="calandar = false"
                  ></v-date-picker>
                </v-menu>
              </v-flex>
            </v-layout>
          </v-container>

          <v-flex md12 sm6 v-if="asignacionForm.activos.length > 0">
            <asignacion-table :items="asignacionForm.activos" />
          </v-flex>

          <v-flex xs12 sm12>
            <v-text-field
              label="OBSERVACIONES"
              v-model="asignacionForm.tx_observacion"
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
              <div v-if="asignacionForm.co_control_perceptivo">
                <v-flex sm12 sm6>
                  <v-btn
                    flat
                    small
                    color="primary"
                    @click="isFactDialogOpened = !isFactDialogOpened"
                  >FACTURAS ASOCIADAS</v-btn>
                </v-flex>
                <facturas-asociadas-component
                  :parentItems="asignacionForm.facturas"
                  :opened="isFactDialogOpened"
                  :principalInvoice="asignacionForm.co_factura"
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
import asignacionTable from "./AsignacionTable";
import facturasAsociadasComponent from "../Components/FacturasAsociadasComponent";

export default {
  mixins: [formMixin, controlPerceptivoMixin],
  components: {
    "asignacion-table": asignacionTable,
    "facturas-asociadas-component": facturasAsociadasComponent
  },
  data() {
    return {
      newAsset: {},
      isAddingNewAsset: false,
      isFactDialogOpened: false,
      resource: "control_perceptivo",
      estatusAsignacion: [
        { text: "MUEBLES", value: "MUEBLES" },
        { text: "INMUEBLES", value: "INMUEBLES" }
      ],
      multipleInvoices: false,
      asignacionForm: {
        titulo: "ASIGNACION DE BIENES DE USO",
        nombre: "asignacion",
        tx_tipo_detalle: "asignacion",
        tx_tipo_asignacion: null,
        co_control_perceptivo: null,
        fe_formulario: null,
        nb_sede: null,
        nb_unidad_solicitante: null,
        nb_responsable_patrimonial_primario: null,
        nb_responsable_patrimonial_uso: null,
        nu_cedula_responsable_patrimonial_uso: null,
        nb_ubicacion: null,
        co_factura: null,
        tx_observacion: null,
        activos: [],
        facturas: [],
        co_usuario: this.$store.getters.getUser.nb_usuario
      }
    };
  },
  computed: {
    fe_formulario: {
      get: function() {
        return this.formatDate(this.asignacionForm.fe_formulario);
      },
      set: function(value) {
        this.asignacionForm.fe_formulario = this.parseDate(value);
      }
    }
  },
  methods: {
    mapForm() {
      this.mapData();
    },
    store() {
      this.storeData(this.asignacionForm, this.resource);
    },
    update() {
      this.updateData(this.asignacionForm);
    },
    cerrarModal() {
      window.location = "/control%20perceptivo";
    },
    invoiceAddedEventHandler(e) {
      this.asignacionForm.facturas = e;
    },
    invoiceDeletedEventHandler(e) {
      this.asignacionForm.facturas = e;
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