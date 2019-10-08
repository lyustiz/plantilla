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
                item-key="id_banco"
                :loading="isLoading"
                rows-per-page-text="Res. x Pag"
                disable-initial-sort
            >

                <template slot="items" slot-scope="item">

                    <td class="text-xs-left">{{ item.item.nb_banco }}</td>
                    <td class="text-xs-left">{{ item.item.id_tipo_banco }}</td>
                    <td class="text-xs-left">{{ item.item.id_grupo_banco }}</td>
                    <td class="text-xs-center"> {{ item.item.id_status }} </td>

                    <td class="text-xs-center">
                        <list-buttons @editar="updItem(item.item)" @eliminar="delForm(item.item)" ></list-buttons>
                    </td>

                </template>

                <v-alert slot="no-results" :value="true" color="info" icon="info">
                    La busqueda "{{ search }}" No Obtuvo resultados
                </v-alert>

                <template slot="pageText" slot-scope="item">
                    {{item.pageStart}} - {{item.pageStop}} de {{item.itemsLength}}
                </template>

            </v-data-table>

            <app-modal
                :nb-action="nbAction"
                :modal="modal"
                @modalClose="modalClose()"
                :head-color="$App.theme.headModal"
            >
                <banco-form
                    :accion="accion"
                    :item="item"
                    :titulo="titulo"
                    @modalClose="modalClose()"
                ></banco-form>

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
import BancoForm  from './BancoForm';
export default {
    mixins:     [ listHelper],
    components: { 'banco-form': BancoForm },
    data () {
    return {
        titulo: 'Banco',
        headers: [
            { text: 'Nombre',   value: 'nb_banco' },
            { text: 'Tipo',     value: 'id_tipo_banco' },
            { text: 'Grupo',    value: 'id_grupo_banco' },
            { text: 'Status',   value: 'id_status'  },
            { text: 'Acciones', value: 'id_status'  },
        ],
    }
    },
    methods:
    {
        list () {
            this.items = [{'id_banco':1, 'nb_banco':'venezuela', 'id_tipo_banco':1, 'id_grupo_banco':1, 'id_status':1}]
            this.isLoading = false
        /*
           axios.get('api/banco')
            .then(respuesta => {
                this.items = respuesta.data;
                this.isLoading = false
            })
            .catch(error => {
                this.showError(error)
                this.isLoading = false
            })*/
        },
        delItem(){
            axios.delete('/api/v1/banco/'+this.item.id_banco)
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
