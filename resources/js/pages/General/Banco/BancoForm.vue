<template>
    <v-layout row justify-center>
        <v-form v-model="valid" :lazy-validation="true" ref="form">
            <app-form
            :action="action"
            :valid="valid"
            :loading="loading"
            v-on:cerrarModal="cerrarModal()"
            v-on:reset="reset()"
            v-on:store="store()"
            v-on:update="update()"
            >
                <template slot="title">Registro de nuevo Banco</template>
                <template slot="fields">
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Nombre del Banco*"
                            v-model="form.nb_banco"
                            :rules="rules.required"
                            required hint="Nombre de Banco">
                        </v-text-field>
                    </v-flex>
                    
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Nombre Comercial del Banco*"
                            v-model="form.nb_comercial"
                            :rules="rules.required"
                            required hint="Nombre Comercial de Banco">
                        </v-text-field>
                    </v-flex>
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Código del Banco*"
                            v-model="form.co_banco"
                            :rules="rules.required"
                            required hint="Código de Banco">
                        </v-text-field>
                    </v-flex>
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Siglas del Banco*"
                            v-model="form.tx_siglas"
                            :rules="rules.required"
                            required hint="Siglas de Banco">
                        </v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6 d-flex>
                        <v-select
                            label="Tipo de Banco*"
                            :rules="rules.required"
                            v-model="form.id_tipo_banco" 
                            :items="selects.tipo_banco.items"
                            item-value="id_tipo_banco"
                            item-text="nb_tipo_banco"
                        ></v-select>
                    </v-flex>

                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Grupo del Banco*"
                            v-model="form.tx_grupo"
                            :rules="rules.required"
                            required hint="Grupo del Banco">
                        </v-text-field>
                    </v-flex>
                </template>
            </app-form>
        </v-form>
    <!-- <pre>{{selects}}</pre> -->
    </v-layout>
</template>

<script>
    import formMixin from "~/mixins/Appform" 
    export default {
        mixins:[formMixin],
        data(){
            return {
                resource: 'banco',
                form:{
                    nb_banco:null,
                    nb_comercial:null,
                    co_banco:null,
                    tx_siglas:null,
                    id_tipo_banco:null,
                    tx_grupo:null,
                },
                selects:
                {   
                    tipo_banco: {group:'/grupo/dicom',items:[]},  
                }
            }
        },
        props:{
            clear:{
                type: Boolean,
                default: false

            },
            item:{
                type: Object,
                default: null
            },
            action:{
                type: String,
                default: null
            }
        }
    }
</script>

<style>

</style>
