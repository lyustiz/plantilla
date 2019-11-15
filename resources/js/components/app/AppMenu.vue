<template>

    <!--menu-->
    <v-list>

        <v-list-item
        router
        :to="item.to"
        :key="i"
        v-for="(item, i) in items"
        exact
        ripple
        active-class="menu-active"
        
        >
            <v-list-item-avatar>
                <v-icon v-html="item.icon"></v-icon>
            </v-list-item-avatar>

            <v-list-item-content>
                <v-list-item-title v-text="item.title"></v-list-item-title>
            </v-list-item-content>

        </v-list-item>

    </v-list>

</template>

<script>

import AppFormat from '~/mixins/AppFormat'
import AppMessage from '~/mixins/AppMessage'

export default {
    mixins:[ AppFormat, AppMessage ],
    props:
    {
        items:{
            type: Array,
        },
    },
    data()
    {
        return{
            url : 'api/ldap/',
        }
    },
    created (){

            let url = this.url + this.$store.getters.username

            axios.get(url).then( response => 
            {
                if(response.status==200)
                {
                     console.log(response.data)
                    this.menuLdap=response.data
                }
            })
            .catch(error => 
            {
                this.showError(error)
            })
            
        },  
        methods:
        {
            actionName(value)
            {
                let elements = value.split('/')
                return this.capitalize(elements[elements.length-1])
            },
        },
}
</script>

<style scoped>
    .menu-active{
        color:#f44336 !important;
        caret-color: #f44336 !important;
    }
    .v-list-item--link::before{
        background-color: rgb(134, 133, 133) !important;
    }
</style>
