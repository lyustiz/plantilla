<template>
    <v-data-table
    :headers="headers"
    :items="details"
    :expand="expand"
    item-key="id_det_solicitud"
    dark
    >
        <template v-slot:items="props">
            <tr @click="props.expanded = !props.expanded">
            <td class="text-xs-center" >{{ props.item.nu_solicitud }}</td>
            <td class="text-xs-center">{{ props.item.tx_cta_bsf }}</td>
            <td class="text-xs-center">{{ props.item.tx_cta_div }}</td>
            <td class="text-xs-center">{{ props.item.nu_monto_div }}</td>
            <td class="text-xs-center">{{ props.item.tx_rif }}</td>
            <td class="text-xs-center">{{ props.item.id_status }}</td>
            </tr>
        </template>
    </v-data-table>
</template>

<script>
    import formMixin from "~/mixins/Appform" 

    export default {
        mixins:[formMixin],
        props: ['details'],
        data(){
            return {
                headers: [
                    { text: 'N° Solicitud',value: 'nu_solicitud' },
                    { text: 'Cuenta Bs', value: 'tx_cta_bsf' },
                    { text: 'Cuenta Divisas', value: 'tx_cta_div' },
                    { text: 'Monto Divisa', value: 'nu_monto_div' },
                    { text: 'Cliente', value: 'tx_rif' },
                    { text: 'id_status', value: 'id_status' },
                    { text: 'select', value: 'id_status' },
                ],
                selects:
                {
                    status: {group:'/grupo/general',items:[]},
                },
            }
        },
        methods:{

        }
    }
</script>

<style>

</style>
