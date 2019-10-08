<template>
<div>

    <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

            <v-layout wrap>

                <v-flex xs12 sm6>
                   <v-text-field
                       label="Nombre Banco"
                       v-model="form.nb_banco"
                   ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6>
                   <v-text-field
                       label="Nombre Banco"
                       v-model="form.nb_banco"
                   ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6>
                   <v-text-field
                       label="Nombre Banco"
                       v-model="form.nb_banco"
                   ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6>
                   <v-text-field
                       label="Nombre Banco"
                       v-model="form.nb_banco"
                   ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6>
                    <v-select
                        label="Tipo de Banco"
                        v-model="form.id_tipo_banco"
                        :items="['nacional', 'internacional' ]"
                        :rules="rules.requerido"
                    ></v-select>
                </v-flex>

                <v-flex xs12>
                    <v-textarea
                        label="Observaciones"
                        v-model="form.tx_observaciones"
                    ></v-textarea>
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
            tabla: 'pago',
            form:{
                id_banco:        '',
                nb_banco:        '',
                id_grupo_banco:  '',
                id_tipo_banco:   '',
                tx_observaciones:'',
                id_usuario:      '',
                id_status:       '',
            },
            listas:{
                grupoBanco: ['/grupo/1'],
                tipoBanco:  ['/tipo/1'],
                status:     ['/grupo/3'],
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
