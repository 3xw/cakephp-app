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