(function(scope, $, Vue){

  /* VUE WARPPER
  *************************/
  var initViewJs = function()
  {
    Vue.http.interceptors.unshift(function(request, next) {
      next(function(response) {
        if(typeof response.headers['content-type'] != 'undefined') {
          response.headers['Content-Type'] = response.headers['content-type'];
        }
      });
    });
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
