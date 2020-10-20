// inputs
var initSelect = function(){
  $('select').select2();
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
