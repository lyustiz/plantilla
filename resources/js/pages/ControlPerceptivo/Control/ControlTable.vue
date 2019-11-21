<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="items"
      :search="search"
      item-key="asset_number"
      
      sort-by=""
    >
      <template slot="items" slot-scope="linea">
        <td class="text-xs-left">{{ linea.item.ca_activo }}</td>
        <td class="text-xs-left">{{ linea.item.tx_descripcion }}</td>
        <td class="text-xs-left">{{ linea.item.md_activo }}</td>
        <td class="text-xs-left">{{ linea.item.tx_color_activo }}</td>
        <td class="text-xs-left">{{ linea.item.nb_fabricante }}</td>
        <td class="text-xs-left">{{ linea.item.co_modelo }}</td>
        <td class="text-xs-left">{{ linea.item.co_serial }}</td>
        <td class="text-xs-left">{{ linea.item.co_etiqueta }}</td>
        <td class="text-xs-left">{{ linea.item.mo_precio_unitario }}</td>
        <td class="text-xs-left">{{ linea.item.mo_precio_total }}</td>
        <td class="text-xs-left">
          <v-icon small class="mr-2" @click="editItem(linea.item)">edit</v-icon>
          <v-icon @click="removeItem(linea.item)">delete</v-icon>
        </td>
      </template>
      <v-alert
        slot="no-results"
        :value="true"
        color="error"
        icon="warning"
      >La busqueda no encontro resultados.</v-alert>
    </v-data-table>

    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on }"></template>
      <v-card>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.ca_activo" label="CANTIDAD"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.tx_descripcion" label="DESCRIPCION"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.md_activo" label="MEDIDAS"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.tx_color_activo" label="COLOR"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.nb_fabricante" label="MARCA"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.co_modelo" label="MODELO"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.co_serial" label="SERIAL"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.co_etiqueta" label="SERIAL BANDES"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.mo_precio_unitario" label="PRECIO UNITARIO"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field v-model="editedItem.mo_precio_total" label="PRECIO TOTAL"></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialogDelete"
      scrollable
      persistent
      max-width="500px"
      transition="dialog-transition"
    >
      <v-card>
        <v-card-title color="error" primary-title>
          <v-icon>warning</v-icon>
          <h3>  Atencion  </h3>
          <v-icon>warning</v-icon>
        </v-card-title>
        <v-card-text>
          <h5>Desea eliminar los activos {{ removedItem.tx_descripcion + ' con etiquetas ' + removedItem.co_etiqueta }}</h5>
        </v-card-text>
        <v-card-actions>
          <v-btn color="success" @click="confirmRemove()">confirmar</v-btn>
          <v-btn color="error" @click="dialogDelete = !dialogDelete">cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props: {
    items: Array
  },
  data() {
    return {
      headers: [
        { text: "CANT", value: "ca_activo" },
        { text: "DESCRIPCION", value: "tx_descripcion" },
        { text: "MEDIDAS", value: "md_activo" },
        { text: "color", value: "tx_color_activo" },
        { text: "MARCA", value: "nb_fabricante" },
        { text: "MODELO", value: "co_modelo" },
        { text: "SERIAL", value: "co_serial" },
        { text: "SERIAL BANDES", value: "co_etiqueta" },
        { text: "PRECIO UNITARIO", value: "mo_precio_unitario" },
        { text: "PRECIO TOTAL", value: "mo_precio_total" },
        { text: "ACCIÓN", value: null }
      ],
      search: "",
      item: {},
      dialog: false,
      dialogDelete: false,
      removedIndex: -1,
      removedItem: {},
      editedIndex: -1,
      editedItem: {}
    };
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  methods: {
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
      this.dialog = true;
    },
    removeItem(item) {
      this.removedIndex = this.items.indexOf(item);
      this.removedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    confirmRemove() {
      this.items.splice(this.removedIndex, 1);
      this.item = {};
      this.removedIndex = -1;
      this.removedItem = {};
      this.dialogDelete = false;
    },
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    }
  }
};
</script>