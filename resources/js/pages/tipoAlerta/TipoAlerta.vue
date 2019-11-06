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
                item-key="id_tipo_alerta"
                :loading="isLoading"
                sort-by=""
            >

                <template slot="items" slot-scope="item">

                    <td class="text-xs-left">{{ item.item.id_tipo_alerta }}</td>
					<td class="text-xs-left">{{ item.item.id_status }}</td>
					<td class="text-xs-left">{{ item.item.id_usuario }}</td>
					<td class="text-xs-left">{{ item.item.nb_tipo_alerta }}</td>
					<td class="text-xs-left">{{ item.item.nu_nivel_alerta }}</td>
					<td class="text-xs-left">{{ item.item.tx_accion }}</td>
					<td class="text-xs-left">{{ item.item.tx_imagen }}</td>
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
                <tipo-alerta-form
                    :accion="accion"
                    :item="item"
                    :titulo="titulo"
                    @modalClose="modalClose()"
                ></tipo-alerta-form>

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
import tipoAlertaForm  from './tipoAlertaForm';
export default {
    mixins:     [ listHelper],
    components: { 'tipo-alerta-form': tipoAlertaForm },
    data () {
    return {
        titulo: 'TipoAlerta',
        headers: [
            { text: 'Tipo Alerta',   value: 'id_tipo_alerta' },
			{ text: 'Status',   value: 'id_status' },
			{ text: 'Usuario',   value: 'id_usuario' },
			{ text: 'Tipo Alerta',   value: 'nb_tipo_alerta' },
			{ text: 'Nivel Alerta',   value: 'nu_nivel_alerta' },
			{ text: 'Accion',   value: 'tx_accion' },
			{ text: 'Imagen',   value: 'tx_imagen' },
			{ text: 'Creado',   value: 'fe_creado' },
			{ text: 'Actualizado',   value: 'fe_actualizado' },
            { text: 'Acciones', value: 'id_tipo_alerta'  },
        ],
    }
    },
    methods:
    {
        list () {

            this.isLoading = false
            
            axios.get('api/v1/tipoAlerta')
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
            axios.delete('/api/v1/tipoAlerta/'+this.item.id_tipo_alerta)
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