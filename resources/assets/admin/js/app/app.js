import ComponentLoader from '../../vue/componentLaoder.vue';
(function(scope, $, Vue){

  /* VUE WARPPER
  *************************/
  var webroot = $('#admin-app').attr('data-webroot');

  var initSelect = function(){
    $('select').select2();
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

    initSelect();
    collapseIconChange();
    initI18n();
  }

  $(document).ready(function(){

    window.adminApp = new Vue({
      el: "#admin-app",
      components: {
        'component-loader': ComponentLoader
      }
    });

    Vue.config.devtools = true;
    Vue.config.productionTip = true;

    main()
  });


})(window, jQuery, Vue);
