// inputs
var initSelect = function(){
  $('select').select2();
}

// i18n
var initI18n = function()
{
  if(!window.language) return;
  hideShowLanguagesInputs( window.language );
  $('#locale-selector-ul a').click(handleI18nTabs);
}

var hideShowLanguagesInputs = function( lng )
{
  $('.locale-'+lng).parents('.form-group').show();
  for( var i in window.languages ){
    if( window.languages[i] != lng ){
      $('.locale-'+window.languages[i]).parents('.form-group').hide();
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

//Cms Plugin -- Menu Item add edit
var urlPageSelect = function()
{
  $('.menu-item__page-select').change(function(){
    var option = $(this).find("option:selected").first()
    if(option[0].value.length > 0){
      $('.menu-item__page-url').attr("readonly", true)
      $('.menu-item__page-url')[0].value = option[0].value
      $('.menu-item__model')[0].value = $(this).attr('data-model')
      //$('.menu-item__foreign_key')[0].value = option[0].value;
      $('.menu-item__title')[0].value = option[0].innerText.replace(/ - /g,"")
      console.log(option[0].innerText.replace(/ - /g,""));
    }else{
      $('.menu-item__page-url').attr("readonly", false)
    }
  })
}

var formFieldSelect = function()
{
  formFieldShow();
  $('[id="type"]').change(function(){
    formFieldShow();
  })

}

var formFieldShow = function()
{
  let val = $('[id="type"]')[0].value
  if(val == 'select' || val == 'radio'){
    $('#options').removeClass('d-none')
    $('[for="options"]').removeClass('d-none')
  }else{
    $('#options').addClass('d-none')
    $('[for="options"]').addClass('d-none')
  }
}

const init = () =>
{
  initSelect()
  urlPageSelect()
  formFieldSelect()
  setTimeout(function(){
    initI18n()
  }, 1000)
}

export { init }
