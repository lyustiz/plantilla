<template>
    <div>  

    <index-form 
        @closeModal="closeModal()" 
        :item="selected" 
        :action="action"
    ></index-form>

    <v-container my-1></v-container>

    <app-data-table
    
       title        = ""
       :bedside     = "headers"
       :body        = "desserts" 
       keyChain     = "name"
       :checkbox    = "false"
       :iconsButtom = "iconsButtom"
       @buttomPress = "buttomPress"
    >
    </app-data-table>

    <app-modal 
    :modal      = "showModal" 
    @closeModal = "shut"
    >
        <index-form 
            @closeModal="closeModal()" 
            :item="selected" 
            :action="action"
        ></index-form>
    </app-modal>

</div>

</template>
<script>
    import IndexForm from './IndexForm'
    import listMixin from '~/mixins/Applist' 

    export default { 
        mixins:[listMixin],
        components:{ 
            'index-form': IndexForm
        },
        created(){
            this.action = null
        },
        data(){
            return {
                resources:"cliente",
                iconsButtom:{
                    delete     : "Eliminar" ,
                },
                headers: 
                    [
                        {
                            text: 'Dessert (100g serving)',
                            align: 'left',
                            value: 'name'
                        },
                        { text: 'Calories'      , value: 'calories' },
                        { text: 'Fat (g)'       , value: 'fat'      },
                        { text: 'Carbs (g)'     , value: 'carbs'    },
                        { text: 'Protein (g)'   , value: 'protein'  },
                        { text: 'Iron (%)'      , value: 'iron'     },
                        { text: 'Acciones'      , value: 'accion'   }
                    ],
                desserts: 
                    [
                        {
                            name: 'Frozen Yogurt',
                            calories: 159,
                            fat: 6.0,
                            carbs: 24,
                            protein: 4.0,
                            iron: '1%'
                        },
                        {
                            name: 'Ice cream sandwich',
                            calories: 237,
                            fat: 9.0,
                            carbs: 37,
                            protein: 4.3,
                            iron: '1%'
                        },
                        {
                            name: 'Eclair',
                            calories: 262,
                            fat: 16.0,
                            carbs: 23,
                            protein: 6.0,
                            iron: '7%'
                        },
                        {
                            name: 'Cupcake',
                            calories: 305,
                            fat: 3.7,
                            carbs: 67,
                            protein: 4.3,
                            iron: '8%'
                        },
                        {
                            name: 'Gingerbread',
                            calories: 356,
                            fat: 16.0,
                            carbs: 49,
                            protein: 3.9,
                            iron: '16%'
                        },
                        {
                            name: 'Jelly bean',
                            calories: 375,
                            fat: 0.0,
                            carbs: 94,
                            protein: 0.0,
                            iron: '0%'
                        },
                        {
                            name: 'Lollipop',
                            calories: 392,
                            fat: 0.2,
                            carbs: 98,
                            protein: 0,
                            iron: '2%'
                        },
                        {
                            name: 'Honeycomb',
                            calories: 408,
                            fat: 3.2,
                            carbs: 87,
                            protein: 6.5,
                            iron: '45%'
                        },
                        {
                            name: 'Donut',
                            calories: 452,
                            fat: 25.0,
                            carbs: 51,
                            protein: 4.9,
                            iron: '22%'
                        },
                        {
                            name: 'KitKat',
                            calories: 518,
                            fat: 26.0,
                            carbs: 65,
                            protein: 7,
                            iron: '6%'
                        }
                    ],
            }
        },
        methods:
        {
            buttomPress(value)
            {
                this.$store.commit('setButtom', true)
            },
            shut()
            {
                this.$store.commit('setButtom', false)
            } 
        },
        computed:
        {
            showModal()
            {
                return this.$store.getters['getButtom']
            }
        },
    }
</script>
