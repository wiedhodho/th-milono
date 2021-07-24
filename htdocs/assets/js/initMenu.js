function initActiveMenu() {
  $(".page-sidebar a").each(function () {
    var pageUrl = window.location.href.split(/[?#]/)[0];
    if (this.href == pageUrl) {
      if ($(this).parent().parent().attr("class") == "accordion-menu") {
        $(this).parent().addClass("active-page");
        $(this).addClass("active");
      } else {
        $(this).parent().parent().parent().addClass("active-page");
        $(this).addClass("active");
      }
    }
  });
}
