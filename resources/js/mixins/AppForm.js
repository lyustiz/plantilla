import AppFormat from './AppFormat';
import AppRules from './AppRules'

export default {
    mixins: [AppFormat, AppRules],
    mounted()
    {
        this.listsLoader()
        this.rstForm();
        this.basePath += this.tabla
        this.form.id_usuario = 1;
    },
    data() {

        return {

            basePath:   '/api/v1/',
            id_usuario: 1,//this.$store.getters.user.id_usuario,
            valido:     false,
            btnAccion:  '',
            picker:     false,
            dates:      {},
            rules: {
                select: [
                    v => !!v || 'Seleccione una Opcion (Campo Requerido)',
                    ],
                requerido: [
                    v => !!v || 'Campo Requerido',
                    ],
                monto: [
                    v => !!v || 'Monto Requerido',
                   ],
                fecha: [
                    v => !!v || 'Fecha Requerida',
                    ],
            }

        }
    },
    props: ['accion', 'item', 'titulo'],

    watch: {

        accion (val)
        {
            this.btnAccion = val;

            if(val=='upd')
            {
                this.mapForm();
            }else
            {
                this.clear();
            }
        },

        item (val) {
            this.mapForm()
        }
    },
    filters: {

        formDate: function (value) {

            if (!date) return null
            const [year, month, day] = date.split('-')
            return `${day}/${month}/${year}`
        },
        formatNumber: function (value)
        {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

    },
    methods: {
        formatDate (date)
        {
            if (!date) return null

            const [year, month, day] = date.split('-')

            return `${day}/${month}/${year}`
        },
        formatNumber: function (value)
        {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        listRequests(objLists)
        {
            let request = [];

            for(var list in objLists)
            {
                let param = (objLists[list]) ? objLists[list] : '';

                request.push(axios.get(this.basePath + list + param));
            }

            return axios.all(request)

        },
        listsLoader()
        {
            this.listRequests(this.lists)
            .then
            (
                axios.spread( (...dataLists) =>
                {
                    let i = 0;
                    for(var key in this.lists)
                    {
                        this.lists[key] = dataLists[i].data
                        i++;
                    }
                })
            )
            .catch(error =>
            {
                this.showError(error);
            });
        },
        mapForm()
        {
            if(this.item)
            {
                for(var key in this.item)
                {
                    if(this.form.hasOwnProperty(key))
                    {
                        if(key.substr(0, 2) == 'fe')
                        {
                            this.dates[key] =  this.formatDate(this.item[key]);
                        }
                        this.form[key]  =  this.item[key];
                    }
                }
            }else
            {
                this.rstForm()
            }
        },
        rstForm()
        {
            for(var key in this.form)
            {
                this.form[key] = null;
            }

            for(var key in this.dates)
            {
                this.dates[key] = null;
            }

            this.form.id_usuario = 1
        },
        clear ()
        {
            this.$refs.form.reset();
            this.rstForm();
        },
        cancel()
        {
            this.$emit('modalClose');
            this.clear();
        },
    }
}
