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
                item-key="id_bitacora"
                :loading="isLoading"
                sort-by=""
            >

                <template slot="items" slot-scope="item">

                    <td class="text-xs-left">{{ item.item.id_bitacora }}</td>
					<td class="text-xs-left">{{ item.item.id_usuario }}</td>
					<td class="text-xs-left">{{ item.item.co_accion }}</td>
					<td class="text-xs-left">{{ item.item.tx_tabla }}</td>
					<td class="text-xs-left">{{ item.item.in_id_tabla }}</td>
					<td class="text-xs-left">{{ item.item.tx_old_valor }}</td>
					<td class="text-xs-left">{{ item.item.tx_new_valor }}</td>
					<td class="text-xs-left">{{ item.item.fe_accion }}</td>
                    
                
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
                <bitacora-form
                    :accion="accion"
                    :item="item"
                    :titulo="titulo"
                    @modalClose="modalClose()"
                ></bitacora-form>

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
import bitacoraForm  from './bitacoraForm';
export default {
    mixins:     [ listHelper],
    components: { 'bitacora-form': bitacoraForm },
    data () {
    return {
        titulo: 'Bitacora',
        headers: [
            
            { text: 'Bitacora',   value: 'id_bitacora' },
			{ text: 'Usuario',   value: 'id_usuario' },
			{ text: 'Accion',   value: 'co_accion' },
			{ text: 'Tabla',   value: 'tx_tabla' },
			{ text: 'Id Tabla',   value: 'in_id_tabla' },
			{ text: 'Old Valor',   value: 'tx_old_valor' },
			{ text: 'New Valor',   value: 'tx_new_valor' },
			{ text: 'Accion',   value: 'fe_accion' },

            { text: 'Acciones', value: 'id_status'  },
        ],
    }
    },
    methods:
    {
        list () {

            this.isLoading = false
        
           axios.get('api/v1/bitacora')
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
            axios.delete('/api/v1/bitacora/'+this.item.id_bitacora)
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