<template>

<v-dialog v-model="modal" persistent >
    <v-card>

        <v-toolbar dark :color="HeadColor">

            <v-btn icon dark @click.native="modalClose()">
                <v-icon>close</v-icon>
            </v-btn>

            <v-toolbar-title>
                {{ nbAction }}
            </v-toolbar-title>

        </v-toolbar>

        <v-card-text>

              <slot></slot>

        </v-card-text>

    </v-card>

</v-dialog>


</template>

<script>
export default {
    name: 'form-container',
    methods:{
        modalClose()
        {
            this.$emit('modalClose');
        },
    },
    props:
    {
        nbAction:{
            type:       String,
            default:    ''
        },
        modal:{
            type:       Boolean,
            default:    true
        },
        HeadColor:{
            type:       String,
            default:    'blue darken-3'
        },
        TextColor:{
            type:       String,
            default:    'white--text'
        },
    }
}
</script>

<style>
</style>
