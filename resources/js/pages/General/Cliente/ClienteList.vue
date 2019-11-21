<template>
<div>
<v-btn 
    color="primary" 
    :loading="loading"
    @click="insertForm()"
    >
    Crear Cliente
    <v-icon dark right >add</v-icon>
    </v-btn>

    <v-dialog v-model="dialog" max-width="500px">
 
    </v-dialog>

     <v-flex xs12 xs6>
        <v-text-field
            v-model="search"
            label="Buscar"
            single-line
            hide-details
            clearable
        ></v-text-field>
    </v-flex>
    <v-data-table
        :headers="headers"
        :items  ="items"
        :search ="search"
        item-key="id_cliente"
        
        sort-by=""
        :loading="loading"
    >
        <template slot="items" slot-scope="linea">
            <td class="text-xs-left">{{ linea.item.nb_cliente }}      </td>
            <td class="text-xs-left">{{ linea.item.tx_rif }}          </td>
            <td class="text-xs-left">{{ linea.item.tx_telefono }}     </td>
            <td class="text-xs-left">{{ linea.item.tx_contacto }}     </td>
            <td class="text-xs-left">{{ linea.item.tx_email }}        </td>
            <td class="text-xs-left">{{ linea.item.tipo.nb_tipo_cliente }} </td>
            <td class="text-xs-left">{{ linea.item.clase.nb_clase_cliente }}</td>
            <td class="text-xs-left">{{ linea.item.status.nb_status }}</td>
            <td class="text-xs-left">{{ linea.item.tx_direccion }}    </td>
            <td class="text-xs-left">{{ linea.item.tx_observaciones }}</td>

            <td class="justify-center">
            <v-icon @click="editForm(linea.item)" >
                edit
            </v-icon>
            <v-icon @click="delConfirm(linea.item)">
                delete
            </v-icon>
            </td>
        </template>
        
        <v-alert
            slot="no-results"
            :value="true"
            color="error"
            icon="warning">
            La busqueda "{{ search }}" no se enconto resultados.
        </v-alert>

        <!-- <template slot="pageText" >
            {{item.pageStart}} - {{item.pageStop}} de {{item.itemsLength}}
        </template>   -->

        <!-- <template slot="footer" >
                <p>footer</p>
        </template> -->

    </v-data-table>
    <app-modal :modal="modal" @closeModal="closeModal()">    

        <cliente-form 
            @closeModal="closeModal()"
            :action="action"
            :item="selected"
        ></cliente-form>

    </app-modal>
    <v-dialog
        v-model="dialog"
        scrollable  
        persistent 
        max-width="500px"
        transition="dialog-transition"
        >
        <v-card>
            <v-card-title color="error" primary-title>
                <h3>Atencion</h3>
            </v-card-title>
            <v-card-text>
                <v-icon>alert</v-icon>Desea eliminar el cliente {{ item.nb_cliente }} 
            </v-card-text>
            <v-card-actions>
                <v-btn color="success" @click="delItem()" >confirmar</v-btn>
                <v-btn color="error" @click="dialog = !dialog">cancelar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</div>

</template>

<script>
    import ClienteForm from './ClienteForm'
    import listMixin from '~/mixins/Applist' 

    export default {
        mixins:[listMixin],
        components:{ 'cliente-form': ClienteForm},
        data(){
            return {
                resource: 'cliente',
                headers:[
                    { text: 'Nombre Cliente',   value: 'nb_cliente' },
                    { text: 'Rif ' ,            value: 'tx_rif' },
                    { text: 'Telefono' ,        value: 'tx_telefono' },
                    { text: 'Contacto' ,        value: 'tx_contacto' },
                    { text: 'Email' ,           value: 'tx_email' },
                    { text: 'Tipo de Cliente' , value: 'id_tipo_cliente' },
                    { text: 'Clase Cliente ' ,  value: 'id_clase_cliente' },
                    { text: 'Status ' ,         value: 'id_status' },
                    { text: 'Dirección ' ,      value: 'tx_direccion' },
                    { text: 'Observaciones ' ,  value: 'tx_observaciones' },
                    { text: 'Acción',           value: null         }
                ],
            }
        }
    }
</script>

<style>

</style>
