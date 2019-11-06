<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

        <v-layout wrap>
                 
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_motivo"
                label="Motivo"
                placeholder="Indique Motivo"
            ></v-text-field>
        </v-flex>
                 
        <v-flex xs12 sm3>
            <v-menu
                ref="picker"
                v-model="pickers.fe_creado"
                min-width="290px"
                readonly
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        v-on="on"
                        v-model="dates.fe_creado"
                        :rules="rules.etapaCo"
                        label="Creado"
                        prepend-icon="event"
                        readonly
                        required
                    ></v-text-field>
                </template>

                <v-date-picker 
                    v-model="form.fe_creado" 
                    locale="es"
                    @input="dates.fe_creado = formatDate( form.fe_creado )"
                ></v-date-picker>
            </v-menu>
        </v-flex>

        <v-flex xs12 sm3>
            <v-menu
                ref="picker"
                v-model="pickers.fe_actualizado"
                min-width="290px"
                readonly
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        v-on="on"
                        v-model="dates.fe_actualizado"
                        :rules="rules.etapaCo"
                        label="Actualizado"
                        prepend-icon="event"
                        readonly
                        required
                    ></v-text-field>
                </template>

                <v-date-picker 
                    v-model="form.fe_actualizado" 
                    locale="es"
                    @input="dates.fe_actualizado = formatDate( form.fe_actualizado )"
                ></v-date-picker>
            </v-menu>
        </v-flex>
         
        <v-flex xs12 sm6>
            <v-select
            :items="lists.status"
            item-text="nb_status"
            item-value="id_status"
            v-model="form.id_status"
            :rules="rules.select"
            label="Status"
            autocomplete
            required
            ></v-select>
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
            tabla: 'motivo',
            dates:
            {
                fe_creado: 	 null,
	 	 	 	fe_actualizado: 	 null,
            },
            pickers:
            {
                fe_creado: 	 null,
	 	 	 	fe_actualizado: 	 null,
            },
            form:
            {
                id_motivo: 	null,
				id_status: 	null,
				id_usuario: 	null,
				nb_motivo: 	null,
				fe_creado: 	null,
				fe_actualizado: 	null,
            },
            list:
            {
                status: 	 [],
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