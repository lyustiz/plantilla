<template>

    <v-app-bar
        app
        :color="$App.theme.headApp"
        clipped-left
        dark
    >
        <!--Titulo-->
        <v-toolbar-title>
            <v-btn 
                text 
                class="sansserif" 
                :color="$App.theme.textTitle" 
                v-text="$App.title" 
                @click="$router.push('/')">
            </v-btn>
        </v-toolbar-title>

        <!--Toggle iconos/texto-->
        <v-btn icon @click.stop="$emit('changeMiniVariant')">
            <v-icon v-html="miniVariant ? 'chevron_left' : 'chevron_right'"></v-icon>
        </v-btn>
        
        <!--Toggle Menu Lateral-->
        <v-app-bar-nav-icon @click="$emit('changeDrawer')"></v-app-bar-nav-icon>

        <div class="flex-grow-1"></div>

        <!--Usuario-->
        <app-user></app-user>
       
        <!--Ayuda-->
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon>help</v-icon>
                </v-btn>
            </template>
            <span>Ayuda</span>
        </v-tooltip>

        <!--Notificaciones--> 
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon>notification_important</v-icon>
                </v-btn>
            </template>
            <span>Notificaciones</span>
        </v-tooltip>

        <!-- User Logout -->
        <v-form @submit.prevent="logout()">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn icon type="submit" :loading="loading" v-on="on">
                        <v-icon>exit_to_app</v-icon>
                    </v-btn>
                </template>
                <span>Salir del Sistema</span>
            </v-tooltip>
        </v-form>

    </v-app-bar>

</template>
<script>
    import AppUser    from '~/layouts/AppUser'
    import AppFormat  from '~/mixins/AppFormat'
    import AppMessage from '~/mixins/AppMessage'

    export default {
        components:{ 
            'app-user': AppUser,
        },
        mixins:[AppFormat, AppMessage],
        props: ['drawer','miniVariant'],
        data(){
            return {
                loading : false
            }
        },
        methods:{
            logout()
            {
                this.loading = true;

                axios.post('logout')
                .then(response =>{
                    localStorage.clear()
                    window.location.href = response.request.responseURL;
                })
                .catch(error =>{
                    console.log('error', error)
                })
            }
        }
    }
</script>
<style>
    .serif {
        font-family: "Times New Roman", Times, serif;
    }
    .sansserif {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1.1em !important; 
        font-weight: bold;
    }
</style>