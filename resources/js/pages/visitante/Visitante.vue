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
                item-key="id_visitante"
                :loading="isLoading"
                sort-by=""
            >

                <template slot="items" slot-scope="item">

                    <td class="text-xs-left">{{ item.item.id_visitante }}</td>
					<td class="text-xs-left">{{ item.item.id_status }}</td>
					<td class="text-xs-left">{{ item.item.id_usuario }}</td>
					<td class="text-xs-left">{{ item.item.tx_nombres }}</td>
					<td class="text-xs-left">{{ item.item.tx_apellidos }}</td>
					<td class="text-xs-left">{{ item.item.nu_cedula }}</td>
					<td class="text-xs-left">{{ item.item.tx_nacionalidad }}</td>
					<td class="text-xs-left">{{ item.item.tx_foto }}</td>
					<td class="text-xs-left">{{ item.item.tx_cod_pais }}</td>
					<td class="text-xs-left">{{ item.item.tx_telefono }}</td>
					<td class="text-xs-left">{{ item.item.fe_creado }}</td>
					<td class="text-xs-left">{{ item.item.fe_actualizado }}</td>
                    
                
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
                <visitante-form
                    :accion="accion"
                    :item="item"
                    :titulo="titulo"
                    @modalClose="modalClose()"
                ></visitante-form>

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
import visitanteForm  from './visitanteForm';
export default {
    mixins:     [ listHelper],
    components: { 'visitante-form': visitanteForm },
    data () {
    return {
        titulo: 'Visitante',
        headers: [
            
            { text: 'Visitante',   value: 'id_visitante' },
			{ text: 'Status',   value: 'id_status' },
			{ text: 'Usuario',   value: 'id_usuario' },
			{ text: 'Nombres',   value: 'tx_nombres' },
			{ text: 'Apellidos',   value: 'tx_apellidos' },
			{ text: 'Cedula',   value: 'nu_cedula' },
			{ text: 'Nacionalidad',   value: 'tx_nacionalidad' },
			{ text: 'Foto',   value: 'tx_foto' },
			{ text: 'Cod Pais',   value: 'tx_cod_pais' },
			{ text: 'Telefono',   value: 'tx_telefono' },
			{ text: 'Creado',   value: 'fe_creado' },
			{ text: 'Actualizado',   value: 'fe_actualizado' },

            { text: 'Acciones', value: 'id_status'  },
        ],
    }
    },
    methods:
    {
        list () {

            this.isLoading = false
        
           axios.get('api/v1/visitante')
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
            axios.delete('/api/v1/visitante/'+this.item.id_visitante)
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