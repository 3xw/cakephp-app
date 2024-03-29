import store from '@/store'

// utils
//import '@/utils/directives'
//import '@/utils/filters'
import '@/utils/getCsrfToken'

import { init as initJqueryUtils } from '@/utils/jquery'

// CakePHP Attachment
import Attachment from '©/3xw/cakephp-attachment/resources/assets/plugin'
Vue.use(Attachment,{ store })

// CakePHP Tinymce
import Tinymce from '©/3xw/cakephp-tinymce/resources/assets/plugin'
Vue.use(Tinymce,{ store })

// plugin attachment for Tinymce
import TinyFactory from '©/3xw/cakephp-attachment/resources/assets/plugins/TinyFactory.js'
TinyFactory.init(store)

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
