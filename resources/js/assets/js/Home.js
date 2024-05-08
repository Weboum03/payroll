$(document).ready(function () {
 
  $(".close").click(function(){
     $("#PayrollBatch-modal").modal('hide');
     $("#Compare").modal('hide');
     $("#noticPrd-Table-list2").modal('hide');
     
  });

  $(".save").on('click',function(){
    window.location.href="../HTML/PayrollBatchform.html"
  })
  let finYearDropdown = $("#finYearDropdown").append('<select id="finYearDropdown1" class="FinanYear" style="height: 30.83px;width: 150px;font-size: 12px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="2023-2024">2023 - 2024</option><option value="value2">Option 2</option></select>');
  $("#Financial-year-dropdown").append(finYearDropdown);

// Get the current date
const currentDate = new Date();

// Array of month names
const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

// Get the current month (returns a number between 0 and 11)
const currentMonthIndex = currentDate.getMonth();

// Get the month abbreviation using the current month index
const currentMonthAbbreviation = monthNames[currentMonthIndex];

// Get the current year
const currentYear = currentDate.getFullYear();

// Combine the current month abbreviation and year
const formattedDate = `${currentMonthAbbreviation} ${currentYear}`;

// Append the formatted date to the label
$('label[for="Year-Payrool-Batch"]').append(formattedDate);


  function generateMonths() {
    const months = [];
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    for (let year = 2023; year <= 2024; year++) {
      for (let month = 1; month <= 12; month++) {
        months.push({ year, month });
      }
    }
    return months;
  }


$("#Compare-Data-Financi-Year").on('click',function(){
   window.location.href ="../HTML/FinancialYearCompareTable.html";
});
$("#Compare-Data-Years").on('click',function(){
   window.location.href ="../HTML/YearsCompareTable.html";
});
$("#Compare-Data-Months-Year").on('click',function(){
   window.location.href ="../HTML/MonthsCompareTable.html";
});




const data = [253, 5];
const payrollchartData = {
   labels: [`Payroll Processed ${data[0]}`, `Pending count ${data[1]}`],
   data: data,
};

 const counter3 = {
   id:"counter",
   beforeDraw(chart, args, options) { 
       const {ctx ,chartArea:{top,right,bottom,left,width,height}}=chart;
       ctx.save()
       const yCenter =(height/2)+top+15;
       ctx.font = '15px monospace'
       ctx.fillStyle = 'black'
       ctx.fillText('258','61',yCenter)
 }
}
 const counter4 = {
   id:"counter",
   beforeDraw(chart, args, options) { 
       const {ctx ,chartArea:{top,right,bottom,left,width,height}}=chart;
       ctx.save()
       const yCenter =(height/2)+top-7;
       ctx.font = '10px monospace'
       ctx.fillStyle = 'black'
       ctx.fillText('Total Employee','35',yCenter)
 }
}

const payrollChart = document.querySelector(".payrolldata-chart1");
const ul = document.querySelector(".programming-stats4 .details ul");

new Chart(payrollChart, {
 type: "doughnut",
 data: {
   labels: payrollchartData.labels,
   datasets: [
     {
       data: payrollchartData.data,
       backgroundColor: [     // Set background color for each label
       '#0492F5',   // Background color for "5 days absence"
       '#DAE1F3'    // Background color for "900 working days"
   ],
   cutout:'70%',
     },
    
   ],
   
 },
 options: {
   borderRadius: 2,
   hoverBorderWidth: 0,
   plugins: {
     legend: {
       display: false,
     },
     tooltip: {
      callbacks: {
        label: function(context) {
          return context.label; // Display only the label, without associated data
        }
      }
    }
   },
   rotation: 90,
 },
 plugins: [counter4,counter3]
});

const populateUl = () => {
   payrollchartData.labels.forEach((l, i) => {
     let div = document.createElement("div")
     let div1 = document.createElement("div")
   let li = document.createElement("li");
   div.innerHTML =l
   div.innerHTML = l;
   ul.appendChild(li);
   li.appendChild(div1);
   li.appendChild(div);

   li.style.display = "flex"
   div1.textContent = "";
   div1.style.display = "flex"
   div1.style.width = "21px"
   div1.style. backgroundColor = "#6666b1"
   div1.style.height = "21px"
   div1.style.borderRadius = "28%"
   div1.style.backgroundColor = i % 2 === 0 ? "#0492F5" : "#DAE1F3";
 });
};

populateUl();








});