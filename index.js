
$("#headers").children().each(function (i) {
  $(this).unbind("click").click(sort);
});

function sort(event) {
  if($(event.target).find("span").length > 0) {
    if($(event.target).find("span").attr("class").split(" ")[1]==="glyphicon-triangle-top") {
      window.location = "http://wproj.csc.kth.se/~shamra/index.php?sortit=" + $(this).attr("id") + "&orderit=" + "DESC";
    } else {
      window.location = "http://wproj.csc.kth.se/~shamra/index.php?sortit=" + $(this).attr("id") + "&orderit=" + "ASC";
    }
} else {
    window.location = "http://wproj.csc.kth.se/~shamra/index.php?sortit=" + $(this).attr("id") + "&orderit=" + "ASC";
}
};
