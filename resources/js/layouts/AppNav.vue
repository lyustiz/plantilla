<template>
    <v-navigation-drawer
        :mini-variant.sync="localminiVariant"
        :clipped="localclipped"
        v-model="localdrawer"
        fixed
        app
        class="blue-grey lighten-5"
    >
    <v-list>


        <v-list-group
            prepend-icon="more_vert"
            v-for="(paths,i) in menuLdap"
            :key="i"
        >
            <v-list-tile slot="activator">
            <v-list-tile-title>{{ capitalize(i) }}</v-list-tile-title>
            </v-list-tile>

            <v-list>
                <v-list-tile
                v-for="(path,i) in paths"
                :key="i"
                >
                    <v-flex xs6 class="px-5">
                        <v-btn 
                        round small outline color="red" 
                        @click="$router.push(path)"
                        >
                            <v-icon left>navigate_next</v-icon>
                            {{actionName(path)}}
                        </v-btn>
                    </v-flex>

                </v-list-tile>
            </v-list>
        </v-list-group>
    </v-list>
    </v-navigation-drawer>
</template>
<script>
    import formatData from '~/mixins/formatData'
    import messageMixin from '~/mixins/message'

    export default {
        mixins:[formatData,messageMixin],
        props: ['clipped','drawer','miniVariant'],
        created (){
            let auth = `Bearer ${localStorage.getItem("auth")}`
            window.axios.defaults.headers.common['Authorization']= auth

            let url = `api/ldap/${this.$store.getters.getUser.nb_usuario}`
            axios.get(url).then( response => {
                if(response.status==200)
                {
                    this.menuLdap=response.data
                }
            })
            .catch(error => {
                this.mostrarBarraMsj( 
                    'Fallo a obtener los permisos del Usuario', 
                    'error'
                )
                this.logout()
            })
        },  
        data(){
            return {
                menuLdap:   [],
                localclipped:this.clipped,
                localdrawer:this.drawer,
                localminiVariant:this.miniVariant
            }
        },
        watch:{
            clipped: function() { 
                return this.localclipped = this.clipped
            },
            drawer: function() { 
                return this.localdrawer = this.drawer
            },
            miniVariant: function() { 
                return this.localminiVariant = this.miniVariant
            },
        },
        methods:{
            actionName(value){
                let elements = value.split('/')
                return this.capitalize(elements[elements.length-1])
            },
            logout()
            {
                console.log(localStorage, 'local');
                axios.post('logout')
                .then(respuesta =>{
                    console.log(respuesta);
                    if (respuesta.status==302){
                        localStorage.clear();
                        window.location = '/'
                    }
                })
                .catch(error =>{
                    this.test=error
                })
            }
        },
    }
</script>
