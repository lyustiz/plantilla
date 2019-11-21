<template>
<div>
<v-btn 
    color="primary" 
    :loading="loading"
    @click="insertForm()"
    >
    Crear Moneda
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
        item-key="id_moneda"
        
        sort-by=""
        :loading="loading"
    >
        <template slot="items" slot-scope="linea">
            <td class="text-xs-left">{{ linea.item.nb_moneda }}</td>
            <td class="text-xs-left">{{ linea.item.co_iso }}</td>
            <td class="text-xs-left">{{ linea.item.co_bcv }}</td>
            <td class="text-xs-left">{{ linea.item.tx_simbolo }}</td>
            <td class="text-xs-left">{{ linea.item.tx_grupo }}</td>
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

        <moneda-form 
            @closeModal="closeModal()"
            :action="action"
            :item="selected"
        ></moneda-form>

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
                <v-icon>alert</v-icon>Desea eliminar la moneda {{ item.nb_moneda }} 
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
    import MonedaForm from './MonedaForm'
    import listMixin from '~/mixins/Applist' 

    export default {
        mixins:[listMixin],
        components:{ 'moneda-form': MonedaForm},
        data(){
            return {
                resource: 'moneda',
                headers:[
                    { text: 'Nombre de la Moneda', value: 'nb_moneda' },
                    { text: 'Código ISO de la Moneda' , value: 'co_iso' },
                    { text: 'Código BCV de la Moneda' , value: 'co_bcv' },
                    { text: 'Símbolo de la Moneda' , value: 'tx_simbolo' },
                    { text: 'Grupo de la Moneda' , value: 'tx_grupo' },
                    { text: 'Observaciones' ,  value: 'tx_observaciones' },
                    { text: 'Acción', value: null}
                ],
            }
        }
    }
</script>

<style>

</style>
