import Comprobacion from '~/pages/Dicom/Comprobacion/ComprobaList.vue'
import Subasta from '~/pages/Dicom/Subasta/SubastaList.vue'
import Solicitud from '~/pages/Dicom/Solicitud/SolicitudList.vue'

export default [
    {
    path: '/subasta',
    name: 'subasta',
    icon: 'bubble_chart',
    component: Subasta,
    
    },   
    {
    path: '/comprobacion/:subasta/:cod/:num/:user',
    name: 'comprobacion',
    icon: 'bubble_chart',
    component: Comprobacion,
    },
    {
    path: '/solicitud/:subasta/:cod',
    name: 'solicitud',
    icon: 'bubble_chart',
    component: Solicitud,
    },
]