import Vue    from 'vue';

import ListButtons    from '~/components/list/ListButton.vue'
import AddButton      from '~/components/list/AddButton.vue'
import ListContainer  from '~/components/list/ListContainer.vue'

import FormContainer  from '~/components/form/FormContainer.vue'
import FormButtons    from '~/components/form/FormButton.vue'

import AppMensaje     from '~/components/app/AppMensaje.vue'
import AppModal       from '~/components/app/AppModal.vue'
import AppDialogo     from '~/components/app/AppDialogo.vue'


Vue.component('list-buttons',       ListButtons);
Vue.component('add-button',         AddButton);
Vue.component('list-container',     ListContainer);

Vue.component('form-buttons',       FormButtons);
Vue.component('form-container',     FormContainer);


Vue.component('app-mensaje',        AppMensaje);
Vue.component('app-modal',          AppModal);
Vue.component('app-dialogo',        AppDialogo);
