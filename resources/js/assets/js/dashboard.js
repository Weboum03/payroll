
// function showLabel() {
//     document.getElementById('.input[type=date]').style.opacity = 0;
//   }
$(document).ready(function () {

  $('#accordion').click(function (e) {
    e.preventDefault();
  });

  var currentPageURL = window.location.href;
  $(".card-body a").each(function () {
    if ($(this).attr("href") === currentPageURL) {
      $(this).addClass("current-page");
    }
  });








  $('#accordion .collapse').removeClass('show'); // Remove the 'show' class from all collapsible elements
  $('#accordion .btn-link').attr('aria-expanded', 'false'); // Set aria-expanded attribute to 'false' for all accordion buttons

  $('#accordion .collapse').on('shown.bs.collapse', function () {
    $(this).parent().find('.btn-link').addClass('collapsed');
  });

  $('#accordion .collapse').on('hidden.bs.collapse', function () {
    $(this).parent().find('.btn-link').removeClass('collapsed');
  });

  $(".nav-icon").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
  });

  $(".profile .icon_wrap").click(function (e) {
    e.stopPropagation();
    $(this).toggleClass("active");
    $(".notifi").removeClass("active");
  });

  $(".notifi").click(function (e) {
    e.stopPropagation();
    $(this).toggleClass("active");
    $(".profile").removeClass("active");
  });

  $(".show_all .link").click(function (e) {
    e.stopPropagation();
    $(".notifi").removeClass("active");
    $(".popup").show();
  });

  $(".close").click(function (e) {
    e.stopPropagation();
    $(".popup").hide();
  });

  $(document).click(function () {
    $(".notifi").removeClass("active");
    $(".profile").removeClass("active");
    $(".popup").hide();
  });

 

  $('#EmpTable tbody tr').click(function () {
    window.location.href = "../HTML/EmpProfile.html";
  });

  $('#Allemp-ancordien-item').click(function () {
    window.location.href = "../HTML/dashboard.html";

  });
  $('#On-board-ancordien-item').click(function () {
    window.location.href = "/admin/onBoard";

  });

  // remove cards on onboard
  $(".removeTask").click(function () {
    var parentElement = $(this).closest('.card-body');
    parentElement.hide();
  });



  //   $("#EmpTable_previous").html().empty();
  //  ============= datatable===================






});




