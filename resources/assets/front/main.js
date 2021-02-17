import ComponentLoader from '@/components/ComponentLaoder.vue'
import store from '@/store'

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/fr'

// utils
//import '@/utils/directives'
//import '@/utils/filters'
import '@/utils/getCsrfToken'

import { init as initJqueryUtils } from '@/utils/jquery'

// UI old school
import { init as initMenu } from '@/ui/menu'

// components
Vue.component('component-loader', ComponentLoader)

// Attachment :)
import Attachment from '©/3xw/cakephp-attachment/resources/assets/plugin'
Vue.use(Attachment,{ store })

// CakePHP Cms
import Cms from '©/3xw/cakephp-cms/resources/assets/plugin'
Vue.use(Cms,{ store })

// boostrap settings
Vue.config.devtools = true;
Vue.config.productionTip = true;

// create instance
const init = () => {
  window.eventHub = new Vue();
  window.frontApp = new Vue({
    store,
    el: "#front-app",
    data:
    {
      baseUrl: BASE_URL
    },
    mounted()
    {
      initJqueryUtils()
      initMenu()
    }
  })
}

// boostrap
$(document).ready(init)
