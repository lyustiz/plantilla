<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

        <v-layout wrap>
                 
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.co_accion"
                label="Accion"
                placeholder="Indique Accion"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_tabla"
                label="Tabla"
                placeholder="Indique Tabla"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.in_id_tabla"
                label="Id Tabla"
                placeholder="Indique Id Tabla"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_old_valor"
                label="Old Valor"
                placeholder="Indique Old Valor"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_new_valor"
                label="New Valor"
                placeholder="Indique New Valor"
            ></v-text-field>
        </v-flex>
                 
        <v-flex xs12 sm3>
            <v-menu
                ref="picker"
                v-model="pickers.fe_accion"
                min-width="290px"
                readonly
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        v-on="on"
                        v-model="dates.fe_accion"
                        :rules="rules.etapaCo"
                        label="Accion"
                        prepend-icon="event"
                        readonly
                        required
                    ></v-text-field>
                </template>

                <v-date-picker 
                    v-model="form.fe_accion" 
                    locale="es"
                    @input="dates.fe_accion = formatDate( form.fe_accion )"
                ></v-date-picker>
            </v-menu>
        </v-flex>
         
        <v-flex xs12 sm6>
            <v-select
            :items="lists.usuario"
            item-text="nb_usuario"
            item-value="id_usuario"
            v-model="form.id_usuario"
            :rules="rules.select"
            label="Usuario"
            autocomplete
            required
            ></v-select>
        </v-flex>
         
        </v-layout>

     </v-form>

    <template slot="buttons">
        <form-buttons
            @update="update()"
            @store="store()"
            @clear="clear()"
            @cancel="cancel()"
            :btnAccion="btnAccion"
            :valido="valido"
        ></form-buttons>
    </template>

    </form-container>

    <pre v-if="$App.debug">{{ $data }}</pre>

</div>
</template>

<script>
import Appform from '~/mixins/Appform';
export default {
    mixins: [Appform],
    data(){
        return{
            tabla: 'bitacora',
            dates:
            {
                fe_accion: 	 null,
            },
            pickers:
            {
                fe_accion: 	 null,
            },
            form:
            {
                id_bitacora: 	null,
				id_usuario: 	null,
				co_accion: 	null,
				tx_tabla: 	null,
				in_id_tabla: 	null,
				tx_old_valor: 	null,
				tx_new_valor: 	null,
				fe_accion: 	null,
            },
            list:
            {
                usuario: 	 [],
            },
        }
    },
    methods:
    {
        update()
        {
        },
        store()
        {
        }
    }
}
</script>

<style>
</style>