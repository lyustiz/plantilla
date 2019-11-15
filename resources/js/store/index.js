import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import AppMessage from '../store/app/AppMessage'
import user         from '../store/auth/user'
import AppDataTable from '../store/app/AppDataTable'

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        AppMessage,
        user,
        AppDataTable
    },
    strict: debug
})
