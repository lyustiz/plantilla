export default {
    created(){
        this.BANDES_BCV_COD = document.head.querySelector('meta[name="BANDES_BCV_COD"]').content
        this.WEB_SERVICE = document.head.querySelector('meta[name="WEB_SERVICE"]').content
        this.WS_DICOM_TOKEN = document.head.querySelector('meta[name="WS_DICOM_TOKEN"]').content
        this.WS_DICOM_1 = document.head.querySelector('meta[name="WS_DICOM_1"]').content
        this.WS_DICOM_2 = document.head.querySelector('meta[name="WS_DICOM_2"]').content
        this.WS_DICOM_3 = document.head.querySelector('meta[name="WS_DICOM_3"]').content
        this.WS_DICOM_4 = document.head.querySelector('meta[name="WS_DICOM_4"]').content
        this.WS_DICOM_5 = document.head.querySelector('meta[name="WS_DICOM_5"]').content
        this.WS_DICOM_USER = document.head.querySelector('meta[name="WS_DICOM_USER"]').content
        this.WS_DICOM_PASS = document.head.querySelector('meta[name="WS_DICOM_PASS"]').content
    },
    data() {
        return {
            baseUrl: this.$App.baseUrl,
            BANDES_BCV_COD: null,
            WEB_SERVICE: null,
            WS_DICOM_TOKEN: null,
            WS_DICOM_1: null,
            WS_DICOM_2: null,
            WS_DICOM_3: null,
            WS_DICOM_4: null,
            WS_DICOM_5: null,
            WS_DICOM_USER: null,
            WS_DICOM_PASS: null,
        }
    },
    methods: {
        handleFiles(item,currencies,fileNum){
            // token
            if(this.loading == false){
                if(currencies.length > 0 ){
                    this.loading = true
                    let url = `${this.WEB_SERVICE}${this.WS_DICOM_TOKEN}`
                    let data = {}
                    let config = {
                        auth: {
                            username: this.WS_DICOM_USER,
                            password: this.WS_DICOM_PASS
                        },
                    }
    
                    axios.post(url,data,config)
                    .then(resp => {
                        
                        let statusResponse = resp.data.respuesta.estatus
                        if(statusResponse == '200'){
                            let token = resp.data.respuesta.detalle
                            this.webService(item,currencies,fileNum,token)
                        }else{
                            this.mostrarBarraMsj(
                                'Error: Token no encontrado', 
                                'error'
                            )
                        }
    
                    }).catch(error =>
                    {
                        this.verError(error);
                    }) 
                }else{
                    this.checkFiles(item,fileNum)
                }
            }

        },
        webService(item,currencies,fileNum,token){            
            let requests = []
            for (var i in currencies) {
                let co_bcv = currencies[i];
                let url = `${this.WEB_SERVICE}`
                let config = {
                    headers: {
                        "X-Auth-Token": token,
                    }
                }
                let data = {}
                
                if(fileNum == 1 || fileNum == 3 || fileNum == 4){
                    
                    if(fileNum == 1){
                        url += `${this.WS_DICOM_1}`
                    }else if (fileNum == 3){
                        url += `${this.WS_DICOM_2}`
                    }else if(fileNum == 4){
                        url += `${this.WS_DICOM_4}`
                    }
                    data['cosubasta'] =  item.co_subasta
                    data['comoneda'] =  co_bcv

                }else if(fileNum == 2 || fileNum == 5){
                    if(fileNum == 2){
                        url += `${this.WS_DICOM_2}`
                    }else if (fileNum == 5){
                        url += `${this.WS_DICOM_5}`
                    }

                    let archivo = `${item.co_subasta}_${fileNum}`
                    archivo += `_${this.BANDES_BCV_COD}_${co_bcv}.txt`

                    data['cosubasta'] =  item.co_subasta
                    data['comoneda'] =  co_bcv
                    data['archivo'] =  archivo
                }

                requests.push(
                    axios.post(url,data,config)
                ); 
            }

            axios.all(requests).then(
                axios.spread( (...response) => 
                {
                   let status = response.map(
                        x => {
                            if(x.data.respuesta.estatus == '200'){
                                return true
                            }else{
                                return false
                            }
                        }
                    )
                    // console.log(status)
                    // console.log(status.includes(false))
                    this.loading = false
                    if(status.includes(false)){

                        this.mostrarBarraMsj(
                            'Error Archivo no encontrado', 
                            'error'
                        )
                    }else{
                        // this.verMensaje('Exito -> checkFiles')
                        if(fileNum == 1 || fileNum == 3 || fileNum == 4){
                            this.checkFiles(item,fileNum)
                        }
                    }


                })
            )
            .catch(error =>{
                this.verError(error);
            });

        },
        checkFiles(item,fileNum){
                // this.verMensaje('Exito -> checkFiles')
                let url = `/comprobacion/${item.id_subasta}`
                url += `/${item.co_subasta}/${fileNum}`
                url += `/${this.$store.getters.getUser.id_usuario}`
                this.$router.push(url)
        },
        generateFile(item,currencies,fileNum){
            this.loading = false;
            let subasta = this.$route.params.subasta 
            let cod = this.$route.params.cod

            let url = `${this.$App.baseUrl}file/write`
            url += `/${subasta}/${cod}/${fileNum}`
            axios.get(url) 
            .then(respuesta => {
                
                if(respuesta.data.writed){
                    this.validResponse(respuesta)
                    this.handleFiles(item,currencies,fileNum)
                    this.$router.push('/subasta')
                }else{
                    alert(respuesta.data.msj)
                }
            }).catch(error =>
            {
                this.verError(error);
            })
        },
        filters(value,key){
            if(key == 'id_moneda'){

                let currency = this.selects.moneda.items
                for(var key in currency){
                    if(currency[key].co_bcv == value){
                        return currency[key].nb_moneda
                    }
                }
                return value

            }else if(key == 'tx_rif'){

                let client = this.selects.cliente.items
                for(var key in client){
                    if(client[key].tx_rif == value){
                        return `R.I.F: ${value} \n Cliente: ${client[key].nb_cliente}`
                    }
                }
                return `R.I.F: ${value}`

            }else if(key == 'id_operacion'){
                let oper = this.selects.operacion.items
                for(var key in oper){
                    if(oper[key].id_operacion == value){
                        return oper[key].nb_operacion
                    }
                }
                return value

            }else if(key == 'id_banco'){
                let banks = this.selects.banco.items
                for(var key in banks){
                    if(banks[key].co_banco == value){
                        return banks[key].nb_banco
                    }
                }
                return value

            }else if(key.includes('fe_')){
                
                return value.replace(/-/g,'/')

            }else if(key.includes('nu_') && key!='nu_solicitud'){
                value = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "#")
                value = value.replace('.',',') 
                return value.replace(/#/g,'.')

            }else{
                return value
            }
        },
        getReport(item){
            let url = this.$App.baseUrl + 'reporte/dicom'
            location.replace(`${url}/${item.id_subasta}`)
        }
    }

}
