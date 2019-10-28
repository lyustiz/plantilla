<template>

 <form-container :titulo="titulo" :head-color="$App.theme.headForm">

        <v-form ref="form" v-model="valido" lazy-validation>

            <v-layout wrap>

                <v-flex xs12>
                    <v-select
                        label="Schema"
                        v-model="form.schema"
                        :items="listas.schemas"
                        :rules="rules.requerido"
                        @change="getTables()"
                    ></v-select>
                </v-flex>

                <v-flex xs8>

                <v-list dense>
                    <v-list-group
                        v-for="(table, nbTable) in form.tables" :key="nbTable"
                        :v-model="false"
                        prepend-icon="grid_on"
                        dense
                    >

                        <template v-slot:activator>                        
                            <v-list-item-content>
                                <v-list-item-title v-text="nbTable"></v-list-item-title>
                            </v-list-item-content>
                        </template>

                        <v-list-item dense v-for="(column, nbColumn) in table.columns"  :key="nbColumn" >

                            <v-list-item-content>
                                <v-list-item-title>
                                    <v-chip class="mx-2" label small>  {{nbColumn}} </v-chip>
                                    <v-chip small><v-icon left color="info">looks_one</v-icon>{{ column.type }}</v-chip>
                                    <v-chip small><v-icon left color="info">link_off</v-icon>{{ !column.notnull }}</v-chip>
                                    <v-chip small><v-icon left color="info">straighten</v-icon>{{ column.length }}</v-chip>
                                    <v-chip small><v-icon left color="info">settings_ethernet</v-icon>{{ column.precision }}</v-chip>
                                    <v-chip small><v-icon left color="info">speaker_notes</v-icon>{{ column.comment }}</v-chip>
                                     <v-chip small v-if="table.primaryKey == nbColumn"><v-icon left color="red">vpn_key</v-icon>Primary Key</v-chip>
                                </v-list-item-title>
                            </v-list-item-content>

                        </v-list-item>

                    </v-list-group>
                </v-list>
                </v-flex>
            </v-layout>

     </v-form>

    <template slot="buttons">
        <form-buttons
            @store ="generate()"
            @clear ="clear()"
            @cancel="cancel()"
            :btnAccion="false"
            :valido="valido"
        ></form-buttons>

    </template>

    </form-container>


</template>

<script>

import listHelper from '~/mixins/Applist';
import formHelper from '~/mixins/Appform';
import AppRules from '~/mixins/AppRules';
 export default {
  mixins: [formHelper],
   created()
    {
        this.listasLoader()

    },
    data () {
        return {
            tabla: 'pago',
            form:{
                schema:  '',
                tables:  '',  
            },
            listas:{
                schemas: [],
            },
        }
    },
    methods: {
        listasLoader()
        {
            axios.get('api/v1/' + 'crud/' + 'schemas')
                    .then(respuesta => {
                        this.listas.schemas = respuesta.data.schemas;
                    })
                    .catch(error => {
                        this.showError(error);
                    })

                    console.log(this.valido)
        },

        getTables()
        {
            axios.post('api/v1/' + 'crud/' + 'tables', this.form)
            .then(respuesta => {
                this.form.tables = respuesta.data;
                this.IsLoading = false
            })
            .catch(error => {
                this.showError(error)
                this.IsLoading = false
            })
        },
        generate()
        {
            if (this.$refs.form.validate()) 
            {
                axios.post('api/v1/' + 'crud/' + 'generate',this.form)
                .then(respuesta => {

                    console.log(respuesta.data);

                    this.IsLoading = false
                })
                .catch(error => {
                    this.showError(error)
                    this.IsLoading = false
                })
            }
        }
    },
    
 }
</script>
<style scope>

</style>
