<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

        <v-layout wrap>
                 
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.in_grupo_status"
                label="Grupo Status"
                placeholder="Indique Grupo Status"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_grupo_status"
                label="Grupo Status"
                placeholder="Indique Grupo Status"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nb_status2"
                label="Status2"
                placeholder="Indique Status2"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nu_orden"
                label="Orden"
                placeholder="Indique Orden"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.nu_orden2"
                label="Orden2"
                placeholder="Indique Orden2"
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
                v-model="form.id_usuario"
                label="Usuario"
                placeholder="Indique Usuario"
            ></v-text-field>
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
            tabla: 'status',
            form:{
                id_status,
				nb_status,
				in_grupo_status,
				nb_grupo_status,
				nb_status2,
				nu_orden,
				nu_orden2,
				fe_creado,
				fe_actualizado,
				id_usuario,
            },
            listas:{
                
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