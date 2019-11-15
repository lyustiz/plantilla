<template>

    <div>

        <app-modal
            titulo      = 'Agregar / Crear Siniestros'
            :modal      = showModal
            @closeModal = shut
        >
            <app-form>

            </app-form>
        </app-modal>

        <app-list
            :iconsButtom = "items"
        >
        </app-list>

    </div>

</template>

<script>
import SiniestroForm from '~/pages/Fas/Siniestro/SiniestroForm'
import SiniestroList from '~/pages/Fas/Siniestro/SiniestroList'
export default {
    data(){
        return{
            items:
            {
                note       : "Notas"    ,
                save       : "Guardar"  ,
                edit       : "Modificar",
                delete     : "Eliminar" ,
            },
        }
    },
    components:
    {
        'app-list' : SiniestroList,
        'app-form' : SiniestroForm,
    },
    computed:
    {
        showModal()
        {
            return this.$store.getters['getButtom']
        }
    },
    methods:
    {
        shut()
        {
            this.$store.commit('setButtom', false)
        }
    },
}
</script>