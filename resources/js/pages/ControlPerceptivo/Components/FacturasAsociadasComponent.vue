<template>
  <div>
    <v-dialog v-model="opened" max-width="1000px" persistent>
      <template v-slot:activator="{ on }"></template>
      <v-card>
        <v-card-text>
          <template>
            <v-container sm12 xs12>
              <v-layout column>
                <v-flex xs12 sm6 d-flex>
                  <v-data-table
                    :headers="headers"
                    :items="items"
                    :search="search"
                    item-key="co_factura"
                    
                    sort-by=""
                  >
                    <template slot="items" slot-scope="linea">
                      <td class="text-xs-left">{{ linea.item.co_factura }}</td>
                      <td class="text-xs-left">
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
                </v-flex>

                <!-- <v-divider></v-divider> -->
                <v-form ref="facturasAsociadasForm">
                  <v-flex xs12 sm6 d-flex>
                    <app-auto-complete
                      :model="nuevaFactura"
                      label="NUEVA FACTURA"
                      searchUrl="invoices_by_number"
                      hint="Nueva factura"
                      itemText="invoice_number"
                      @fieldSetted="nuevaFactura = $event"
                       @fieldFocused="reset"
                    />
                  </v-flex>
                </v-form>
              </v-layout>
            </v-container>
          </template>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="addItem">Agregar</v-btn>
          <v-btn color="blue darken-1" flat @click="closed">Cerrar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props: {
    opened: {
      type: Boolean,
      default: false
    },
    parentItems: {
      type: Array,
      default: []
    },
    principalInvoice: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      headers: [
        { text: "FACTURA", value: "co_factura" },
        { text: "ACCIÓN", value: null }
      ],
      resource: "control_perceptivo_factura",
      items: this.parentItems,
      isAdding: false,
      nuevaFactura: null,
      search: "",
      item: {},
      removedIndex: -1,
      removedItem: {}
    };
  },
  methods: {
    addItem() {
      if (this.nuevaFactura !== null && this.nuevaFactura !== "") {
        let found = false;
        for (let item of this.items) {
          if (item.co_factura === this.nuevaFactura) {
            found = true;
            break;
          }
        }
        if (found === false && this.nuevaFactura !== this.principalInvoice) {
          this.items.push({
            co_factura: this.nuevaFactura
          });
          this.$emit("added", this.items);
          this.nuevaFactura = null;
          this.reset();
        }
      }
    },
    removeItem(item) {
      this.removedIndex = this.items.indexOf(item);
      this.removedItem = Object.assign({}, item);
      this.confirmRemove();
    },
    confirmRemove() {
      this.items.splice(this.removedIndex, 1);
      this.item = {};
      this.removedIndex = -1;
      this.removedItem = {};
      this.$emit("deleted", this.items);
    },
    closed() {
      this.$emit("closed");
    },
    reset(){
       this.$refs.facturasAsociadasForm.reset();
    }
  }
};
</script>