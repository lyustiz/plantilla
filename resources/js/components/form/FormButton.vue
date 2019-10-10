<template>
<v-layout row wrap>

    <v-spacer></v-spacer>

    <div v-if="btnAccion=='upd'">

        <v-tooltip top>
            <template v-slot:activator="{ on }">
            <v-btn v-on="on" fab small @click="update" :disabled="!valido"  class="warning">
                <v-icon>edit</v-icon>
            </v-btn>
            </template>
            <span>Editar</span>
        </v-tooltip>

    </div>

    <div v-else>
        <v-tooltip top>
            <template v-slot:activator="{ on }">
            <v-btn v-on="on" fab small @click="store" :disabled="!valido"  class="success">
                <v-icon>save_alt</v-icon>
            </v-btn>
            </template>
            <span>Guardar</span>
        </v-tooltip>


        <v-tooltip top>
            <template v-slot:activator="{ on }">
            <v-btn  v-on="on" fab small @click="clear"  class="info">
                <v-icon>refresh</v-icon>
            </v-btn>
            </template>
            <span>Refrescar</span>
        </v-tooltip>
    </div>

    <v-tooltip top>
        <template v-slot:activator="{ on }">
        <v-btn v-on="on" fab small @click="cancel"  class="error">
            <v-icon>reply</v-icon>
        </v-btn>
        </template>
        <span>Cancelar</span>
    </v-tooltip>

</v-layout>
</template>

<script>
export default {
    props: ['btnAccion', 'valido'],
    methods:{

        update(){
           this.$emit('update');
        },
        store(){
            this.$emit('store');
        },
        clear(){
            this.$emit('clear');
        },
        cancel(){
            this.$emit('cancel');
        }
    }
}
</script>

<style>
</style>
