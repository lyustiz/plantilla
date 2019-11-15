<template>
<div>
    <!-- <pre>{{ currencies }}</pre> -->
    <v-toolbar flat color="white">
        <v-toolbar-title>Solicitudes</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn color="primary" dark @click="generateFile(co_subasta,currencies,2)">
            Generar Archivos
        </v-btn>
    </v-toolbar>

    <v-data-table
        :headers="headers"
        :items="solicitudes"
        :expand="expand"
        item-key="id_solicitud"
    >
        <template v-slot:items="props">
        <tr @click="props.expanded = !props.expanded">
            <!-- <td class="text-xs-center" >{{ props.item.id_subasta }}</td>
            <td class="text-xs-center">{{ props.item.fe_subasta }}</td>
            <td class="text-xs-center">{{ props.item.nu_div_demanda }}</td>
            <td class="text-xs-center">{{ props.item.nu_ofertas }}</td>
            <td class="text-xs-center">{{ props.item.nu_div_oferta }}</td>
            <td class="text-xs-center">{{ props.item.nu_bs_oferta }}</td>
            <td class="text-xs-center">{{ props.item.id_status }}</td> -->
            <td class="text-xs-center" >{{ props.item.nu_solicitud }}</td>
            <td class="text-xs-center">{{ props.item.tx_cta_bsf }}</td>
            <td class="text-xs-center">{{ props.item.tx_cta_div }}</td>
            <td class="text-xs-center">{{ filters(props.item.nu_monto_div,'nu_monto_div' ) }}</td>
            <td class="text-xs-center">{{ filters(props.item.id_moneda,'id_moneda') }}</td>
            <td class="text-xs-center">{{ filters(props.item.tx_rif,'tx_rif') }}</td>            

            <td class="text-xs-center">
                <v-select
                    label="Estado de Solicitud*"
                    v-model="props.item.id_status"
                    v-on:change="changeStatus( props.item.id_det_solicitud,props.item )"
                    :items="selects.status.items"
                    item-value="id_status"
                    item-text="nb_status"
                    required hint="Seleccione el estado de la solicitud"
                ></v-select>
            </td>
        </tr>
        </template>
        <!-- <template v-slot:expand="props">
        <v-card flat>
            <v-card-text>
                <solicitud-det 
                    :details="props.item.detalles_solicitud"
                ></solicitud-det>
            </v-card-text>
        </v-card>
        </template> -->
    </v-data-table>
</div>
</template>

<script>
    import SolicitudDet from './SolicitudDet'
    import listMixin from '~/mixins/Applist' 
    import selectMixin from '~/mixins/AppSelect'
    import dicomMixin from '~/pages/Dicom/Mixins/dicom'

export default {
    mixins:[listMixin,selectMixin,dicomMixin],
    components:{ 'solicitud-det': SolicitudDet},
    data(){
        return {
            resource: 'solicitudes',
            expand: true,
            headers: [
                // { text: 'Codigo Subasta',value: 'id_subasta' },
                // { text: 'Fecha Subasta', value: 'fe_subasta' },
                // { text: 'Divisas Demanda', value: 'nu_div_demanda' },
                // { text: 'Catidad Ofertas', value: 'nu_ofertas' },
                // { text: 'Divisas Ofertas', value: 'nu_div_oferta' },
                // { text: 'Bolivares Ofertas', value: 'nu_bs_oferta' },
                // { text: 'id_status', value: 'id_status' },
                // { text: 'select', value: 'id_status' },
                { text: 'N° Solicitud',value: 'nu_solicitud' },
                { text: 'Cuenta Bs', value: 'tx_cta_bsf' },
                { text: 'Cuenta Divisas', value: 'tx_cta_div' },
                { text: 'Monto Divisa', value: 'nu_monto_div' },
                { text: 'Moneda',value: 'id_moneda' },
                { text: 'Cliente', value: 'tx_rif' },
                { text: 'Estatus', value: 'id_status' },
            ],
            solicitudes:[],
            selects:
            {
                status: {group:'/grupo/solicitud',items:[]},
                moneda: {group:'/grupo/dicom',items:[]},
                cliente: {group:'/grupo/dicom',items:[]},
            },
            form:'',
            currencies:[],
            co_subasta:{co_subasta:this.$route.params.cod}
        }
    },
    computed:{

        fullUrl()
        {
            let fullUrl = this.$App.baseUrl + this.resource
            fullUrl += '/' + this.$route.params.subasta
            return fullUrl
        },
    },
    watch:{
        items(){
            let solicitudes = []
            let items = this.items

            for(var key in items){
                let currency = items[key].id_moneda
                this.currencies.push(currency)
                let details = [...items[key].detalles_solicitud]

                details.forEach(element => {
                    solicitudes.push({...element , ...{'id_moneda':currency} })
                })
            }
            this.solicitudes = solicitudes
        }
    },
    methods:{
        changeStatus(id_solicitud,data){
            delete data['id_moneda']
            this.loading = true;
            let url = `${this.$App.baseUrl}detsolicitud/${id_solicitud}`
            axios.put(url, data) 
            .then(respuesta => {
                this.validResponse(respuesta)
                this.loading = false
            }).catch(error =>
            {
                this.verError(error);
            })
        }
    }

}
</script>

<style>

</style>
