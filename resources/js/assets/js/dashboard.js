
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

  let dataTable = new DataTable('#EmpTable', {
    paginate: true, // Enable pagination
    lengthChange: true,
    lengthMenu: [
      [10, 25, 50, 100],
      [10, 25, 50, 100]
    ],
    language: {
      paginate: {
        next: '&#8594;', // Custom next symbol
        previous: '&#8592;' // Custom previous symbol
      }
    }
  })
  $("#EmpTable_filter").addClass(".add")

  $("#EmpTable_filter").css('display', 'flex').css('justify-content', 'space-between')

  $("#EmpTable_filter").append('<button id="button3" class="add" style="height: 36.83px;width: 121px;font-size: 12px;font-weight: 500;font-family: sans-serif;padding-left: 12px;border: none;border-radius: 5px;text-align: left;">Add on Board</button>');
  $('.add,.add1').on("click", function (e) {
    e.preventDefault();
    window.location.href = "/admin/onBoard";
  })
  $.ajax({
    url: './employees.json',
    method: 'GET',
    dataType: 'json',
    success: function (data) {

      dataTable.clear().draw();

      data.forEach(function (item) {
        var rowData = [
          item.Name,
          item.employId,
          item.Email,
          item.Mobile,
          item.Mobile,

        ];
        dataTable.row.add(rowData).draw();
      });

    },
  })




});




