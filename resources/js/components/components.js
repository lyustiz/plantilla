import Vue from 'vue';

import Login 		  from '~/components/app/AppLogin'
import ListButtons    from '~/components/list/ListButton.vue'
import AddButton      from '~/components/list/AddButton.vue'
import ListContainer  from '~/components/list/ListContainer.vue'
import AppForm        from '~/components/form/AppForm.vue'
import FormButtons    from '~/components/form/FormButton.vue'
import FormDelete     from '~/components/form/FormDelete.vue'
import AppMensaje     from '~/components/app/AppMensaje.vue'
import AppModal       from '~/components/app/AppModal.vue'
import AppDialog      from '~/components/app/AppDialog.vue'
import AppDataTable   from '~/components/app/AppDataTable'
import AppIconButtom  from '~/components/app/AppIconButtom'
import AppAutocomplet from '~/components/app/AppAutocomplete'
import AppSteeper     from '~/components/app/AppSteeper'

Vue.component('app-login',       Login);
Vue.component('list-buttons',    ListButtons);
Vue.component('add-button',      AddButton);
Vue.component('list-container',  ListContainer);
Vue.component('app-form',        AppForm);
Vue.component('form-buttons',    FormButtons);
Vue.component('form-delete',     FormDelete);
Vue.component('app-message',     AppMensaje);
Vue.component('app-modal',       AppModal);
Vue.component('app-dialog',      AppDialog);
Vue.component('app-data-table',  AppDataTable);
Vue.component('app-icon-buttom', AppIconButtom);
Vue.component('app-auto-complete', AppAutocomplet);
Vue.component('app-steeper',     AppSteeper);
