import Vue    from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import Home       from '../pages/home/index.vue'
import Banco      from '../pages/banco/banco.vue'
import BancoForm  from '../pages/banco/form.vue'
import Crud  from '../pages/crud/crud.vue'
//dinamicImport


import Status  from '../pages/status/status.vue';
import StatusForm  from '../pages/status/statusForm.vue';
import Motivo  from '../pages/motivo/motivo.vue';
import MotivoForm  from '../pages/motivo/motivoForm.vue';
import Bitacora  from '../pages/bitacora/bitacora.vue';
import BitacoraForm  from '../pages/bitacora/bitacoraForm.vue';
import Empresa  from '../pages/empresa/empresa.vue';
import EmpresaForm  from '../pages/empresa/empresaForm.vue';
import TipoVisitante  from '../pages/tipoVisitante/tipoVisitante.vue';
import TipoVisitanteForm  from '../pages/tipoVisitante/tipoVisitanteForm.vue';
import Visitante  from '../pages/visitante/visitante.vue';
import VisitanteForm  from '../pages/visitante/visitanteForm.vue';
import Visita  from '../pages/visita/visita.vue';
import VisitaForm  from '../pages/visita/visitaForm.vue';
import TipoAlerta  from '../pages/tipoAlerta/tipoAlerta.vue';
import TipoAlertaForm  from '../pages/tipoAlerta/tipoAlertaForm.vue';
import Usuario  from '../pages/usuario/usuario.vue';
import UsuarioForm  from '../pages/usuario/usuarioForm.vue';
import VisitanteAlerta  from '../pages/visitanteAlerta/visitanteAlerta.vue';
import VisitanteAlertaForm  from '../pages/visitanteAlerta/visitanteAlertaForm.vue';
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

{
    path: '/status',
    name: 'status',
    icon: 'bubble_chart',
    component: Status,
    children:
    [
        {
            path: 'form',
            name: 'statusForm',
            component: StatusForm
        }
    ]
},
{
    path: '/motivo',
    name: 'motivo',
    icon: 'bubble_chart',
    component: Motivo,
    children:
    [
        {
            path: 'form',
            name: 'motivoForm',
            component: MotivoForm
        }
    ]
},
{
    path: '/bitacora',
    name: 'bitacora',
    icon: 'bubble_chart',
    component: Bitacora,
    children:
    [
        {
            path: 'form',
            name: 'bitacoraForm',
            component: BitacoraForm
        }
    ]
},
{
    path: '/empresa',
    name: 'empresa',
    icon: 'bubble_chart',
    component: Empresa,
    children:
    [
        {
            path: 'form',
            name: 'empresaForm',
            component: EmpresaForm
        }
    ]
},
{
    path: '/tipoVisitante',
    name: 'tipoVisitante',
    icon: 'bubble_chart',
    component: TipoVisitante,
    children:
    [
        {
            path: 'form',
            name: 'tipoVisitanteForm',
            component: TipoVisitanteForm
        }
    ]
},
{
    path: '/visitante',
    name: 'visitante',
    icon: 'bubble_chart',
    component: Visitante,
    children:
    [
        {
            path: 'form',
            name: 'visitanteForm',
            component: VisitanteForm
        }
    ]
},
{
    path: '/visita',
    name: 'visita',
    icon: 'bubble_chart',
    component: Visita,
    children:
    [
        {
            path: 'form',
            name: 'visitaForm',
            component: VisitaForm
        }
    ]
},
{
    path: '/tipoAlerta',
    name: 'tipoAlerta',
    icon: 'bubble_chart',
    component: TipoAlerta,
    children:
    [
        {
            path: 'form',
            name: 'tipoAlertaForm',
            component: TipoAlertaForm
        }
    ]
},
{
    path: '/usuario',
    name: 'usuario',
    icon: 'bubble_chart',
    component: Usuario,
    children:
    [
        {
            path: 'form',
            name: 'usuarioForm',
            component: UsuarioForm
        }
    ]
},
{
    path: '/visitanteAlerta',
    name: 'visitanteAlerta',
    icon: 'bubble_chart',
    component: VisitanteAlerta,
    children:
    [
        {
            path: 'form',
            name: 'visitanteAlertaForm',
            component: VisitanteAlertaForm
        }
    ]
},
//newRoutes
  ]
})


