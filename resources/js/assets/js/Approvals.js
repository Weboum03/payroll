// $(document).ready(function () {
//      let dataTable = new DataTable('#leavesEmpTable', {
//           pagingType: 'simple_numbers'
//         });

//         $("#leavesEmpTable_filter").append('<select id="dropdown1" class="bulkAction" style="height: 30.83px;width: 150px;"><option value="value1">Option 1</option><option value="value2">Option 2</option></select>');
//         $("#leavesEmpTable_filter").append('<select id="dropdown2" class="allActivity" style="height: 30.83px;width: 150px;"><option value="value1">Option 1</option><option value="value1">Option 1</option><option value="value2">Option 2</option></select>');
//         $("#leavesEmpTable_filter").append('<select id="dropdown1" class="empWise" style="height: 30.83px;width: 150px;"><option value="value1">Option 1</option><option value="value2">Option 2</option></select>');
//         $("#leavesEmpTable_filter").append('<button type="button" class="btn refresh"><i class="fa-solid fa-rotate-right fa-flip-horizontal fa-lg" style="color: #ffffff;"></i></button>');
      
//         $("#leavesEmpTable_filter").css('display', 'flex').css('justify-content', 'space-between');

      
//       $.ajax({
//         url: 'your-api-url-here',
//         type: 'GET',
//         success: function(data) {
//           // Populate the table body with the data received from the API
//           const tableBody = $('#leavesEmpTable tbody');
//           tableBody.empty();
//           data.forEach(item => {
//             const row = `<tr>
//                             <td><img src="../IMAGE/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg" width="20px" height="20px" style="border-radius: 50%;">${item.Name}</td>
//                             <td>${item.EmpId}</td>
//                             <td>${item.Email}</td>
//                             <td>${item.Mob}</td>
//                             <td>${item.Role}</td>
//                           </tr>`;
//             tableBody.append(row);
//           });

      
//           // Add event listeners to the dropdowns and refresh button
//           $("#dropdown1").on("change", function() {
//             dataTable.column(0).search($(this).val()).draw();
//           });
      
//           $("#dropdown2").on("change", function() {
//             dataTable.column(1).search($(this).val()).draw();
//           });
      
//           $("#dropdown3").on("change", function() {
//             dataTable.column(2).search($(this).val()).draw();
//           });
      
//           $(".refresh").on("click", function() {
//             dataTable.ajax.reload();
//           });
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//           console.log(textStatus, errorThrown);
//         }
//       });
    
// });

$(document).ready(function () {

    let dataTable = new DataTable('#leavesEmpTable', {
      pagingType: 'simple_numbers'
    });
  
    let dataleaveTableModal = new DataTable('#dataleave-table-modal', {
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
    });
  
    $("#leavesEmpTable_filter").append('<select id="dropdown1" class="bulkAction" style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="BulkAction">Select Bulk Action</option><option value="value2">Option 2</option></select>');
    $("#leavesEmpTable_filter").append('<select id="dropdown2" class="allActivity" style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="AllActivity">All Activities</option><option value="value1">Option 1</option><option value="value2">Option 2</option></select>');
    $("#leavesEmpTable_filter").append('<select id="dropdown1" class="empWise" style="height: 30.83px;width: 150px;font-size: 13px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="Empwise">Employee wise</option><option value="value2">Option 2</option></select>');
    $("#leavesEmpTable_filter").append('<button type="button" class="btn refresh"><i class="fa-solid fa-rotate-right fa-flip-horizontal fa-sm" style="color: #ffffff;"></i></button>');
    $("#leavesEmpTable_filter").css('display', 'flex').css('justify-content', 'space-between');
  
    // Make an AJAX request to retrieve data
    $.ajax({
      url: 'your-api-url-here',
      type: 'GET',
      success: function(data) {
        // Populate the table body with the data received from the API
        const tableBody = $('#leavesEmpTable tbody');
        tableBody.empty();
        data.forEach(item => {

            let statusBtn;

            if (item.status === 'Approved') {
              statusBtn = `<button type="button" class="btn btn-outline-success">Approved</button>`;
            }  if (item.status === 'Rejected') {
              statusBtn = `<button type="button" class="btn btn-outline-danger">Rejected</button>`;
            } if (item.status === 'Pending') {
              statusBtn = `<button type="button" class="btn btn-outline-primary" id="pendingBtn">Pending</button>`;
            }

          const row = `<tr data-toggle="modal" data-target="#leaveModal">
                          <td><img :src="apiPath + 'resources/images/WhatsApp Image 2024-01-25 at 04.41.25_b53bd3e5.jpg'" width="20px" height="20px" style="border-radius: 50%;">${item.Name}</td>
                          <td>${item.Employee}</td>
                          <td>${item.leaveType}</td>
                          <td>${item.From}</td>
                          <td>${item.to}</td>
                          <td>${item.Noofdays}</td>
                          <td>${statusBtn}</td>
                          <td>${item.action}</td>

                          </tr>`;
                          tableBody.append(row);
        });
  
        // Initialize the DataTable with the retrieved data
        $('#leavesEmpTable').DataTable({
          data: data,
          columns: [
            { data: 'Employee' },
            { data: 'leaveType' },
            { data: 'From' },
            { data: 'to' },
            { data: 'Noofdays' },
            { data: 'status' },
            { data: 'action' },
          ]
        });
  
        // Add event listeners to the dropdowns and refresh button
        $("#dropdown1").on("change", function() {
          dataTable.column(0).search($(this).val()).draw();
        });
  
        $("#dropdown2").on("change", function() {
          dataTable.column(1).search($(this).val()).draw();
        });
  
        $("#dropdown3").on("change", function() {
          dataTable.column(2).search($(this).val()).draw();
        });
  
        $(".refresh").on("click", function() {
          dataTable.ajax.reload();
        });
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });


//     $('#leavesEmpTable tbody tr').on("click",function(e) {
//      $("#editLeaveModal").modal('show'); 
//     var $tr = $(this);
//     if($tr.hasClass('selected')){
//       $tr.removeClass('selected');
//     }else{
//       $tr.addClass('selected');
//     }
//     var data = dataTable.row($tr).data();
//     $("#emp_id").val(data[7]);
//     $("#name").html(data[4] + " " + data[5]);
//     $("#position").html(data[6]);    
//     $("#dateFrom").val(moment(data[8], 'YYYY-MM-DD'));
//     $("#dateTo").val(moment(data[9], 'YYYY-MM-DD'));
//     $("#reason").val(data[10]);
//     $("#status").val(data[11]);
//  });

$('#leavesEmpTable tbody tr').on("click", function () {
    $("#leaveModal").modal('show');
});

// $("#View-employee-leave-history").on("show.bs.modal", function(e) {
//     e.preventDefault();
    // var empID = $(e.relatedTarget).attr("value");
    // $.ajax({
    //     type : "GET",
    //     url: "/getEmployeeLeaveHistory/"+empID,
    //     success: function (data) {
    //         $("#view-employee-leave-history-table").DataTable().destroy();
    //         $("#view-employee-leave-history-table").empty();
            
    //         for (var i=0;i<data.length;i++) {
    //             var dateFormat = moment(data[i].DateApplied,"YYYYMMDD").format("MM/DD/YYYY");
    //             $("#view-employee-leave-history-table").append("<tr><td>"+dateFormat+"</td><td>"+data[i].TypeOfLeave+"</>")
    //             // var statusColor;
                
    //             /*if (data[i].Status == "Pending") {
    //                 statusColor = "<span class='badge badge-warning'>"+data[i].Status+"</span>";
    //             } else if (data[i].Status == "Approved") {
    //                 statusColor = "<span class='badge badge-success'>"+data[i].Status+"</span>";
    //             } else {
    //                 statusColor = "<span class='badge badge-danger'>"+data[i].Status+"</span>";
    //             }*/

    //             var row =   '<tr>'+
    //                         '<td>'+dateFormat+'</td>'+
    //                         '<td>'+data[i].TypeOfLeave+'</td>'+
    //                         '<td>'+data[i].NumberOfDays+' Days</td>'+
    //                         //'<td style="color:'+statusColor+'">'+data[i].Status+'</td>'+
    //                         '</tr>';
    //             $("#view-employee-leave-history-table").append(row);
    //         };
    //         $('#view-employee-leave-history-table').DataTable({"bSort": false});
    //     },
    //     error:function(){alert("Error!");}
    // })
// });

// $(".back-icon").on("click",function(){

// })

 });
      
