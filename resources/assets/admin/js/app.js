import ComponentLoader from '../vue/componentLaoder.vue'
import store from './store/store.js'

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

  var reduceMenu = function(){
    $('.sidebar__toggler').click(function(){
      if($(this).hasClass('actived')){
        $(this).removeClass('actived')
        $('.row-sidebar').addClass('utils__sidebar--simple')
      }else{
        $(this).addClass('actived')
        $('.row-sidebar').removeClass('utils__sidebar--simple')
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
    reduceMenu();
    collapseIconChange();
    initI18n();
  }

  $(document).ready(function(){

    Vue.config.devtools = true;
    Vue.config.productionTip = true;

    window.adminApp = new Vue({
      el: "#admin-app",
      store,
      components: {
        'component-loader': ComponentLoader
      }
    });

    main()
  });


})(window, jQuery, Vue);
