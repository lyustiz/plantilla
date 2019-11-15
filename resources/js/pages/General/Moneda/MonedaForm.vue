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
                <template slot="title">Registro de nuevo Moneda</template>
                <template slot="fields"> 
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Nombre de la Moneda*"
                            v-model="form.nb_moneda"
                            :rules="rules.required"
                            required hint="Nombre de la Moneda">
                        </v-text-field>
                    </v-flex>
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Código ISO de la Moneda*"
                            v-model="form.co_iso"
                            :rules="rules.required"
                            required hint="Código ISO de la Moneda">
                        </v-text-field>
                    </v-flex>
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Código BCV de la Moneda*"
                            v-model="form.co_bcv"
                            :rules="rules.required"
                            required hint="Código ISO de la Moneda">
                        </v-text-field>
                    </v-flex>
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Símbolo de la Moneda*"
                            v-model="form.tx_simbolo"
                            :rules="rules.required"
                            required hint="Símbolo de la Moneda">
                        </v-text-field>
                    </v-flex>
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Grupo de la Moneda*"
                            v-model="form.tx_grupo"
                            :rules="rules.required"
                            required hint="Grupo de la Moneda">
                        </v-text-field>
                    </v-flex>
                    <v-flex xs6 sm6>
                        <v-text-field 
                            label="Observaciones"
                            v-model="form.tx_observaciones"
                            required hint="Observaciones">
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
                resource: 'moneda',
                form:{
                    nb_moneda : null,
                    co_iso : null,
                    co_bcv : null,
                    tx_simbolo : null,
                    tx_grupo : null,
                    tx_observaciones : null,
                },
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
