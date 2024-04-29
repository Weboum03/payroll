$(document).ready(function () {
    let Approvedhistory = new DataTable('#Approvedleave-historyTable', {
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

    $("#Approvedleave-historyTable_filter").append('<select id="dropdown1" class="lastActivities" style="height: 30.83px;  width: 225px;  font-size: 13px;  font-weight: bold;  font-family: sans-serif;  padding-left: 13px;  border: none; border-radius: 5px; float: left;"><option value="BulkAction">10 Last activities</option><option value="value2">Option 2</option></select>');
    // $("#Approvedleave-historyTable_paginate").append('<div class="pagination-div"><a class="paginate_button previous disabled" aria-controls="Approvedleave-historyTable" data-dt-idx="0" tabindex="-1" id="Approvedleave-historyTable_previous">Previous</a><span><a class="paginate_button current" aria-controls="Approvedleave-historyTable" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="Approvedleave-historyTable" data-dt-idx="2" tabindex="-1" id="Approvedleave-historyTable_next">Next</a></div>');
    // $("#Approvedleave-historyTable_paginate").append('<div>hello</div>');
});


