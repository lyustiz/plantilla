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
                item-key="id_visitante_alerta"
                :loading="isLoading"
                sort-by=""
            >

                <template slot="items" slot-scope="item">

                    <td class="text-xs-left">{{ item.item.id_visitante_alerta }}</td>
					<td class="text-xs-left">{{ item.item.id_visitante }}</td>
					<td class="text-xs-left">{{ item.item.id_tipo_alerta }}</td>
					<td class="text-xs-left">{{ item.item.id_visita }}</td>
					<td class="text-xs-left">{{ item.item.id_status }}</td>
					<td class="text-xs-left">{{ item.item.id_usuario }}</td>
					<td class="text-xs-left">{{ item.item.tx_motivo_alerta }}</td>
					<td class="text-xs-left">{{ item.item.tx_anulacion }}</td>
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
                <visitante-alerta-form
                    :accion="accion"
                    :item="item"
                    :titulo="titulo"
                    @modalClose="modalClose()"
                ></visitante-alerta-form>

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
import visitanteAlertaForm  from './visitanteAlertaForm';
export default {
    mixins:     [ listHelper],
    components: { 'visitante-alerta-form': visitanteAlertaForm },
    data () {
    return {
        titulo: 'VisitanteAlerta',
        headers: [
            { text: 'Visitante Alerta',   value: 'id_visitante_alerta' },
			{ text: 'Visitante',   value: 'id_visitante' },
			{ text: 'Tipo Alerta',   value: 'id_tipo_alerta' },
			{ text: 'Visita',   value: 'id_visita' },
			{ text: 'Status',   value: 'id_status' },
			{ text: 'Usuario',   value: 'id_usuario' },
			{ text: 'Motivo Alerta',   value: 'tx_motivo_alerta' },
			{ text: 'Anulacion',   value: 'tx_anulacion' },
			{ text: 'Creado',   value: 'fe_creado' },
			{ text: 'Actualizado',   value: 'fe_actualizado' },
            { text: 'Acciones', value: 'id_visitante_alerta'  },
        ],
    }
    },
    methods:
    {
        list () {

            this.isLoading = false
            
            axios.get('api/v1/visitanteAlerta')
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
            axios.delete('/api/v1/visitanteAlerta/'+this.item.id_visitante_alerta)
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