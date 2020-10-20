import Vue from 'vue'
import ComponentLoader from '@/components/ComponentLaoder.vue'

//import store from '@/store/store'

// utils
//import '@/utils/directives'
//import '@/utils/filters'

// UI old school
//import '@/ui/menu.js'

// components
Vue.component('component-loader', ComponentLoader)

// boostrap settings
Vue.config.devtools = true;
Vue.config.productionTip = true;

// create instance
new Vue({
  //store,
  el: "#front-app"
})
