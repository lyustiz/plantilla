<template>
<div >    
    <v-toolbar flat color="white">
    <v-toolbar-title>{{ title }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn color="primary" dark @click="storeFiles()">
        Guardar
    </v-btn>
    </v-toolbar>
    <v-data-table
    :headers="items.headers"
    :items="items.files"
    :expand="expand"
    item-key="fileNameCurrencyCode"    
    >
    <template v-slot:items="props">
        <tr @click="props.expanded = !props.expanded">
            <td class="text-xs-center" v-for="key in filds" :key="key">
                {{ filters(props.item[key],key) }}
            </td>
        </tr>
    </template>
    <template v-slot:expand="props">
        <v-card flat>
        <v-card-text>
                <comprob-det 
                    :details="props.item.lines"
                    :headers="items.headersListDet"
                    :filds="fildsListDet"
                ></comprob-det>
        </v-card-text>
        </v-card>
    </template>
    </v-data-table>
</div>
</template>

<script>
    import ComprobaListDet from './ComprobaListDet'
    import listMixin from '~/mixins/Applist'
    import selectMixin from '~/mixins/AppSelect'
    import dicomMixin from '~/pages/Dicom/Mixins/dicom'

    export default {
        mixins:[listMixin,selectMixin,dicomMixin],
        components:{ 'comprob-det': ComprobaListDet},
        computed:
        {
            title(){
                let fileNum = this.$route.params.num
                if(fileNum == '1'){
                    return 'Carga Respuesta de Comprobación'
                }else if(fileNum == '3'){
                    return 'Transferencias Interbancarias'
                }else if(fileNum == '4'){
                    return 'Ordenación de desbloqueos, créditos y débitos de la banca'
                }else{
                    return 'ERROR'
                }
            },
            fileReaderUrl(){
                let subasta = this.$route.params.subasta 
                let cod = this.$route.params.cod
                let num = this.$route.params.num
                let user = this.$route.params.user
                return `/${subasta}/${cod}/${num}/${user}`
            },
            fullUrl()
            {
                return `${this.$App.baseUrl}${this.resource}${this.fileReaderUrl}`
            },
            filds(){
                return this.items.headers.map(
                    (value,index) => this.items.headers[index].value
                )
            },
            fildsListDet(){
                return this.items.headersListDet.map(
                    (value,index) => this.items.headersListDet[index].value
                )
            },
            currencies(){
                return this.items.files.map(i=>i.id_moneda)
            }
        },
        data(){
            return {
                resource: 'file',
                expand: false,
                selects:
                {
                    moneda: {group:'/grupo/dicom',items:[]},
                },
                co_subasta:{co_subasta:this.$route.params.cod}
            }
        },
        methods:{
            storeFiles(){
                let storeUrl = `${this.$App.baseUrl}${this.resource}`
                storeUrl += `/store${this.fileReaderUrl}`
                axios.get(storeUrl)
                    .then(respuesta => {
                        if(respuesta.data.stored == true){
                            this.validResponse(respuesta)

                            let fileNum = this.$route.params.num
                            let url = ''

                            if(fileNum == '1'){
                                let subasta = this.$route.params.subasta 
                                let cod = this.$route.params.cod
                                url = `/solicitud/${subasta}/${cod}`
                            }else if(fileNum == '3'){
                                let subasta = this.$route.params.subasta 
                                let cod = this.$route.params.cod
                                //no renderiza el componente para el archivo 4
                                // url = `/comprobacion/${subasta}/${cod}/4`
                                url = `/subasta`
                            }else if(fileNum == '4'){
                                this.generateFile(this.co_subasta,this.currencies,5)
                            }else{
                                url = `/subasta`
                            }
                            this.$router.push(url)
                        }else{
                            alert(respuesta.data.msj)
                        }
                    })
                    .catch(error => {
                })
            },
        }
    }
</script>

<style>

</style>
