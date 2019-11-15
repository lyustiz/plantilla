export default {
    data() {
        return {
            items: [],
            baseUrl: this.$App.baseUrl,
            form: {}
        }
    },
    methods: {
        async storeData(form, resource) {
            if (this.$refs.form.validate()) {
                let url = `${this.$App.baseUrl}` + resource;
                this.loading = true;
                axios.post(url, form)
                    .then(respuesta => {
                        (respuesta.data.msj) ?
                        this.mostrarBarraMsj(respuesta.data.msj, 'success'):
                            this.mostrarBarraMsj(respuesta.data.err, 'error');

                    }).catch(error => {
                        this.verError(error);
                    })
            }
        },
        async updateData(form) {
            if (this.$refs.form.validate()) {
                this.loading = true;
                axios.put(this.fullUrlId, form)
                    .then(respuesta => {
                        (respuesta.data.msj) ?
                        this.mostrarBarraMsj(respuesta.data.msj, 'success'):
                            this.mostrarBarraMsj(respuesta.data.err, 'error');
                    }).catch(error => {
                        this.verError(error);
                    })
            }
        },
        async generateReport(formName, item) {

            if (formName && formName != "") {

                let url = `${this.$App.baseUrl}`;

                switch (formName) {
                    case 'recepcion':
                        item.item.titulo = 'ACTA DE RECEPCION DE ACTIVOS';
                        item.item.nombre = 'recepcion';
                        item.item.tx_tipo_detalle = 'recepcion';
                        url += "reporte/control_perceptivo/" + formName;
                        break;
                    case 'control':
                        item.item.titulo = 'CONTROL PERCEPTIVO';
                        item.item.nombre = 'control';
                        item.item.tx_tipo_detalle = 'control';
                        url += "reporte/control_perceptivo/" + formName;
                        break;
                    case 'asignacion':
                        item.item.titulo = 'ACTA DE ASIGNACION DE ACTIVOS';
                        item.item.nombre = 'asignacion';
                        item.item.tx_tipo_detalle = 'asignacion';
                        url += "reporte/control_perceptivo/" + formName;
                        break;
                }

                await axios
                    .post(
                        url, {
                            data: item
                        }
                    )
                    .then(respuesta => {
                        if (respuesta.status === 200 && respuesta.data) {
                            window.open("data:application/pdf;base64," + respuesta.data);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        this.mostrarBarraMsj("Error al generar PDF. Por favor intente nuevamente.", "error");
                    });

            } else {
                this.mostrarBarraMsj("Error al generar PDF. Por favor intente nuevamente.", "error");
            }

        },
        async getAddition(form) {
            let url = `${this.$App.baseUrl}`;

            if (form.co_factura && form.co_factura != "") {
                url += "addition_by_invoice_number/" + form.co_factura;

                await axios
                    .get(url)
                    .then(respuesta => {
                        if (respuesta.status === 200 && respuesta.data) {
                            if (!respuesta.data.adicion) {

                                this.mostrarBarraMsj("No se encontraron registros relacionados con la factura.", "error");

                                if (form.tx_tipo_detalle === 'recepcion') {
                                    let objActivos = [];
                                    this.recepcionForm.co_control_perceptivo = respuesta.data.co_control_perceptivo;
                                    this.recepcionForm.fe_formulario = respuesta.data.fe_formulario;
                                    for (let activo of respuesta.data.activos) {
                                        if (activo.tx_tipo_detalle == 'recepcion') {
                                            objActivos.push(activo);
                                        }
                                    }
                                    this.recepcionForm.activos = objActivos;
                                }
                                if (form.tx_tipo_detalle === 'control') {
                                    let objActivos = [];
                                    this.controlForm.co_control_perceptivo = respuesta.data.co_control_perceptivo;
                                    this.controlForm.fe_formulario = respuesta.data.fe_formulario;
                                    for (let activo of respuesta.data.activos) {
                                        if (activo.tx_tipo_detalle == 'control') {
                                            objActivos.push(activo);
                                        }
                                    }
                                    this.controlForm.activos = objActivos;
                                }
                                if (form.tx_tipo_detalle === 'asignacion') {
                                    let objActivos = [];
                                    this.asignacionForm.co_control_perceptivo = respuesta.data.co_control_perceptivo;
                                    this.asignacionForm.fe_formulario = respuesta.data.fe_formulario;
                                    for (let activo of respuesta.data.activos) {
                                        if (activo.tx_tipo_detalle == 'control') {
                                            objActivos.push(activo);
                                        }
                                    }
                                    this.asignacionForm.activos = objActivos;
                                }

                            } else {

                                let adicion = respuesta.data.adicion;
                                let activos = respuesta.data.activos;
                                let facturas = respuesta.data.facturas;


                                if (form.tx_tipo_detalle === 'recepcion') {

                                    for (let key in adicion) {
                                        if (this.recepcionForm.hasOwnProperty(key)) {

                                            this.recepcionForm[key] = adicion[key];

                                        } else if (key === 'nb_res_pat_pri') {
                                            this.recepcionForm.nb_responsable_patrimonial_primario = adicion[key];
                                        }

                                    }

                                    this.recepcionForm.nb_sede = "BANDES";
                                    this.recepcionForm.co_orden_compra = "N/A";
                                    this.recepcionForm.tx_garantia = "N/A";
                                    this.recepcionForm.co_nota_entrega = "N/A";
                                    this.recepcionForm.tx_observacion = "N/A";
                                    this.recepcionForm.tx_tipo_entrega = {
                                        text: "TOTAL",
                                        value: "TOTAL"
                                    };
                                    this.recepcionForm.tx_tipo_asignacion = {
                                        text: "MUEBLES",
                                        value: "MUEBLES"
                                    };
                                    this.recepcionForm.pc_iva = "16";
                                    this.recepcionForm.fe_formulario = respuesta.data.fe_formulario;
                                    this.recepcionForm.co_control_perceptivo =
                                        respuesta.data.co_control_perceptivo;
                                    this.recepcionForm.activos = activos;

                                    for (let factura of facturas) {
                                        if (factura.id_status == '1') {
                                            this.recepcionForm.co_factura = factura.co_factura;
                                        } else if (factura.id_status == '2') {

                                            let found = false;

                                            for (let recepcionFactura of this.recepcionForm.facturas) {
                                                if (recepcionFactura.co_factura === factura.co_factura) {
                                                    found = true;
                                                }
                                            }

                                            if (found !== true) {
                                                this.recepcionForm.facturas.push(factura);
                                            }
                                        }
                                    }

                                }

                                if (form.tx_tipo_detalle === 'control') {

                                    for (let key in adicion) {
                                        if (this.controlForm.hasOwnProperty(key)) {

                                            this.controlForm[key] = adicion[key];

                                        } else if (key === 'nb_res_pat_pri') {
                                            this.controlForm.nb_responsable_patrimonial_primario = adicion[key];
                                        }
                                    }

                                    this.controlForm.nb_sede = "BANDES";
                                    this.controlForm.co_orden_compra = "N/A";
                                    this.controlForm.tx_garantia = "N/A";
                                    this.controlForm.co_nota_entrega = "N/A";
                                    this.controlForm.tx_observacion = "N/A";
                                    this.controlForm.tx_tipo_entrega = {
                                        text: "TOTAL",
                                        value: "TOTAL"
                                    };
                                    this.controlForm.tx_tipo_asignacion = {
                                        text: "MUEBLES",
                                        value: "MUEBLES"
                                    };
                                    this.controlForm.nb_moneda = { nb_moneda: 'BOLIVAR' };
                                    this.controlForm.pc_iva = "16";
                                    this.controlForm.fe_formulario = respuesta.data.fe_formulario;
                                    this.controlForm.co_control_perceptivo =
                                        respuesta.data.co_control_perceptivo;
                                    this.controlForm.activos = activos;

                                    for (let factura of facturas) {
                                        if (factura.id_status == '1') {
                                            this.controlForm.co_factura = factura.co_factura;
                                        } else if (factura.id_status == '2') {

                                            let found = false;

                                            for (let controlFactura of this.controlForm.facturas) {
                                                if (controlFactura.co_factura === factura.co_factura) {
                                                    found = true;
                                                }
                                            }

                                            if (found !== true) {
                                                this.controlForm.facturas.push(factura);
                                            }
                                        }
                                    }

                                }
                                if (form.tx_tipo_detalle === 'asignacion') {

                                    for (let key in adicion) {
                                        if (this.asignacionForm.hasOwnProperty(key)) {

                                            this.asignacionForm[key] = adicion[key];

                                        } else if (key === 'nb_res_pat_pri') {
                                            this.asignacionForm.nb_responsable_patrimonial_primario = adicion[key];
                                        }
                                    }

                                    this.asignacionForm.nb_sede = "BANDES";
                                    this.asignacionForm.co_orden_compra = "N/A";
                                    this.asignacionForm.tx_garantia = "N/A";
                                    this.asignacionForm.co_nota_entrega = "N/A";
                                    this.asignacionForm.tx_observacion = "N/A";
                                    this.asignacionForm.tx_tipo_entrega = {
                                        text: "TOTAL",
                                        value: "TOTAL"
                                    };
                                    this.asignacionForm.tx_tipo_asignacion = {
                                        text: "MUEBLES",
                                        value: "MUEBLES"
                                    };
                                    this.asignacionForm.pc_iva = "16";
                                    this.asignacionForm.fe_formulario = respuesta.data.fe_formulario;
                                    this.asignacionForm.co_control_perceptivo =
                                        respuesta.data.co_control_perceptivo;
                                    this.asignacionForm.activos = activos;

                                    for (let factura of facturas) {
                                        if (factura.id_status == '1') {
                                            this.asignacionForm.co_factura = factura.co_factura;
                                        } else if (factura.id_status == '2') {

                                            let found = false;

                                            for (let asignacionFactura of this.asignacionForm.facturas) {
                                                if (asignacionFactura.co_factura === factura.co_factura) {
                                                    found = true;
                                                }
                                            }

                                            if (found !== true) {
                                                this.asignacionForm.facturas.push(factura);
                                            }
                                        }
                                    }

                                }
                            }
                        } else {
                            alert("Error, por favor intente más tarde");
                        }
                    })
                    .catch(error => {
                        console.error(error)
                        alert("Error, por favor intente más tarde");
                    });
            }
        },
        mapData() {
            if (this.item) {

                for (let detalle of this.item.detalles) {

                    if (this.recepcionForm) {

                        if (detalle.tx_tipo_detalle == 'recepcion') {

                            for (let key in detalle) {

                                if (this.recepcionForm.hasOwnProperty(key)) {
                                    this.recepcionForm[key] = detalle[key];
                                }
                            }

                        } else {
                            continue;
                        }

                    } else if (this.controlForm) {

                        if (detalle.tx_tipo_detalle == 'control') {

                            for (let key in detalle) {

                                if (this.controlForm.hasOwnProperty(key)) {

                                    if (key == 'nb_moneda') {
                                        this.controlForm[key] = { nb_moneda: detalle[key] };
                                    }
                                    this.controlForm[key] = detalle[key];
                                }
                            }

                        } else {
                            continue;
                        }

                    } else if (this.asignacionForm) {

                        if (detalle.tx_tipo_detalle == 'asignacion') {

                            for (let key in detalle) {

                                if (this.asignacionForm.hasOwnProperty(key)) {
                                    this.asignacionForm[key] = detalle[key];
                                }
                            }
                        } else {
                            continue;
                        }

                    }

                }
                for (let factura of this.item.facturas) {
                    if (this.recepcionForm) {
                        if (factura.id_status == '1') {
                            this.recepcionForm.co_factura = factura.co_factura;
                        } else if (factura.id_status == '2') {

                            let found = false;

                            for (let recepcionFactura of this.recepcionForm.facturas) {
                                if (recepcionFactura.co_factura === factura.co_factura) {
                                    found = true;
                                }
                            }

                            if (found !== true) {
                                this.recepcionForm.facturas.push(factura);
                            }
                        }
                    } else if (this.controlForm) {

                        if (factura.id_status == '1') {
                            this.controlForm.co_factura = factura.co_factura;
                        } else if (factura.id_status == '2') {

                            let found = false;

                            for (let controlFactura of this.controlForm.facturas) {
                                if (controlFactura.co_factura === factura.co_factura) {
                                    found = true;
                                }
                            }

                            if (found !== true) {
                                this.controlForm.facturas.push(factura);
                            }
                        }

                    } else if (this.asignacionForm) {

                        if (factura.id_status == '1') {
                            this.asignacionForm.co_factura = factura.co_factura;
                        } else if (factura.id_status == '2') {

                            let found = false;

                            for (let asignacionFactura of this.asignacionForm.facturas) {
                                if (asignacionFactura.co_factura === factura.co_factura) {
                                    found = true;
                                }
                            }

                            if (found !== true) {
                                this.asignacionForm.facturas.push(factura);
                            }

                        }

                    }
                }

            } else {
                this.reset()
            }

        },
        reset() {
            this.items = [];
            this.$refs.form.reset();
        },
        async getCurrencyCodes() {

            let url = `${this.$App.baseUrl}` + 'moneda';
            this.loading = true;
            await axios.get(url)
                .then(respuesta => {

                    this.currencyCodes = (respuesta.data) ? respuesta.data : [{ nb_moneda: 'BOLIVAR' }];

                }).catch(error => {
                    this.verError(error);
                })

        },
    }
}