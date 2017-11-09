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
    var adminApp = new Vue({el: "#admin-app"});
  }

  var webroot = $('#admin-app').attr('data-webroot');

  var initSelect = function(){
    $('select').select2();
  }

  var initTextarea = function(){
    $('textarea').trumbowyg({
      btns: [
          ['viewHTML'],
          ['formatting'],
          ['strong', 'em', 'del'],
          ['superscript', 'subscript'],
          ['link'],
          ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
          ['unorderedList', 'orderedList'],
          ['horizontalRule'],
          ['removeformat'],
          ['fullscreen']
      ],
      svgPath: webroot+'js/admin/vendor/trumbowyg/icons.svg'
    });
  }

  var collapseIconChange = function(){
    $('[data-toggle="collapse"]:not(.navbar-toggler)').click(function(){
      var ico = $(this).find('i:last-child');
      if(ico.text() == 'expand_more'){
        ico.text('expand_less');
      }else{
        ico.text('expand_more');
      }
    });
  }

  var main = function()
  {
    initViewJs();
    initSelect();
    initTextarea();
    collapseIconChange();
  }

  $(document).ready(main);


})(window, jQuery, Vue);
