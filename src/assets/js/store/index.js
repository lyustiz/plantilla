import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import mensaje from '../store/app/mensaje'

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        mensaje
    },
    strict: debug
})
