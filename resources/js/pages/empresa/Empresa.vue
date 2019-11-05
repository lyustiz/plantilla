<template>

    <list-container :titulo="titulo" :head-color="$App.theme.headList">

        <template slot="HeadTools">
            <add-button @insItem="insItem()"></add-button>
        </template>

            <v-flex xs12 xs6>
                <v-text-field
                    v-model="search"
                    append-icon="search"
                    label="Buscar"
                    hide-details
                    clearable
                ></v-text-field>
            </v-flex>

            <v-data-table
                :headers="headers"
                :items  ="items"
                :search ="search"
                v-model ="selected"
                item-key="id_empresa"
                :loading="isLoading"
                sort-by=""
            >

                <template slot="items" slot-scope="item">

                    <td class="text-xs-left">{{ item.item.id_empresa }}</td>
					<td class="text-xs-left">{{ item.item.id_status }}</td>
					<td class="text-xs-left">{{ item.item.id_usuario }}</td>
					<td class="text-xs-left">{{ item.item.nb_empresa }}</td>
					<td class="text-xs-left">{{ item.item.tx_rif }}</td>
					<td class="text-xs-left">{{ item.item.tx_direccion }}</td>
					<td class="text-xs-left">{{ item.item.tx_telefono }}</td>
					<td class="text-xs-left">{{ item.item.tx_contacto }}</td>
					<td class="text-xs-left">{{ item.item.tx_correo }}</td>
					<td class="text-xs-left">{{ item.item.id_tipo_empresa }}</td>
					<td class="text-xs-left">{{ item.item.id_pais }}</td>
					<td class="text-xs-left">{{ item.item.id_region1 }}</td>
					<td class="text-xs-left">{{ item.item.id_region2 }}</td>
					<td class="text-xs-left">{{ item.item.id_region3 }}</td>
					<td class="text-xs-left">{{ item.item.tx_observaciones }}</td>
					<td class="text-xs-left">{{ item.item.fe_creado }}</td>
					<td class="text-xs-left">{{ item.item.fe_actualizado }}</td>
					<td class="text-xs-left">{{ item.item.id_empresa_ppal }}</td>
                    
                
                    <td class="text-xs-center">
                        <list-buttons @editar="updItem(item.item)" @eliminar="delForm(item.item)" ></list-buttons>
                    </td>

                </template>

            </v-data-table>

            <app-modal
                :nb-action="nbAction"
                :modal="modal"
                @modalClose="modalClose()"
                :head-color="$App.theme.headModal"
            >
                <empresa-form
                    :accion="accion"
                    :item="item"
                    :titulo="titulo"
                    @modalClose="modalClose()"
                ></empresa-form>

            </app-modal>

            <app-dialogo
                :dialog="dialog"
                mensaje="Desea eliminar el Item Seleccionado?"
                @delItem="delItem()"
                @delCancel="delCancel()"
            ></app-dialogo>

            <app-mensaje></app-mensaje>

            <pre v-if="$App.debug">{{ $data }}</pre>

    </list-container>

</template>

<script>
import listHelper from '~/mixins/Applist';
import empresaForm  from './empresaForm';
export default {
    mixins:     [ listHelper],
    components: { 'empresa-form': empresaForm },
    data () {
    return {
        titulo: 'Empresa',
        headers: [
            
            { text: 'Empresa',   value: 'id_empresa' },
			{ text: 'Status',   value: 'id_status' },
			{ text: 'Usuario',   value: 'id_usuario' },
			{ text: 'Empresa',   value: 'nb_empresa' },
			{ text: 'Rif',   value: 'tx_rif' },
			{ text: 'Direccion',   value: 'tx_direccion' },
			{ text: 'Telefono',   value: 'tx_telefono' },
			{ text: 'Contacto',   value: 'tx_contacto' },
			{ text: 'Correo',   value: 'tx_correo' },
			{ text: 'Tipo Empresa',   value: 'id_tipo_empresa' },
			{ text: 'Pais',   value: 'id_pais' },
			{ text: 'Region1',   value: 'id_region1' },
			{ text: 'Region2',   value: 'id_region2' },
			{ text: 'Region3',   value: 'id_region3' },
			{ text: 'Observaciones',   value: 'tx_observaciones' },
			{ text: 'Creado',   value: 'fe_creado' },
			{ text: 'Actualizado',   value: 'fe_actualizado' },
			{ text: 'Empresa Ppal',   value: 'id_empresa_ppal' },

            { text: 'Acciones', value: 'id_status'  },
        ],
    }
    },
    methods:
    {
        list () {

            this.isLoading = false
        
           axios.get('api/v1/empresa')
            .then(respuesta => {
                this.items = respuesta.data;
                this.isLoading = false
            })
            .catch(error => {
                this.showError(error)
                this.isLoading = false
            })
        },
        delItem(){
            axios.delete('/api/v1/empresa/'+this.item.id_empresa)
            .then(respuesta => {
                this.verMsj(respuesta.data.msj)
                this.list();
                this.item = '';
                this.dialogo = false;
            })
            .catch(error => {
                this.showError(error)
            })
        }
    }
}
</script>

<style>
</style>