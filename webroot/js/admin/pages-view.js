(function($,scope){

  var sortable;

  var onUpdate = function(evt)
  {
    sortable.option("disabled", true);
    data = [];
    $('.pageitem').each(function(index, value){
      var $itm = $(this);
      console.log($itm);
      $itm.attr('data-order', index);
      data.push({
        id: $itm.data('id'),
        order: index
      });
    });
    $.ajax({
      url: $('#pageitems').data('url'),
      contentType: 'application/json',
      data: JSON.stringify(data),
      method: 'POST',
      dataType: 'json'
    })
    .done(function(data){
      sortable.option("disabled", false);
    })
    .fail(function(data){
      alert('An error occured!');
      sortable.option("disabled", false);
    })
  }

  var init = function()
  {
    var el = document.getElementById('pageitems');
    sortable = Sortable.create(el,{
      draggable: ".pageitem",
      onUpdate: onUpdate
    });
  }

  $('document').ready(init);

})(jQuery, window)
