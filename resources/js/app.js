import Vue      from 'vue';
import router   from './router';
import store    from './store';

/** Plugins **/
import './plugins/axios';
import vuetify from './plugins/vuetify';

/** Componente Ppal   **/
import App from './layouts/App.vue'
Vue.component('app', App)

/** Config **/
Vue.prototype.$App = Object.freeze({
    title:    'Bandes',
    version:  '0.1',
    basePath: '/api/v1/',
    ApiUrl:   '127.0.0.1:8000/api/v1',
    debug:    true,
    theme:{
            headPpal:  'red darkness-3',
            textPpal:  'white--text',
            headForm:  'blue',
            textForm:  'white--text',
            headList:  'blue darken-3',
            textList:  'white--text',
            headModal: 'red',
            textModal: 'white--text',
            }
    })

/** Components Autoload **/
import './components/components'

/** Minxins Autoload **/
import appMsj from './mixins/AppMsj'
Vue.mixin(appMsj)

const app = new Vue({
    el: '#app',
    mixins:[appMsj],
    store,
    router,
    vuetify,
});
