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
                <template slot="title">Nueva Subasta Dicom</template>
                <template slot="fields">
                    <v-flex xs12 sm6>
                    <v-text-field 
                        label="Numero Subasta*"
                        v-model="form.co_subasta"  
                        :rules="rules.required"
                        required hint="Numero subasta Dicom correlativo de 4 digitos 1xxx">
                    </v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6>
                    <v-text-field 
                        label="Codigo Subasta Dicom*" 
                        v-model="form.nu_subasta"  
                        :rules="rules.required"
                        v required hint="Codigo subasta Dicom CS-SO-XX-XX"
                    ></v-text-field>

                    </v-flex>

                    <v-flex xs12 sm6>
                        <v-menu
                            ref="calendar"
                            v-model="calendar"
                            full-width
                            min-width="290px"
                        >
                        <template v-slot:activator="{ on }">
                            <v-text-field
                            slot="activator"
                            v-model="fe_subasta"
                            :rules="rules.fecha"
                            label="Seleccione Fecha"
                            prepend-icon="event"
                            readonly
                            required
                            v-on="on"
                            ></v-text-field>
                        </template>

                        <v-date-picker 
                            v-model="form.fe_subasta" 
                            locale="es-419" 
                            @input="calandar = false"
                        ></v-date-picker>
                        </v-menu>
                    </v-flex>

                    <v-flex xs12 sm6 d-flex>
                        <v-select
                            label="Estado de Subasta*"
                            v-model="form.id_status" 
                            :items="selects.status.items"
                            item-value="id_status"
                            item-text="nb_status"
                            required hint="Seleccione el estado de la subasta"
                        ></v-select>
                    </v-flex>
                </template>
            </app-form>
        </v-form>
    </v-layout>
  </template>
<script>
  import formMixin from "~/mixins/Appform"

  export default {
    mixins:[formMixin],
    data() 
    {
        return{
            resource: 'subasta',
            form :{
                nu_subasta:         null,
                co_subasta:         null,
                fe_subasta:         null,
                id_status:          null,
                id_usuario: this.$store.getters.getUser.id_usuario,
            },
            selects:
            {
                status: {group:'/grupo/subasta',items:[]},
            },
        }
    },
    computed: {
        fe_subasta:{
            get:function () {
                return this.formatDate(this.form.fe_subasta)
            },
            set:function(value){
                this.form.fe_subasta = this.parseDate(value)
            }
        }
    },
    watch:{
        fe_subasta:function(val){
            this.form.id_usuario = this.$store.getters.getUser.id_usuario
        }
    }
  }
  
</script>