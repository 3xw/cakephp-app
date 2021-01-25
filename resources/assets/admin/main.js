import ComponentLoader from '@/components/ComponentLaoder.vue'
import store from '@/store/store'

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/fr'

import Cms from '©/3xw/cakephp-cms/resources/assets/vue/plugin'

// utils
//import '@/utils/directives'
//import '@/utils/filters'

// ADMIN UI old school
import {init as initMenu} from '@/ui/menu.js'
import {init as initForm} from '@/ui/form.js'

// use
Vue.use(ElementUI, { locale })

// components
Vue.component('component-loader', ComponentLoader)

// boostrap settings
Vue.config.devtools = true;
Vue.config.productionTip = true;

// create instance
const init = () => {
  window.adminApp = new Vue({
    store,
    el: "#admin-app",
    mounted: function()
    {
      initMenu()
      initForm()
    }
  })
}

// boostrap
$(document).ready(init)
