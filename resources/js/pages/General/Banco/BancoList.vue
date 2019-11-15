<template>
<div>
<v-btn 
    color="primary" 
    :loading="loading"
    @click="insertForm()"
    >
    Crear Banco
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
        item-key="id_banco"
        rows-per-page-text="Res. x Pag"
        disable-initial-sort
        :loading="loading"
    >
        <template slot="items" slot-scope="linea">
            <td class="text-xs-left">{{ linea.item.nb_banco }}</td>
            <td class="text-xs-left">{{ linea.item.nb_comercial }}</td>
            <td class="text-xs-left">{{ linea.item.co_banco }}</td>
            <td class="text-xs-left">{{ linea.item.tx_siglas }}</td>
            <td class="text-xs-left">{{ linea.item.tipo.nb_tipo_banco }}</td>
            <td class="text-xs-left">{{ linea.item.tx_grupo }}</td>

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

        <banco-form 
            @closeModal="closeModal()"
            :action="action"
            :item="selected"
        ></banco-form>

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
                <v-icon>alert</v-icon>Desea eliminar el Banco {{ item.nb_banco }} 
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
    import BancoForm from './BancoForm'
    import listMixin from '~/mixins/Applist' 

    export default {
        mixins:[listMixin],
        components:{ 'banco-form': BancoForm},
        data(){
            return {
                resource: 'banco',
                headers:[
                    { text: 'Nombre', value: 'nb_banco' },
                    { text: 'Nombre Comercial' , value: 'nb_comercial' },
                    { text: 'Código' ,value: 'co_banco' },
                    { text: 'Siglas' ,value: 'tx_siglas' },
                    { text: 'Tipo Banco' ,value: 'id_tipo_banco' },
                    { text: 'Grupo' ,value: 'tx_grupo' },
                    { text: 'Acción',value: null}
                ],
            }
        }
    }
</script>

<style>

</style>
