(function(scope, $, Vue){

  /* Notify
  ****************************/
  var notify = function()
  {
    if($('.flash').length > 0)
    {
      var $f = $('.flash');
      var type = $f.hasClass('alert-danger')? 'danger' : $f.hasClass('alert-success')? 'success' : 'info';
      $.notify({message: $f.html() },{type: type });
    }
  }

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
    var adminApp = new Vue({el: "#admin-app"});
  }

  /* HELP
  *************************/
  var helpContainer = '.main-panel';

  var enableHelp = function()
  {
    if ($('[data-intro]').length > 0)
    {
      $('#sidebar-help').removeClass('hidden');
      $(helpContainer).bind('chardinJs:stop', function(){
        createTrumbowyg();
        var styles = { width : "calc(100% - 260px)", height: "100%", float: "right",padding : '0' };
        $('.main-panel').css(styles);
        $('.sidebar').removeClass('hidden');
      });
      $('#sidebar-help a').bind('click', function(e){
        $('.sidebar').addClass('hidden');
        var styles = { width : "100%", height: "auto", float: "none",padding : '0 0 0 290px' };
        $('.main-panel').css(styles);
        e.preventDefault();
        destoryTrumbowyg();
        setTimeout(function(){
          $(helpContainer).chardinJs('start');
        },500);
      });
    }
  }

  var main = function()
  {
    notify();
    initViewJs();
    enableHelp();
  }

  $(document).ready(main);


})(window, jQuery, Vue);
