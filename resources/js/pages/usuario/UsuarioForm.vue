<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

        <v-layout wrap>
                 
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.id_status"
                label="Status"
                placeholder="Indique Status"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.password"
                label="Password"
                placeholder="Indique Password"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_correo"
                label="Correo"
                placeholder="Indique Correo"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nu_cedula"
                label="Cedula"
                placeholder="Indique Cedula"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_p_nombre"
                label="P Nombre"
                placeholder="Indique P Nombre"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_s_nombre"
                label="S Nombre"
                placeholder="Indique S Nombre"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_p_apellido"
                label="P Apellido"
                placeholder="Indique P Apellido"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_s_apellido"
                label="S Apellido"
                placeholder="Indique S Apellido"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_nacionalidad"
                label="Nacionalidad"
                placeholder="Indique Nacionalidad"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_rif"
                label="Rif"
                placeholder="Indique Rif"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_telefono"
                label="Telefono"
                placeholder="Indique Telefono"
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
                v-model="picker.id_usuario_c"
                min-width="290px"
                readonly
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        v-on="on"
                        v-model="dates.id_usuario_c"
                        :rules="rules.etapaCo"
                        label="Usuario C"
                        prepend-icon="event"
                        readonly
                        required
                    ></v-text-field>
                </template>

                <v-date-picker 
                    v-model="form.id_usuario_c" 
                    locale="es"
                    @input="dates.id_usuario_c = formatDate( form.id_usuario_c )"
                ></v-date-picker>
            </v-menu>
        </v-flex>
         
        <v-flex xs12 sm6>
            <v-select
            :items="list.status"
            item-text="nb_status"
            item-value="id_status"
            v-model="form.id_status"
            :rules="rules.select"
            label="Status"
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

    <pre v-if="$App.debug">{{ $props }}</pre>

</div>
</template>

<script>
import Appform from '~/mixins/Appform';
export default {
    mixins: [Appform],
    data(){
        return{
            tabla: 'usuario',
            pickers:{
                fe_creado: 	 null,
	 	 	 	fe_actualizado: 	 null,
	 	 	 	id_usuario_c: 	 null,
            },
            form:{
                id_usuario: 	null,
				id_status: 	null,
				nb_usuario: 	null,
				password: 	null,
				tx_correo: 	null,
				nu_cedula: 	null,
				nb_p_nombre: 	null,
				nb_s_nombre: 	null,
				nb_p_apellido: 	null,
				nb_s_apellido: 	null,
				tx_nacionalidad: 	null,
				tx_rif: 	null,
				tx_telefono: 	null,
				fe_creado: 	null,
				fe_actualizado: 	null,
				id_usuario_c: 	null,
            },
            list:{
                status: 	 [],
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