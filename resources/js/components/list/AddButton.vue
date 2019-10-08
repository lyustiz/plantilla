<template>

    <v-tooltip bottom>
        <v-btn slot="activator" fab dark small color="success" @click="insItem()" >
            <v-icon>add</v-icon>
        </v-btn>
        <span>{{ mensaje }}</span>
    </v-tooltip>

</template>

<script>
export default {
    props:
    {
        mensaje: {
            type:     String,
            default:  'Nuevo Item'
        }
    },
    methods:
    {
        insItem()
        {
            this.$emit('insItem')
        }
    }
}
</script>

<style>
</style>
