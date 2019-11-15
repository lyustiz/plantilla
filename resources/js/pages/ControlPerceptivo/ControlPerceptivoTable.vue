<template>
  <v-flex md12 sm6>
    <v-data-table
      :headers="headers"
      :items="items"
      :search="search"
      item-key="co_control_perceptivo"

    >
      <template slot="items" slot-scope="linea">
        <td class="text-xs-left">{{ linea.item.co_control_perceptivo }}</td>
        <td class="text-xs-left">{{ linea.item.co_factura }}</td>
        <td class="text-xs-left">{{ linea.item.mo_factura }}</td>
        <td class="text-xs-left">
          <v-tooltip bottom v-if="isReceptionAvailable(linea)">
            <v-icon slot="activator" @click="reportEventTrigger('recepcion', linea)">picture_as_pdf</v-icon>
            <span>Recepcion</span>
          </v-tooltip>
           <v-tooltip bottom v-if="isControlAvailable(linea)">
            <v-icon slot="activator" @click="reportEventTrigger('control', linea)">picture_as_pdf</v-icon>
            <span>Control</span>
          </v-tooltip>
           <v-tooltip bottom v-if="isAssignmentAvailable(linea)">
            <v-icon slot="activator" @click="reportEventTrigger('asignacion', linea)">picture_as_pdf</v-icon>
            <span>Asignacion</span>
          </v-tooltip>
        </td>
        <td class="text-xs-left">
          <v-icon @click="editEventTrigger(linea)">edit</v-icon>
          <v-icon @click="deleteEventTrigger(linea)">delete</v-icon>
        </td>
      </template>
      <v-alert
        slot="no-results"
        :value="true"
        color="error"
        icon="warning"
      >La busqueda no encontro resultados.</v-alert>
    </v-data-table>

    <v-dialog
        v-model="dialog"
        scrollable  
        persistent 
        max-width="500px"
        transition="dialog-transition">
        
        <v-card>
            <v-card-title color="error" primary-title>
                <h3>Atencion</h3>
            </v-card-title>
            <v-card-text>
                <v-icon>warning</v-icon> 
                <br/>
                Desea eliminar el control perceptivo: {{ itemToDelete.item.co_control_perceptivo }} con factura {{ itemToDelete.item.co_factura }} ?
            </v-card-text>
            <v-card-actions>
                <v-btn color="success" @click="deleteConfirmedEventTrigger('deleteConfirmed')">confirmar</v-btn>
                <v-btn color="error" @click="deleteCanceledEventTrigger('deleteCanceled')">cancelar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

  </v-flex>
</template>
<script>
export default {
  props: {
    items: Array,
    dialog: {
      type: Boolean,
      required: true,
      default: false,
    }
  },
  data() {
    return {
      headers: [
        {
          text: "N° DE CONTROL PERCEPTIVO",
          value: "co_control_perceptivo"
        },
        { text: "NUMERO DE FACTURA", value: "co_factura" },
        { text: "MONTO DE FACTURA", value: "mo_factura" },
        { text: "REPORTES", value: null },
        { text: "ACCIÓN", value: null }
      ],
      search: "",
      dialogEdit: false,
      editedIndex: -1,
      editedItem: {},
      itemToEdit: {},
      itemToDelete: {item: {}},
    };
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  methods: {
    isReceptionAvailable(linea) {
     for(let detalle of linea.item.detalles){
       if(detalle.tx_tipo_detalle == 'recepcion'){
         return true;
       }else{
         continue;
       }
     }
      return false;
    },
    isControlAvailable(linea) {
      for(let detalle of linea.item.detalles){
       if(detalle.tx_tipo_detalle == 'control'){
         return true;
       }else{
         continue;
       }
     }
      return false;
    },
    isAssignmentAvailable(linea) {
      for(let detalle of linea.item.detalles){
       if(detalle.tx_tipo_detalle == 'asignacion'){
         return true;
       }else{
         continue;
       }
     }
      return false;
    },
    editEventTrigger(linea){
      this.itemToEdit = linea;
      this.$emit('edit', linea);
    },
    deleteEventTrigger(linea){
      this.itemToDelete = linea;
      this.$emit('delete', linea);
    },
    deleteConfirmedEventTrigger(){
      this.$emit('deleteConfirmed');
    },
    deleteCanceledEventTrigger(){
      this.$emit('deleteCanceled');
    },
    reportEventTrigger(form, linea){
      this.$emit('report', {form: form, item: linea})
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.items[this.editedIndex], this.editedItem);
      } else {
        this.items.push(this.editedItem);
      }
      this.close();
    },
    editItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogEdit = true;
    },
    close() {
      this.dialogEdit = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    }
  }
};
</script>