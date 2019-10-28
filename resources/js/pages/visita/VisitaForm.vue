<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

        <v-layout wrap>
                 
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_visitante"
                label="Visitante"
                placeholder="Indique Visitante"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_tipo_visitante"
                label="Tipo Visitante"
                placeholder="Indique Tipo Visitante"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_empresa"
                label="Empresa"
                placeholder="Indique Empresa"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_motivo"
                label="Motivo"
                placeholder="Indique Motivo"
            ></v-text-field>
        </v-flex>
                  
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
                v-model="form.nu_ced_empleado"
                label="Ced Empleado"
                placeholder="Indique Ced Empleado"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_cargo"
                label="Cargo"
                placeholder="Indique Cargo"
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
                v-model="form.nu_carnet"
                label="Carnet"
                placeholder="Indique Carnet"
            ></v-text-field>
        </v-flex>
                 
        <v-flex xs12 sm3>
            <v-menu
                ref="picker"
                v-model="picker.fe_entrada"
                full-width
                min-width="290px"
                readonly
            >
                <v-text-field
                slot="activator"
                v-model="dates.fe_entrada"
                :rules="rules.etapaCo"
                label="Fecha Corresponsal"
                prepend-icon="event"
                readonly
                required
                ></v-text-field>

                <v-date-picker 
                    v-model="form.fe_entrada" 
                    locale="es"
                    @input="dates.fe_entrada = formatDate( form.fe_entrada )"
                ></v-date-picker>
            </v-menu>
        </v-flex>

        <v-flex xs12 sm3>
            <v-menu
                ref="picker"
                v-model="picker.fe_salida"
                full-width
                min-width="290px"
                readonly
            >
                <v-text-field
                slot="activator"
                v-model="dates.fe_salida"
                :rules="rules.etapaCo"
                label="Fecha Corresponsal"
                prepend-icon="event"
                readonly
                required
                ></v-text-field>

                <v-date-picker 
                    v-model="form.fe_salida" 
                    locale="es"
                    @input="dates.fe_salida = formatDate( form.fe_salida )"
                ></v-date-picker>
            </v-menu>
        </v-flex>

        <v-flex xs12 sm3>
            <v-menu
                ref="picker"
                v-model="picker.fe_creado"
                full-width
                min-width="290px"
                readonly
            >
                <v-text-field
                slot="activator"
                v-model="dates.fe_creado"
                :rules="rules.etapaCo"
                label="Fecha Corresponsal"
                prepend-icon="event"
                readonly
                required
                ></v-text-field>

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
                full-width
                min-width="290px"
                readonly
            >
                <v-text-field
                slot="activator"
                v-model="dates.fe_actualizado"
                :rules="rules.etapaCo"
                label="Fecha Corresponsal"
                prepend-icon="event"
                readonly
                required
                ></v-text-field>

                <v-date-picker 
                    v-model="form.fe_actualizado" 
                    locale="es"
                    @input="dates.fe_actualizado = formatDate( form.fe_actualizado )"
                ></v-date-picker>
            </v-menu>
        </v-flex>
         
        <v-flex xs12 sm6>
            <v-select
            :items="list.visitante"
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
            :items="list.tipoVisitante"
            item-text="nb_tipo_visitante"
            item-value="id_tipo_visitante"
            v-model="form.id_tipo_visitante"
            :rules="rules.select"
            label="Tipo Visitante"
            autocomplete
            required
            ></v-select>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-select
            :items="list.empresa"
            item-text="nb_empresa"
            item-value="id_empresa"
            v-model="form.id_empresa"
            :rules="rules.select"
            label="Empresa"
            autocomplete
            required
            ></v-select>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-select
            :items="list.motivo"
            item-text="nb_motivo"
            item-value="id_motivo"
            v-model="form.id_motivo"
            :rules="rules.select"
            label="Motivo"
            autocomplete
            required
            ></v-select>
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
            tabla: 'visita',
            form:{
                id_visita,
				id_visitante,
				id_tipo_visitante,
				id_empresa,
				id_motivo,
				id_status,
				id_usuario,
				nu_ced_empleado,
				tx_cargo,
				tx_observaciones,
				nu_carnet,
				fe_entrada,
				fe_salida,
				fe_creado,
				fe_actualizado,
            },
            listas:{
                visitante: 	 [],
	 	 	 	tipoVisitante: 	 [],
	 	 	 	empresa: 	 [],
	 	 	 	motivo: 	 [],
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