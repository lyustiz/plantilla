<template>

    <!--menu-->
    <v-list>

        <v-list-tile
        router
        :to="item.to"
        :key="i"
        v-for="(item, i) in items"
        exact
        ripple
        active-class="menu-active"
        >
            <v-list-tile-action>
                <v-icon v-html="item.icon"></v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title v-text="item.title"></v-list-tile-title>
            </v-list-tile-content>

        </v-list-tile>

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
