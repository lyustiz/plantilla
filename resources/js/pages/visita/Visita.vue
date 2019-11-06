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
                item-key="id_visita"
                :loading="isLoading"
                sort-by=""
            >

                <template slot="items" slot-scope="item">

                    <td class="text-xs-left">{{ item.item.id_visita }}</td>
					<td class="text-xs-left">{{ item.item.id_visitante }}</td>
					<td class="text-xs-left">{{ item.item.id_tipo_visitante }}</td>
					<td class="text-xs-left">{{ item.item.id_empresa }}</td>
					<td class="text-xs-left">{{ item.item.id_motivo }}</td>
					<td class="text-xs-left">{{ item.item.id_status }}</td>
					<td class="text-xs-left">{{ item.item.id_usuario }}</td>
					<td class="text-xs-left">{{ item.item.nu_ced_empleado }}</td>
					<td class="text-xs-left">{{ item.item.tx_cargo }}</td>
					<td class="text-xs-left">{{ item.item.tx_observaciones }}</td>
					<td class="text-xs-left">{{ item.item.nu_carnet }}</td>
					<td class="text-xs-left">{{ item.item.fe_entrada }}</td>
					<td class="text-xs-left">{{ item.item.fe_salida }}</td>
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
                <visita-form
                    :accion="accion"
                    :item="item"
                    :titulo="titulo"
                    @modalClose="modalClose()"
                ></visita-form>

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
import visitaForm  from './visitaForm';
export default {
    mixins:     [ listHelper],
    components: { 'visita-form': visitaForm },
    data () {
    return {
        titulo: 'Visita',
        headers: [
            { text: 'Visita',   value: 'id_visita' },
			{ text: 'Visitante',   value: 'id_visitante' },
			{ text: 'Tipo Visitante',   value: 'id_tipo_visitante' },
			{ text: 'Empresa',   value: 'id_empresa' },
			{ text: 'Motivo',   value: 'id_motivo' },
			{ text: 'Status',   value: 'id_status' },
			{ text: 'Usuario',   value: 'id_usuario' },
			{ text: 'Ced Empleado',   value: 'nu_ced_empleado' },
			{ text: 'Cargo',   value: 'tx_cargo' },
			{ text: 'Observaciones',   value: 'tx_observaciones' },
			{ text: 'Carnet',   value: 'nu_carnet' },
			{ text: 'Entrada',   value: 'fe_entrada' },
			{ text: 'Salida',   value: 'fe_salida' },
			{ text: 'Creado',   value: 'fe_creado' },
			{ text: 'Actualizado',   value: 'fe_actualizado' },
            { text: 'Acciones', value: 'id_visita'  },
        ],
    }
    },
    methods:
    {
        list () {

            this.isLoading = false
            
            axios.get('api/v1/visita')
            .then(response => {
                this.items = response.data;
                this.isLoading = false
            })
            .catch(error => {
                this.showError(error)
                this.isLoading = false
            })
        },
        delItem()
        {
            axios.delete('/api/v1/visita/'+this.item.id_visita)
            .then(response => {
                this.verMsj(response.data.msj)
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