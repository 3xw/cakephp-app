import ComponentLoader from '../../vue/componentLaoder.vue';
(function(scope, $, Vue){

  /* VUE WARPPER
  *************************/
  var initViewJs = function()
  {
    scope.eventHub = new Vue();
    scope.frontApp = new Vue({el: "#front-app"});
  }

  /* BOOTSTRAP
  *************************/
  var main = function()
  {
    initViewJs();
  }

  $(document).ready(main);

})(window, jQuery, Vue);
