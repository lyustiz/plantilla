<template>
    <v-form v-model="valid" :lazy-validation="true" ref="form" >

        <app-form
        :action="action"
        :valid="valid"
        :loading="loading"
        @cerrarModal="cerrarModal()"
        @reset="reset()"
        @store="store()"
        @update="update()"
        >
            <template slot="title">Clientes</template>
            <template slot="fields">
                <!-- <v-flex xs12 sm6 >
                    <app-auto-complete
                    :label="label"
                    :searchUrl="searchUrl"
                    :hint="hint"
                    :itemText="itemText"
                    >
                    </app-auto-complete>
                </v-flex> -->
                <v-flex xs12 sm6 >
                <v-text-field
                    label="Razón Social*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="Razón Social"
                ></v-text-field>
                </v-flex>
<!-- 

                <v-flex xs12 >
                <v-text-field 
                    label="Dirección*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="Dirección"
                ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 >
                <v-text-field 
                    label="Nombre Banco*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="Nombre Banco"
                ></v-text-field>
                </v-flex>
            
                <v-flex xs12 sm6 >
                <v-text-field 
                    label="N° Cuenta*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="N° Cuenta"
                ></v-text-field>
                </v-flex>

                <v-flex xs12>
                <v-text-field 
                    label="Dirección*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="Dirección"
                ></v-text-field>
                </v-flex>

                <v-flex xs12 sm4 >
                <v-text-field 
                    label="Ente Ejecutor*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="Ente Ejecutor"
                ></v-text-field>
                </v-flex>
            
                <v-flex xs12 sm4 >
                <v-text-field 
                    label="Proyecto General*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="Proyecto General"
                ></v-text-field>
                </v-flex>
            
                <v-flex xs12 sm4 >
                <v-text-field 
                    label="Proyecto Especifico*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="Proyecto Específico"
                ></v-text-field>
                </v-flex>
            
                <v-flex xs12>
                <v-text-field 
                    label="Concepto Desembolso*" 
                    v-model="form.nu_subasta"  
                    :rules="rules.required"
                    v required hint="Concepto Desembolso"
                ></v-text-field>
                </v-flex> -->

            </template>
        </app-form>
    </v-form>
</template>
<script>
  import formMixin from "~/mixins/Appform"

  export default {
    mixins:[formMixin],
    data() 
    {
        return{
            resource: 'subasta',
            label:"R.I.F",
            searchUrl:"cliente",
            hint:"R.I.F",
            itemText:"",
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
<style>
/* .v-text-field label {
    font-size: 12px;
    font-weight:bold;
  }
  .v-text-field {
   padding-top: 0px;
   margin-top: 0px;
  }
  .v-stepper__content{
      padding: 0px 0px 0px;
      background-color: #f5f5f5;
  }
  .v-divider{
     background-color: red  ;
     border-top-width: 3px;
  }
  .v-stepper__label {
  color: red !important;
    }
  .v-stepper__step__step.primary{
    background-color: red !important;
  } */
 
  /* span{
    background-color: red !important;
  } */
</style>