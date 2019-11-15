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
                <template slot="title">Registro de nuevo cliente</template>
                <template slot="fields">
                    <v-flex xs6 sm6>
                    <v-text-field 
                        label="Nombre del cliente*"
                        v-model="form.nb_cliente"
                        :rules="rules.required"
                        required hint="Nombre completo del cliente">
                    </v-text-field>
                    </v-flex>

                        <v-flex xs6 sm6>
                    <v-text-field 
                        label="Rif*"
                        v-model="form.tx_rif"
                        :rules="rules.required"
                        v required hint="rif del cliente emj J-xxxxxxxxx"
                    ></v-text-field>
                    </v-flex>  
                    
                    <v-flex xs6 sm6 >
                    <v-text-field 
                        label="Telefono*"        
                        v-model="form.tx_telefono"
                        :rules="rules.required"
                        required hint="Telefono del cliente"
                        prepend-icon="call"
                        >
                    </v-text-field>
                    </v-flex>

                    <v-flex xs6 sm6>
                    <v-text-field 
                        label="Contacto*"
                        v-model="form.tx_contacto"
                        :rules="rules.required"
                        required hint="Número contacto del cliente">
                    </v-text-field>
                    </v-flex >
                    
                    <v-flex xs6 sm6>
                    <v-text-field 
                        label="email del cliente*"
                        v-model="form.tx_email"
                        :rules="rules.required"
                        required hint="Correo del cliente">
                    </v-text-field>
                    </v-flex>

                    <v-flex xs6 sm6>
                    <v-select
                        label="Tipo cliente*"
                        :rules="rules.required"
                        v-model="form.id_tipo_cliente" 
                        :items="selects.tipo_cliente.items"
                        item-value="id_tipo_cliente"
                        item-text="nb_tipo_cliente"
                    ></v-select>
                    </v-flex>

                    <v-flex xs6 sm6 d-flex>
                    <v-select
                        label="Clase cliente*"
                        :rules="rules.required"
                        v-model="form.id_clase_cliente" 
                        :items="selects.clase_cliente.items"
                        item-value="id_clase_cliente"
                        item-text="nb_clase_cliente"
                    ></v-select>
                    </v-flex>

                    <v-flex xs12 sm6 d-flex>
                    <v-select
                        label="Estatus cliente*"
                        :rules="rules.required"
                        v-model="form.id_status" 
                        :items="selects.status.items"
                        item-value="id_status"
                        item-text="nb_status"
                    ></v-select>
                    </v-flex>

                    <v-flex xs6 sm6>
                    <v-text-field 
                        label="Dirección del cliente*"
                        v-model="form.tx_direccion"
                        :rules="rules.required"
                        required hint="dirección completo del cliente">
                    </v-text-field>
                    </v-flex>


                    <v-flex xs6 sm6>
                    <v-text-field 
                        label="Observaciones del cliente*"
                        v-model="form.tx_observaciones"
                        required hint="Nombre completo del cliente">
                    </v-text-field>
                    </v-flex>

                    <v-flex xs6 sm6>
                    <v-text-field 
                        label="Grupo del cliente*"
                        v-model="form.tx_grupo"
                        :rules="rules.required"
                        required hint="Grupo del cliente">
                    </v-text-field>
                    </v-flex>
                </template>
            </app-form>
        <!-- <pre>{{selects}}</pre> -->
        </v-form>
    </v-layout>
</template>

<script>
    import formMixin from "~/mixins/Appform" 
    export default {
        mixins:[formMixin],
        data(){
            return {
                resource: 'cliente',
                form:{
                    nb_cliente       :null,
                    tx_rif           :null,
                    tx_telefono      :null,
                    tx_contacto      :null,
                    tx_email         :null,
                    id_tipo_cliente  :null,
                    id_clase_cliente :null,
                    id_status        :null,
                    tx_direccion     :null,
                    tx_observaciones :null,
                    tx_grupo         :null,
                },
                selects:
                {   
                    status: {group:'/grupo/general',items:[]},  
                    clase_cliente: {group:'/grupo/general',items:[]},
                    tipo_cliente:{group:'/grupo/general',items:[]}
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
