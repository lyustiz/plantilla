<template>
  <v-app>

    <!--AppBar-->
    <v-app-bar
        app
        :color="$App.theme.headPpal"
        clipped-left
      dark
    >
        <!--Titulo-->
        <v-toolbar-title :class="$App.theme.textPpal" v-text="$App.title"></v-toolbar-title>

        <!--Toggle Menu Lateral-->
        <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

        <!--Toggle iconos/texto-->
        <v-btn icon @click.stop="miniVariant = !miniVariant">
            <v-icon v-html="miniVariant ? 'chevron_right' : 'chevron_left'"></v-icon>
        </v-btn>

        <div class="flex-grow-1"></div>

        <!--Ayuda-->
        <v-btn icon >
            <v-icon>help</v-icon>
        </v-btn>

        <!--Notificaciones-->
        <v-btn icon >
            <v-icon>notification_important</v-icon>
        </v-btn>

        <!--Form User Logot/Password-->
        <v-form @submit.prevent="logout()">
            <v-btn icon type="submit">
                <v-icon>exit_to_app</v-icon>
            </v-btn>
        </v-form>

    </v-app-bar>

    <!--navegacion lateral-->
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      clipped
      fixed
      app
    >
        <!--menu-->
        <layout-menu :items=items></layout-menu>

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
        <span>AppInnovaSystem</span>
    </v-footer>

  </v-app>

</template>

<script>
  import LayoutMenu from  '~/components/app/AppMenu';

  export default {
      components: { 'layout-menu': LayoutMenu },
     data () {
        return {
            clipped: false,
            drawer: false,
            fixed: false,
            items: [
                { icon: 'insert_chart', title: 'Inicio', to: '/' },
                { icon: 'account_balance', title: 'Banco', to: '/banco' },
                { icon: 'assignment', title: 'Oferta Comercial', to: '/ofertaComercial' }
            ],
            miniVariant: false,
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

    /* Ajuste Icons */
    .v-icon {
        //display: inherit !important;
    }

    /* Transicion Contenido */
    .fade-enter-active, .fade-leave-active {
        transition:  opacity 0.4s ease;
    }

    .fade-enter, .fade-leave-active {
        opacity: 0
    }

</style>
