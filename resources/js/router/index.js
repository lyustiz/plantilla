import Vue    from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import Home       from '../pages/home/index.vue'
import Crud  from '../pages/crud/crud.vue'
//dinamicImport



//newImport


export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
        path: '/',
        name: 'home',
        icon: 'bubble_chart',
        component: Home,
    },
    {
        path: '/banco',
        name: 'banco',
        icon: 'bubble_chart',
        component: Banco,
        children:
        [
            {
                path: 'form',
                name: 'bancoForm',
                component: BancoForm
            }
        ]
    },
    {
      path: '/crud',
      name: 'crud',
      icon: 'bubble_chart',
      component: Crud,
  },
//dinamicRoutes

//newRoutes
  ]
})


