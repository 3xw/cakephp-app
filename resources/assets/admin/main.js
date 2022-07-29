import ComponentLoader from '@/components/ComponentLaoder.vue'
import store from '@/store/store'
import ElementUI from 'element-ui'

import locale from 'element-ui/lib/locale/lang/fr'

// utils
//import '@/utils/directives'
import '@/utils/filters'
import '@/utils/getCsrfToken'

// ADMIN UI old school
import {init as initMenu} from '@/ui/menu.js'
import {init as initForm} from '@/ui/form.js'

// use
Vue.use(ElementUI, { locale })

// components
Vue.component('component-loader', ComponentLoader)

// CakePHP Tinymce
import Tinymce from '©/3xw/cakephp-tinymce/resources/assets/plugin'
Vue.use(Tinymce,{ store })

// CakePHP Attachment
import Attachment from '©/3xw/cakephp-attachment/resources/assets/plugin'
Vue.use(Attachment,{ store })

// plugin attachment for Tinymce
import TinyFactory from '©/3xw/cakephp-attachment/resources/assets/plugins/TinyFactory.js'
TinyFactory.init(store)

// boostrap settings
Vue.config.devtools = true;
Vue.config.productionTip = true;

// create instance
const init = () => {
  window.adminApp = new Vue({
    store,
    el: "#admin-app",
    data:
    {
      baseUrl: BASE_URL
    },
    mounted: function()
    {
      initMenu()
      initForm()
    }
  })
}

// boostrap
$(document).ready(init)
