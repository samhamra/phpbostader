console.log(decodeURI("bostadsr%C3%A4tt"));
console.log("hej");
getLastSearch();
function getLastSearch() {
  var propertyList = ["lan", "objekttyp", "minArea", "maxArea", "minRum", "maxRum", "minPris", "maxPris", "maxAvgift", "minAvgift"];
  var cookieList = [];

  $.each(propertyList, function(index, value) {
    var cookie = readCookie(value);
    console.log(value + " " + decodeURI(cookie));
    $('[name=' + value + ']').val(decodeURI(cookie));
  });
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}
