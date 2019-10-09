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
    title:    'Corpovex',
    version:  '0.1',
    basePath: '/api/v1/',
    ApiUrl:   '127.0.0.1:8000/api/v1',
    debug:    false,
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


/**
 *
 *
 *
 *
 *
 * const requireComponent = require.context(
  // The relative path of the components folder
  './components',
  // Whether or not to look in subfolders
  false,
  // The regular expression used to match base component filenames
  /Base[A-Z]\w+\.(vue|js)$/
)
requireComponent.keys().forEach(fileName => {
  // Get component config
  const componentConfig = requireComponent(fileName)
  // Get PascalCase name of component
  const componentName = upperFirst(
    camelCase(s
      // Strip the leading `./` and extension from the filename
      fileName.replace(/^\.\/(.*)\.\w+$/, '$1')
    )
  )
  // Register component globally
  Vue.component(
    componentName,
    // Look for the component options on `.default`, which will
    // exist if the component was exported with `export default`,
    // otherwise fall back to module's root.
    componentConfig.default || componentConfig
  )
})
 */
