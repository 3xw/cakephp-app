/*  FILTER UTILS
 *  use with ( data-filter-container, data-filter-list, data-filter="VALUE", data-filter-items, data-filter-item="VALUE")
 **/
var filtersList = function(itemsContainer, currentFilter){
  currentFilter.parent().find('[data-filter]').removeClass('utils__filter--active')
  currentFilter.addClass('utils__filter--active')
  itemsContainer.find('[data-filter-item]').removeClass('utils__filter--active')
  itemsContainer.find('[data-filter-item="'+currentFilter.data('filter')+'"]').addClass('utils__filter--active')
}

var filtersActions = function(container, itemsContainer){
  $(container).find('[data-filter]').each(function(){
    $(this).click(function(){
      $('[data-filter]').removeClass('utils__filter--active')
      $(this).addClass('utils__filter--active')
      filtersList(itemsContainer, $(this))
    })
  })
}

var filtersInit = function(){
  $('[data-filter-container]').each(function(){
    var itemsContainer = $(this).find('[data-filter-items]'),
        currentFilter = $(this).find('[data-filter]').first()

    if(currentFilter){
      filtersList(itemsContainer, currentFilter)
      filtersActions(this, itemsContainer)
    }
  });
}

const init = () =>
{
  filtersInit()
}

export { init }
