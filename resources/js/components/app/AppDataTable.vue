<template>
    <v-card>
      <v-card-title>
        <v-layout row wrap>
          <v-flex xs12 sm6>
            <v-layout row>
              <v-flex xs3>
                <h2 class = "d-inline-block mt-2">{{ title }}</h2>
              </v-flex>
              <v-divider vertical></v-divider>
              <template v-if = "btnModal">
                <v-flex xs6>
                  <v-btn 
                    color = "primary" 
                    dark 
                    class = "mb-2"
                    @click="showModal()"
                  >
                    <v-icon> add </v-icon>
                    Agregar / Crear
                  </v-btn>
                </v-flex>
              </template>
            </v-layout>
          </v-flex>
          <v-flex 
            xs2 
            sm6
          >
              <v-text-field
                v-model     = "search"
                append-icon = "search"
                label       = "Buscar"
                single-line
                hide-details
              ></v-text-field>
          </v-flex>  
        </v-layout>    
      </v-card-title>
        <v-data-table 
            v-model     = "selected"
            :headers    = "bedside"
            :items      = "body"
            :search     = "search"
            :item-key   = "key"
            class       = "elevation-1"  
            :select-all = "bool"
            :rows-per-page-items = "element"
          >
          <template v-slot:items = "stock">
            <td v-if = "bool">
              <v-checkbox
                v-model = "stock.selected"
                primary
                hide-details
              ></v-checkbox>
            </td>
            <!-- <tr> -->
              <td v-for = "(item, index) in stock.item" :key = "index">{{ item }}</td>
              <td class = "justify-center" >
                <app-icon-buttom
                  :icons       = "items"
                  @buttomPress = "buttomPress"
                >
                </app-icon-buttom>
              </td>
            <!-- </tr> -->
          </template>
          <template v-slot:no-data>
            <v-alert :value = "true" color = "error" icon = "warning">
                Su búsqueda de "{{ search }}" no se encontro resultados.
            </v-alert>
          </template>
          <template v-slot:pageText = "props">
            {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
          </template>
        </v-data-table>
    </v-card>
</template>

<script>
  export default {  
    props:{
      title:
      {
        type    : String,
        default : 'Ingrese Titulo',
      },
      checkbox  :
      {
        type    : Boolean,
        default : false,
      },
      buttom:
      {
        type    : Boolean,
        default : true,
      },
      element   : 
      {
        type    : Array,
        default : function(){
            [10, 20, 30, {
              text  : "All", 
              value : -1
            }
          ]
        }
      },
      expan       : false,
      bedside     : Array,
      body       : Array, 
      keyChain    : String, 
      caseButtom  : Array,
      iconsButtom : Object,
    },
    data () {
      return {
        items   : this.iconsButtom,
        expand  : this.expan, 
        selected: [] , 
        search  : '' ,
        bool    : this.checkbox,
        key     : this.keyChain,
        btnModal: this.buttom,
        CaseBtn : this.caseButtom,

      }
    },
    methods:
    {
      showModal()
      {
        this.$store.commit('setButtom', true);
      },
      buttomPress(value)
      {
        this.$emit("buttomPress", value)
      },
    },
  }
</script>