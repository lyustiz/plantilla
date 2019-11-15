<template>
    <v-data-table
    :headers="headers"
    :items="details"
    :expand="expand"
    :item-key="filds[0]"
    dark
    >
        <template v-slot:items="props">
            <tr @click="props.expanded = !props.expanded">
                <td class="text-xs-center" v-for="key in filds" :key="key">
                    {{ filters(props.item[key],key) }}
                </td>
            </tr>
        </template>
    </v-data-table>
</template>

<script>
    import selectMixin from '~/mixins/AppSelect' 
    import dicomMixin from '~/pages/Dicom/Mixins/dicom'

    export default {
        mixins:[selectMixin,dicomMixin],
        props: [
            'details',
            'headers',
            'filds',
        ],
        data(){
            return {
                expand: false,
                selects:
                {
                    cliente: {group:'/grupo/dicom',items:[]},
                    banco: {group:'/grupo/dicom',items:[]},
                    operacion: {group:'/grupo/dicom',items:[]},
                },
            }
        },
    }
</script>

<style>

</style>
