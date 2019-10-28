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
                v-model="form.id_tipo_alerta"
                label="Tipo Alerta"
                placeholder="Indique Tipo Alerta"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.id_visita"
                label="Visita"
                placeholder="Indique Visita"
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
                v-model="form.tx_motivo_alerta"
                label="Motivo Alerta"
                placeholder="Indique Motivo Alerta"
            ></v-text-field>
        </v-flex>
                  
        <v-flex xs12 >
            <v-text-field
                :rules="rules.required"
                v-model="form.tx_anulacion"
                label="Anulacion"
                placeholder="Indique Anulacion"
            ></v-text-field>
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
            :items="list.visita"
            item-text="nb_visita"
            item-value="id_visita"
            v-model="form.id_visita"
            :rules="rules.select"
            label="Visita"
            autocomplete
            required
            ></v-select>
        </v-flex>
                  
        <v-flex xs12 sm6>
            <v-select
            :items="list.tipoAlerta"
            item-text="nb_tipo_alerta"
            item-value="id_tipo_alerta"
            v-model="form.id_tipo_alerta"
            :rules="rules.select"
            label="Tipo Alerta"
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
            tabla: 'visitante_alerta',
            form:{
                id_visitante_alerta,
				id_visitante,
				id_tipo_alerta,
				id_visita,
				id_status,
				id_usuario,
				tx_motivo_alerta,
				tx_anulacion,
				fe_creado,
				fe_actualizado,
            },
            listas:{
                visitante: 	 [],
	 	 	 	visita: 	 [],
	 	 	 	tipoAlerta: 	 [],
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