import Appformat from './AppFormat';

export default {
    mixins: [Appformat],
    created()
    {
        this.list();
    },
    data() {

        return {

            basePath:   this.$App.base,
            idUsuario:  1,//this.$store.getters.user.id_usuario,
            isLoading:  true,
            modal:      false,
            selected:   [],
            items:      '',
            item:       '',
            search:     '',
            accion:     '',
            nbAction:   '',
            dialog:     false,
        }
    },
    methods: {
        modalClose()
        {
            this.modal  = false;
            this.item   = '';
            this.list();
            this.action = false;
        },
        insItem ()
        {
            this.item = '';
            this.nbAction  = 'Agregar:';
            this.action     = 'ins';
            this.modal      = true;
        },
        updItem (item)
        {
            this.nbAction  = 'Editar:';
            this.action     = 'upd';
            this.modal      = true;
            this.item       = item;
        },
        delForm (item)
        {
            this.dialog = true;
            this.item = item;
        },
        delCancel ()
        {
            this.dialog = false;
        }
    }

}
