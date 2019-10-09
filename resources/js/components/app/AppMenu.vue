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
export default {
    props:
    {
        items:{
            type: Array,
        },
    }
}
</script>

<style scoped>
    .menu-active{
        color:#f44336 !important;
        caret-color: #f44336 !important;
    }
</style>
