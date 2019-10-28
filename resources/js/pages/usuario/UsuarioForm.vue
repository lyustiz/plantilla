<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

        <v-layout wrap>
                 
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_status"
                label="Status"
                placeholder="Indique Status"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.password"
                label="Password"
                placeholder="Indique Password"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_correo"
                label="Correo"
                placeholder="Indique Correo"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nu_cedula"
                label="Cedula"
                placeholder="Indique Cedula"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_p_nombre"
                label="P Nombre"
                placeholder="Indique P Nombre"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_s_nombre"
                label="S Nombre"
                placeholder="Indique S Nombre"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_p_apellido"
                label="P Apellido"
                placeholder="Indique P Apellido"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_s_apellido"
                label="S Apellido"
                placeholder="Indique S Apellido"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_nacionalidad"
                label="Nacionalidad"
                placeholder="Indique Nacionalidad"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_rif"
                label="Rif"
                placeholder="Indique Rif"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_telefono"
                label="Telefono"
                placeholder="Indique Telefono"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.fe_creado"
                label="Creado"
                placeholder="Indique Creado"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.fe_actualizado"
                label="Actualizado"
                placeholder="Indique Actualizado"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_usuario_c"
                label="Usuario C"
                placeholder="Indique Usuario C"
            ></v-text-field>
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
import formHelper from '~/mixins/Appform';
export default {
    mixins: [formHelper],
    data(){
        return{
            tabla: 'usuario',
            form:{
                id_usuario,
				id_status,
				nb_usuario,
				password,
				tx_correo,
				nu_cedula,
				nb_p_nombre,
				nb_s_nombre,
				nb_p_apellido,
				nb_s_apellido,
				tx_nacionalidad,
				tx_rif,
				tx_telefono,
				fe_creado,
				fe_actualizado,
				id_usuario_c,
            },
            listas:{
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