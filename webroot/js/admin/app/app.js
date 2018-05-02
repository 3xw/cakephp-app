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
    $('textarea:not(.no-trumbowyg)').trumbowyg({
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
      svgPath: webroot+'js/admin/vendor/trumbowyg/icons.svg',
      autogrow: true,
      resetCss: true,
      removeFormatPasted: false
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

  // i18n
  var initI18n = function()
  {
    if(!scope.language) return;
    hideShowLanguagesInputs( scope.language );
    $('#locale-selector-ul a').click(handleI18nTabs);
  }

  var hideShowLanguagesInputs = function( lng )
  {
    $('.locale-'+lng).parents('.form-group').show();
    for( var i in scope.languages ){
      if( scope.languages[i] != lng ){
        $('.locale-'+scope.languages[i]).parents('.form-group').hide();
      }
    }
  }

  var handleI18nTabs = function(evt)
  {
    evt.preventDefault();
    var lng = $(this).html();
    $('.locale-selector-li').removeClass('active');
    $('.locale-selector-li--'+lng).addClass('active');
    hideShowLanguagesInputs( lng );
  }



  var main = function()
  {
    initViewJs();
    initSelect();
    initTextarea();
    collapseIconChange();
    initI18n();
  }

  $(document).ready(main);


})(window, jQuery, Vue);
