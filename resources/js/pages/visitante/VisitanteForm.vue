<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

        <v-layout wrap>
                 
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_nombres"
                label="Nombres"
                placeholder="Indique Nombres"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_apellidos"
                label="Apellidos"
                placeholder="Indique Apellidos"
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
                v-model="form.tx_nacionalidad"
                label="Nacionalidad"
                placeholder="Indique Nacionalidad"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_foto"
                label="Foto"
                placeholder="Indique Foto"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_cod_pais"
                label="Cod Pais"
                placeholder="Indique Cod Pais"
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
            :items="lists.visitante"
            item-text="nb_visitante"
            item-value="id_visitante"
            v-model="form.id_visitante"
            :rules="rules.select"
            label="Visitante"
            autocomplete
            required
            ></v-select>
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
            tabla: 'visitante',
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
                id_visitante: 	null,
				id_status: 	null,
				id_usuario: 	null,
				tx_nombres: 	null,
				tx_apellidos: 	null,
				nu_cedula: 	null,
				tx_nacionalidad: 	null,
				tx_foto: 	null,
				tx_cod_pais: 	null,
				tx_telefono: 	null,
				fe_creado: 	null,
				fe_actualizado: 	null,
            },
            list:
            {
                visitante: 	 [],
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