<template>
<div class="text-xs-center">
    <v-dialog
        v-model="showDialog"
        width="500"
    >
    <template v-slot:activator="{ on }">
        <v-btn icon v-on="on">
            <v-icon >account_circle</v-icon>
        </v-btn>
    </template>

    <v-card>
        <v-card-title
            class="headline grey lighten-2"
            primary-title
        >
            {{user.nb_completo}}
        </v-card-title>

        <v-list two-line subheader>
            <v-subheader inset>{{user.nb_usuario}}</v-subheader>
            <v-list-item>
                <v-list-item-avatar>
                    <v-icon :class="[iconClass]">mail</v-icon>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>E-mail</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ user.tx_email }}
                    </v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-action>
                <v-btn icon ripple>
                    <v-icon color="grey lighten-1">info</v-icon>
                </v-btn>
                </v-list-item-action>
            </v-list-item>

            <v-list-item>
                <v-list-item-avatar>
                <v-icon :class="[iconClass]">phone</v-icon>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>Ext:</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ user.tx_telefono }}
                    </v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-action>
                    <v-btn icon ripple>
                        <v-icon color="grey lighten-1">info</v-icon>
                    </v-btn>
                </v-list-item-action>
            </v-list-item>
            
        </v-list>

        <!-- <v-card-text>
        <pre>{{user}}</pre>
        </v-card-text> -->

        <v-divider></v-divider>

        <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
            color="primary"
            text
            @click="showDialog = false"
        >
            Cerrar
        </v-btn>
        </v-card-actions>
    </v-card>
    </v-dialog>
</div>
</template>

<script>
    export default {
        data () {
            return {
                showDialog: false,
                iconClass:'grey lighten-1 white--text'
            }
        },
        computed:{
            user(){
                return {};//this.$store.getters.getUser
            }
        }
    }
</script>