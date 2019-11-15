<template>
  <div>
    <v-btn slot="activator" dark class="mb-2" color="primary" right @click="insertForm()">
      Nuevo registro
      <v-icon dark right>add</v-icon>
    </v-btn>

    <v-divider></v-divider>

    <control-perceptivo-table
      :items="updatedItems"
      :dialog="this.dialog"
      @edit="editFormEventHandler"
      @delete="delConfirmEventHandler"
      @deleteConfirmed="delItemEvetHandler"
      @deleteCanceled="dialog = !dialog"
      @report="reportEventHandler"
    />

    <app-modal :modal="modal" @closeModal="closeModal()">
      <app-steeper :components="steeperComponents" :keepAlive="false" :editable="true" />
    </app-modal>
  </div>
</template>

<script>
import listMixin from "~/mixins/Applist";
import selectMixin from "~/mixins/AppSelect";
import controlPerceptivoMixin from "./Mixins/controlPerceptivo";
import controlPerceptivoTable from "./ControlPerceptivoTable";
import recepcionForm from "./Recepcion/RecepcionForm";
import controlForm from "./Control/ControlForm";
import asignacionForm from "./Asignacion/AsignacionForm";

export default {
  mixins: [listMixin, selectMixin, controlPerceptivoMixin],
  components: {
    "control-perceptivo-table": controlPerceptivoTable
  },
  data() {
    return {
      resource: "control_perceptivo",
      data: []
    };
  },
  computed: {
    updatedItems: {
      get: function() {
        for (let item of this.items) {
          for (let factura of item.facturas) {
            if (factura.id_status = "1") {
              item.co_factura = factura.co_factura;
              break;
            }
          }
          for(let detalle of item.detalles){
            if(detalle.tx_tipo_detalle == 'control'){
              if(detalle.mo_factura && detalle.mo_factura != ''){
                item.mo_factura = detalle.mo_factura;
                break;
              } 
            }
            item.mo_factura = 'NO DEFINIDO';
          }
        }

        return this.items;
      },
      set: function() {}
    },
    steeperComponents: {
      get: function() {
        return [
          {
            title: "RECEPCION",
            component: recepcionForm,
            props: {
              item: this.selected,
              action: this.action,
              data: this.data
            }
          },
          {
            title: "CONTROL",
            component: controlForm,
            props: {
              item: this.selected,
              action: this.action,
              data: this.data
            }
          },
          {
            title: "ASIGNACION",
            component: asignacionForm,
            props: {
              item: this.selected,
              action: this.action,
              data: this.data
            }
          }
        ];
      },
      set: function(value) {}
    }
  },
  methods: {
    editFormEventHandler(e) {
      this.editForm(e.item);
    },
    delConfirmEventHandler(e) {
      this.delConfirm(e.item);
    },
    delItemEvetHandler(e) {
      this.delItem();
    },
    reportEventHandler(e) {
      this.generateReport(e.form, e.item);
    },
    closeModal() {
      window.location = "/control%20perceptivo";
    }
  }
};
</script>
