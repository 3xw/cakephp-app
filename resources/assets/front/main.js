import ComponentLoader from '@/components/ComponentLaoder.vue'
//import store from '@/store/store'

// CakePHP Cms
import Cms from '©/3xw/cakephp-cms/resources/assets/vue/plugin'

// utils
//import '@/utils/directives'
//import '@/utils/filters'
import '@/utils/getCsrfToken'

import { init as initJqueryUtils } from '@/utils/jquery'

// UI old school
import { init as initMenu } from '@/ui/menu'

// components
Vue.component('component-loader', ComponentLoader)

// use
console.log(Cms);
Vue.use(Cms)

// boostrap settings
Vue.config.devtools = true;
Vue.config.productionTip = true;

// create instance
const init = () => {
  window.eventHub = new Vue();
  window.frontApp = new Vue({
    //store,
    el: "#front-app",
    mounted: function(){
      initJqueryUtils()
      initMenu()
    }
  })
}

// boostrap
$(document).ready(init)
