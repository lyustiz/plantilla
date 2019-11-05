<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

        <v-layout wrap>
                 
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.in_grupo_status"
                label="Grupo Status"
                placeholder="Indique Grupo Status"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_grupo_status"
                label="Grupo Status"
                placeholder="Indique Grupo Status"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_status2"
                label="Status2"
                placeholder="Indique Status2"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nu_orden"
                label="Orden"
                placeholder="Indique Orden"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nu_orden2"
                label="Orden2"
                placeholder="Indique Orden2"
            ></v-text-field>
        </v-flex>
                 
        <v-flex xs12 sm3>
            <v-menu
                ref="picker"
                v-model="picker.fe_creado"
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
                v-model="picker.fe_actualizado"
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

        <v-flex xs12 sm3>
            <v-menu
                ref="picker"
                v-model="picker.id_usuario"
                min-width="290px"
                readonly
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        v-on="on"
                        v-model="dates.id_usuario"
                        :rules="rules.etapaCo"
                        label="Usuario"
                        prepend-icon="event"
                        readonly
                        required
                    ></v-text-field>
                </template>

                <v-date-picker 
                    v-model="form.id_usuario" 
                    locale="es"
                    @input="dates.id_usuario = formatDate( form.id_usuario )"
                ></v-date-picker>
            </v-menu>
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

    <pre v-if="$App.debug">{{ $props }}</pre>

</div>
</template>

<script>
import Appform from '~/mixins/Appform';
export default {
    mixins: [Appform],
    data(){
        return{
            tabla: 'status',
            pickers:{
                fe_creado: 	 null,
	 	 	 	fe_actualizado: 	 null,
	 	 	 	id_usuario: 	 null,
            },
            form:{
                id_status: 	null,
				nb_status: 	null,
				in_grupo_status: 	null,
				nb_grupo_status: 	null,
				nb_status2: 	null,
				nu_orden: 	null,
				nu_orden2: 	null,
				fe_creado: 	null,
				fe_actualizado: 	null,
				id_usuario: 	null,
            },
            list:{
                
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