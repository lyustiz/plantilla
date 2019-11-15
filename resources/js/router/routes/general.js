import Banco from '~/pages/General/Banco/BancoList.vue'
import Cliente from '~/pages/General/Cliente/ClienteList.vue'
import Moneda from '~/pages/General/Moneda/MonedaList.vue'

export default [
    {
        path: '/banco',
        name: 'banco',
        icon: 'bubble_chart',
        component: Banco,
      
    },
    {
    path: '/cliente',
    name: 'cliente',
    icon: 'bubble_chart',
    component: Cliente,
    
    },
    {
    path: '/moneda',
    name: 'moneda',
    icon: 'bubble_chart',
    component: Moneda,
    
    },
]