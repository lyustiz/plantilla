<template>
  <v-app>

    <!-- App Toolbar -->
    <app-toolbar
        :drawer="drawer"
        :miniVariant="miniVariant"
        v-on:changeDrawer="drawer = !drawer"
        v-on:changeMiniVariant="miniVariant = !miniVariant"
    ></app-toolbar>

    <!--Navegacion lateral-->
    <v-navigation-drawer
        v-model="drawer"
        :mini-variant="miniVariant"
        clipped
        fixed
        app
        class="blue-grey lighten-5"
    >
        <!--menu-->
        <app-menu :items=items></app-menu>

    </v-navigation-drawer>

    <!--Contenido-->
    <v-content>
        <v-container>
            <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>

        </v-container>
    </v-content>

    <!--Footer-->
    <v-footer :fixed="fixed" app>
        <span>&copy; {{$App.title}}  {{ new Date().getFullYear() }}</span>
        <v-spacer></v-spacer>
        <span>GETI</span>
    </v-footer>

    <!--Mensaje Snack Bar-->
    <app-message></app-message>

  </v-app>

</template>

<script>

  import AppMenu from  '~/components/app/AppMenu';
  import AppToolbar from '~/layouts/AppToolbar'

export default 
{
    components: { 
        'app-menu': AppMenu,
        'app-toolbar': AppToolbar, 
    },
    created()
    {
        
        let auth = localStorage.getItem('auth');
        let user = localStorage.getItem('user');
        
        if(auth)
        {
            this.$store.commit('setAuth', auth)
            this.$store.commit('setUser', JSON.parse(user))
        }
    },
    mounted()
	{
	    this.$router.options.routes.forEach(function(item, index) 
		{
			this.items.push
			({ 
				icon: 	item.icon, 
				title: 	item.name, 
				to: 	item.path 
			});
			
		}, this);
    },
    data () 
	{
        return {
            clipped: false,
            drawer: true,
            fixed: false,
            items: [],
            miniVariant: true,
        }
    },
    computed:
    {
        menuItems()
        {
            return 1//this.$router.options.routes
        }
    }
  }

</script>
<style>

    /* Item Activo del Menu */
    .v-list__tile--active{
        color:#f44336 !important;
    }

    /* Transicion Contenido */
    .fade-enter-active, .fade-leave-active {
        transition:  opacity 0.4s ease;
    }

    .fade-enter, .fade-leave-active {
        opacity: 0
    }
	
    .v-btn--floating {
        padding: 10px !important;
    }
    .v-btn--floating .v-btn__content {
        flex: 1 0 auto;
    }

</style>
