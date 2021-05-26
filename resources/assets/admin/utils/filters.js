

/* file size */
var UNITS = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
var STEP = 1024;

var filterFormat = function(value, power) {
  return (value / Math.pow(STEP, power)).toFixed(2) + UNITS[power];
}

Vue.filter('smart-file-size', function (value) {
  value = parseFloat(value, 10);
  for (var i = 0; i < UNITS.length; i++) {
    if (value < Math.pow(STEP, i)) {
      if (UNITS[i - 1]) {
        return filterFormat(value, i - 1);
      }
      return value + UNITS[i];
    }
  }
  return filterFormat(value, i - 1);
});
