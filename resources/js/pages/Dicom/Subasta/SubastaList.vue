<template>
    <div>  
    <v-btn 
        slot="activator" 
        dark class="mb-2" 
        color="primary" 
        right 
        @click="insertForm()">
        Crear Subasta
       <v-icon dark right >add</v-icon>
    </v-btn>

    <!-- <v-dialog v-model="dialog" max-width="500px"> 
    </v-dialog> -->
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
        <v-flex 
            v-for="currency in selects.moneda.items" 
            :key="currency.id_moneda" 
            xs2
        >
            <v-switch
                v-model="currencies"
                :label="currency.nb_moneda" 
                :value="currency.co_bcv"
            >
            </v-switch>
        </v-flex>
        </v-layout>
    </v-container>
    
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
        item-key="id_subasta"
        
        sort-by=""
        :loading="loading">

        <template slot="items" slot-scope="linea">
            <td class="text-xs-left">{{ linea.item.co_subasta }}</td> 
            <td class="text-xs-left">{{ linea.item.nu_subasta }}</td>
            <td class="text-xs-left">{{ linea.item.fe_subasta | shortDate | formatDate }}</td>
            <td class="text-xs-left">{{ linea.item.status.nb_status }}</td>
            <td class="justify-center">
                <v-tooltip bottom>
                    <v-icon slot="activator" @click="handleFiles(linea.item,currencies,1)">
                    insert_drive_file
                    </v-icon>
                    <span>Archivo 1</span>
                </v-tooltip>

                <v-tooltip bottom>
                    <v-icon slot="activator" @click="handleFiles(linea.item,currencies,3)">
                    insert_drive_file
                    </v-icon>
                    <span>Archivo 3</span>
                </v-tooltip>
                <v-tooltip bottom>
                    <v-icon slot="activator" @click="handleFiles(linea.item,currencies,4)">
                    insert_drive_file
                    </v-icon>
                    <span>Archivo 4</span>
                </v-tooltip>
                <v-tooltip bottom>
                    <v-icon slot="activator" @click="getReport(linea.item)">
                    picture_as_pdf
                    </v-icon>
                    <span>Reporte</span>
                </v-tooltip>
            </td>
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
            La busqueda "{{ search }}" no se encontro resultados.
        </v-alert>
        <!-- <template slot="pageText" slot-scope="item">
            {{item.pageStart}} al {{item.pageStop}} de {{item.itemsLength}}        
        </template> -->
        
    </v-data-table>
    
    <app-modal :modal="modal" @closeModal="closeModal()">
    
        <susbasta-form 
            @closeModal="closeModal()" 
            :item="selected" 
            :action="action"
        ></susbasta-form>

    </app-modal>

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
                <v-icon>alert</v-icon> Desea eliminar la subasta {{ item.co_subasta }}
            </v-card-text>
            <v-card-actions>
                <v-btn color="success" @click="delItem()">confirmar</v-btn>
                <v-btn color="error" @click="dialog = !dialog">cancelar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
<!-- <pre v-if="$App.debug">{{ $data }}</pre> -->
 <!-- <pre>{{ resource }}</pre> -->
</div>

</template>
<script>
    import SubastaForm  from './SubastaForm'
    import listMixin    from '~/mixins/Applist' 
    import selectMixin  from '~/mixins/AppSelect'
    import dicomMixin   from '~/pages/Dicom/Mixins/dicom'

    export default { 
        mixins:[listMixin,selectMixin,dicomMixin],
        components:{ 
            'susbasta-form': SubastaForm
        },
        data(){
            return {
                resource: 'subasta',
                headers: [
                    { text: 'Numero',          value: 'nu_subasta' },
                    { text: 'Codigo Subasta ', value: 'co_subasta' },
                    { text: 'Fecha Subasta' ,  value: 'fe_subasta' },
                    { text: 'Estatus' ,        value: 'id_status' },
                    { text: 'Archivos' ,        value: null },
                    { text: 'Acción',          value: null}  

                ],
                selects:
                {
                    moneda: {group:'/grupo/dicom',items:[]},
                },
                currencies: []
            }
        }
    }
</script>
