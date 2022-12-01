
var collapseIconChange = function(){
  $('[data-bs-toggle="collapse"]:not(.navbar-toggler)').click(function(){
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

var goMenuIfSmall = function () {
  $('.sidebar__menu [data-bs-toggle="collapse"]').click(function () {
    if (!$('.sidebar__toggler').hasClass('actived')) {
      $('.sidebar__toggler').addClass('actived')
      $('.row-sidebar').removeClass('utils__sidebar--simple')
    }
  })
  $('a [data-bs-toggle="collapse"]').click(function () {
    if (!$('.sidebar__toggler').hasClass('actived')) {
      $('.sidebar__toggler').addClass('actived')
      $('.row-sidebar').removeClass('utils__sidebar--simple')
    }
  })
}

const init = () =>
{
  collapseIconChange()
  reduceMenu()
  goMenuIfSmall()
}

export { init }
