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
                v-model="form.id_usuario"
                label="Usuario"
                placeholder="Indique Usuario"
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
                v-model="form.tx_direccion"
                label="Direccion"
                placeholder="Indique Direccion"
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
                v-model="form.tx_contacto"
                label="Contacto"
                placeholder="Indique Contacto"
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
                v-model="form.id_tipo_empresa"
                label="Tipo Empresa"
                placeholder="Indique Tipo Empresa"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_pais"
                label="Pais"
                placeholder="Indique Pais"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_region1"
                label="Region1"
                placeholder="Indique Region1"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_region2"
                label="Region2"
                placeholder="Indique Region2"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_region3"
                label="Region3"
                placeholder="Indique Region3"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_observaciones"
                label="Observaciones"
                placeholder="Indique Observaciones"
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
                v-model="form.id_empresa_ppal"
                label="Empresa Ppal"
                placeholder="Indique Empresa Ppal"
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
                  
        <v-flex xs12 sm6>
            <v-select
            :items="list.usuario"
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

    <pre v-if="$App.debug">{{ $props }}</pre>

</div>
</template>

<script>
import formHelper from '~/mixins/Appform';
export default {
    mixins: [formHelper],
    data(){
        return{
            tabla: 'empresa',
            form:{
                id_empresa,
				id_status,
				id_usuario,
				nb_empresa,
				tx_rif,
				tx_direccion,
				tx_telefono,
				tx_contacto,
				tx_correo,
				id_tipo_empresa,
				id_pais,
				id_region1,
				id_region2,
				id_region3,
				tx_observaciones,
				fe_creado,
				fe_actualizado,
				id_empresa_ppal,
            },
            listas:{
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