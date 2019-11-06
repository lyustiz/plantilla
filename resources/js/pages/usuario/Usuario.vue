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
                item-key="id_usuario"
                :loading="isLoading"
                sort-by=""
            >

                <template slot="items" slot-scope="item">

                    <td class="text-xs-left">{{ item.item.id_usuario }}</td>
					<td class="text-xs-left">{{ item.item.id_status }}</td>
					<td class="text-xs-left">{{ item.item.nb_usuario }}</td>
					<td class="text-xs-left">{{ item.item.password }}</td>
					<td class="text-xs-left">{{ item.item.tx_correo }}</td>
					<td class="text-xs-left">{{ item.item.nu_cedula }}</td>
					<td class="text-xs-left">{{ item.item.nb_p_nombre }}</td>
					<td class="text-xs-left">{{ item.item.nb_s_nombre }}</td>
					<td class="text-xs-left">{{ item.item.nb_p_apellido }}</td>
					<td class="text-xs-left">{{ item.item.nb_s_apellido }}</td>
					<td class="text-xs-left">{{ item.item.tx_nacionalidad }}</td>
					<td class="text-xs-left">{{ item.item.tx_rif }}</td>
					<td class="text-xs-left">{{ item.item.tx_telefono }}</td>
					<td class="text-xs-left">{{ item.item.fe_creado }}</td>
					<td class="text-xs-left">{{ item.item.fe_actualizado }}</td>
					<td class="text-xs-left">{{ item.item.id_usuario_c }}</td>
                    
                
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
                <usuario-form
                    :accion="accion"
                    :item="item"
                    :titulo="titulo"
                    @modalClose="modalClose()"
                ></usuario-form>

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
import usuarioForm  from './usuarioForm';
export default {
    mixins:     [ listHelper],
    components: { 'usuario-form': usuarioForm },
    data () {
    return {
        titulo: 'Usuario',
        headers: [
            { text: 'Usuario',   value: 'id_usuario' },
			{ text: 'Status',   value: 'id_status' },
			{ text: 'Usuario',   value: 'nb_usuario' },
			{ text: 'Password',   value: 'password' },
			{ text: 'Correo',   value: 'tx_correo' },
			{ text: 'Cedula',   value: 'nu_cedula' },
			{ text: 'P Nombre',   value: 'nb_p_nombre' },
			{ text: 'S Nombre',   value: 'nb_s_nombre' },
			{ text: 'P Apellido',   value: 'nb_p_apellido' },
			{ text: 'S Apellido',   value: 'nb_s_apellido' },
			{ text: 'Nacionalidad',   value: 'tx_nacionalidad' },
			{ text: 'Rif',   value: 'tx_rif' },
			{ text: 'Telefono',   value: 'tx_telefono' },
			{ text: 'Creado',   value: 'fe_creado' },
			{ text: 'Actualizado',   value: 'fe_actualizado' },
			{ text: 'Usuario C',   value: 'id_usuario_c' },
            { text: 'Acciones', value: 'id_usuario'  },
        ],
    }
    },
    methods:
    {
        list () {

            this.isLoading = false
            
            axios.get('api/v1/usuario')
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
            axios.delete('/api/v1/usuario/'+this.item.id_usuario)
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