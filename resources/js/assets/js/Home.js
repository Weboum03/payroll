// const ctx = document.getElementsByClassName("dashboarddata-chart1");
// const ctx1 = document.getElementsByClassName("dashboarddata-chart2");
// $(document).ready(function () {

//     $("#headingFour").on("click",function(){
//         window.location.href= "../HTML/Home.html";
//     });

//     let finYearDropdown = $("#finYearDropdown").append('<select id="finYearDropdown1" class="FinanYear" style="height: 30.83px;width: 150px;font-size: 12px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="2023-2024">2023 - 2024</option><option value="value2">Option 2</option></select>');
//     $("#Financial-year-dropdown").append(finYearDropdown);

    

    
//     const lables = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar'];
//         const bardata = {
//           labels: lables,
//           datasets: [
//             {
//                 label: 'Employee Count',
//                 data: Array.from({ length: lables.length }, () => Math.floor(Math.random() * 300)), // Generate random data
//                 borderColor: '#0492F5', // Use color name or hex code directly
//                 backgroundColor: '#0492F5', // Use rgba for transparency
//             }
//           ]
//         };

//     new Chart(ctx, {
//     type: 'bar',
//     data: bardata,
//     options: {
//         responsive: true,
//         plugins: {
//             legend: {
//                 labels: {
//                     usePointStyle: true,
//                     pointStyle: 'circle',
//                 },
//                 position: 'top'
//             },
//             title: {
//                 display: true,
//             }
//         },
//         scales: {
//           y: {
//             beginAtZero: true,
//             ticks: {
//               stepSize: 75,
//               suggestedMax: 300
//             }
//           }
//         }
//     }
// });



//         const verdata = {
//           labels: lables,
//           datasets: [
//             {
//                 label: 'New Starter',
//                 data: Array.from({ length: lables.length }, () => Math.floor(Math.random() * 300)), // Generate random data
//                 borderColor:'#008000', // Use color name or hex code directly
//                 backgroundColor:'#008000', // Use rgba for transparency
//                 borderWidth: 1
//             },
            
//                 {
//                   label: 'Leaver',
//                   data:  Array.from({ length: lables.length }, () => Math.floor(Math.random() * 300)), // Generate random data
//                   borderColor: '#ea3c83', // Use color name or hex code directly
//                   backgroundColor:'#ea3c83', // Use rgba for transparency
//                   borderWidth: 1
//                 },
//                 {
//                   label: 'On Notice Period',
//                   data:  Array.from({ length: lables.length }, () => Math.floor(Math.random() * 300)), // Generate random data
//                   borderColor: '#c406c4', // Use color name or hex code directly
//                   backgroundColor: '#c406c4', // Use rgba for transparency
//                   borderWidth: 1
                 
//                 }
//           ]
//         };

       

//        new Chart(ctx1, {
//             type: 'line',
//             data: verdata,
//             options: {
//               responsive: true,
//               plugins: {
//                 legend: {
//                     labels: {
//                         usePointStyle: true,
//                         pointStyle: 'circle',
//                     },
//                   position: 'top',
//                 },
//                 title: {
//                   display: true,
//                 }
//               }
//             },
//             scales: {
//                 y: {
//                   beginAtZero: true,
//                   ticks: {
//                     stepSize: 3,
//                     suggestedMax: 12
//                   }
//                 }
//               }
//           });

  
// });




$(document).ready(function () {

  let finYearDropdown = $("#finYearDropdown").append('<select id="finYearDropdown1" class="FinanYear" style="height: 30.83px;width: 150px;font-size: 12px;font-weight: 500;font-family: sans-serif;padding-left: 9px;border: none;border-radius: 5px;"><option value="2023-2024">2023 - 2024</option><option value="value2">Option 2</option></select>');
  $("#Financial-year-dropdown").append(finYearDropdown);



  
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

// Function to append months to the pagination
function appendMonths() {
   const months = generateMonths();
   const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
   const $div = $('.months-years');
   months.forEach(({ year, month }) => {
       const $li = $('<li>').addClass('page-item');
       const $a = $('<a>').addClass('page-link').attr('href', '#').text(`${String(monthNames[month - 1]).padStart(2, '0')}-${year}`);
       $li.append($a);
       $div.append($li); // Append list item to the div with class 'months-years'
       $a.css('color','#A8A8A8')
   });
}
// Call the function to append months
appendMonths();




const data = [253, 5];

const payrollchartData = {
   labels: [`Total employee ${data[0]}`, `Pending count ${data[1]}`],
   data: data,
};

 const counter3 = {
   id:"counter",
   beforeDraw(chart, args, options) { 
       const {ctx ,chartArea:{top,right,bottom,left,width,height}}=chart;
       ctx.save()
       const yCenter =(height/2)+top+4;
       ctx.font = '15px monospace'
       ctx.fillStyle = 'black'
       ctx.fillText('253','61',yCenter)
 }
}

const payrollChart = document.querySelector(".payrolldata-chart");
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
 plugins: [counter3]
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