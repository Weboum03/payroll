$(document).ready(function () {
    const attendancechartData = {
        labels: ["5 days absence", "900 working days"],
        data: [10,70],
      };
    const earnedchartData = {
        labels: ["10 days taken", "6 remaining"],
        data: [70,10],
      };

      const counter1 = {
        id:"counter",
        beforeDraw(chart, args, options) { 
            const {ctx ,chartArea:{top,right,bottom,left,width,height}}=chart;
            ctx.save()
            const yCenter =(height/2)+top+6;
            ctx.font = '15px monospace'
            ctx.fillStyle = 'black'
            ctx.fillText('70%','40',yCenter)
      }
    }


      const counter = {
        id:"counter",
        beforeDraw(chart, args, options) { 
            const {ctx ,chartArea:{top,right,bottom,left,width,height}}=chart;
            ctx.save()
            const yCenter =(height/2)+top+6;
            ctx.font = '15px monospace'
            ctx.fillStyle = 'black'
            ctx.fillText('10%','40',yCenter)
      }
    }
      const attendanceChart = document.querySelector(".attendance-chart");
      const ul = document.querySelector(".programming-stats .details ul");
      
      new Chart(attendanceChart, {
        type: "doughnut",
        data: {
          labels: attendancechartData.labels,
          datasets: [
            {
              data: attendancechartData.data,
              backgroundColor: [     // Set background color for each label
              '#2DB9F8',   // Background color for "5 days absence"
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
          },
        },
        plugins: [counter]
    });
      
      const populateUl = () => {
        attendancechartData.labels.forEach((l, i) => {
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
          div1.style.backgroundColor = i % 2 === 0 ? "#2DB9F8" : "#DAE1F3";
        });
      };
      
      populateUl();
    
      







      const eranedChart = document.querySelector(".earned-chart");
      const ul1 = document.querySelector(".programming-stats1 .details1 ul");
      new Chart(eranedChart, {
        type: "doughnut",
        data: {
          labels: earnedchartData.labels,
          datasets: [
            {
              data:earnedchartData.data,
              backgroundColor: [     // Set background color for each label
              '#2DB9F8',   // Background color for "5 days absence"
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
          },
        },
        plugins: [counter1]
      });

      const populateUll = () => {
        earnedchartData.labels.forEach((l, i) => {
            let div = document.createElement("div")
            let div1 = document.createElement("div")
          let li = document.createElement("li");
          div.innerHTML =l
          div.innerHTML = l;
          ul1.appendChild(li);
          li.appendChild(div1);
          li.appendChild(div);

          li.style.display = "flex"
          div1.textContent = "";
          div1.style.display = "flex"
          div1.style.width = "21px"
          div1.style. backgroundColor = "#6666b1"
          div1.style.height = "21px"
          div1.style.borderRadius = "28%"
          div1.style.backgroundColor = i % 2 === 0 ? "#2DB9F8" : "#DAE1F3";
        });
      };
      
      populateUll();



  
      // $("#input-valuses-accordOne").on('click',function(){
      //   $(this).css('backgroundColor', '#A8A8A8');
      // })
      // $("#input-valuses-accordTwo").on('click',function(){
      //   $(this).css('backgroundColor', '#A8A8A8');
      // })
      // $("#input-valuses-accordThree").on('click',function(){
      //   $(this).css('backgroundColor', '#A8A8A8');
      // })
      


      //FEB leave-table
      var globalHolidays = [];

      var holidaysDisabled = false;
      var currentDate = new Date(); // Get current date
      var currentYear = currentDate.getFullYear();
      var currentMonth = currentDate.getMonth() - 1;
      var startDate = currentYear + "-" + (currentMonth < 10 ? "0" : "") + currentMonth + "-01";

      // Calculate the number of days in the current month
      var daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
      var hp = new DayPilot.Scheduler("hp", {
        timeHeaders: [
          { groupBy: "Day", format: "dd" },
          { groupBy: "Day", format: "ddd" },
        ],
        scale: "Day",
        days: daysInMonth,
        startDate: startDate,
        treeEnabled: true,
        onBeforeCellRender: function (args) {
          (function highlightResourceHolidays() {
            var row = hp.rows.find(args.cell.resource);
            var holidays = row.data.holidays;
            if (!holidays) {
              return;
            }
            var item = holidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.cell.start, args.cell.end);
            });

          })();

          (function highlightGlobalHolidays() {
            var item = globalHolidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.cell.start, args.cell.end);
            });

            if (item) {
              args.cell.backColor = item.backColor;

              if (holidaysDisabled) {
                args.cell.disabled = true;
              }
            }
          })();
        },
        onBeforeTimeHeaderRender: function (args) {
          if (args.header.level === 1) {
            var item = globalHolidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.header.start, args.header.end);
            });

            if (item) {
              var start = new DayPilot.Date(item.start);
              var end = new DayPilot.Date(item.end).addDays(1);

              args.header.areas = [{ start: start, end: end, bottom: 0, height: 5 }];
            }
          }
        },
      });
      hp.resources = [
        {
          name: "Earned Leaves",
          id: "earnedLeaves",
          holidays: [{ start: "2024-02-11", end: "2024-02-11", backColor: "#2DB9F8" }],
        },
        {
          name: "Public Holidays",
          id: "publicHolidays",
          holidays: [{ start: "2024-02-08", end: "2024-02-08", backColor: "#2DB9F8" }],
        },
        { name: "Maternity", id: "maternity" },
        {
          name: "Vestibulum elementum",
          id: "vestibulumElementum",
          holidays: [{ start: "2024-02-14", end: "2024-02-14", backColor: "#2DB9F8" }],
        },
        {
          name: "Donec aliquet",
          id: "Donec aliquet",
          holidays: [{ start: "2024-02-17", end: "2024-02-17", backColor: "#2DB9F8" }],
        },
      ];

      hp.events.list = [];
      hp.weekStarts = 0;
      hp.init();



      //march leave-table
      var globalHolidays = [];

      var holidaysDisabled = false;
      var currentDate = new Date(); // Get current date
      var currentYear = currentDate.getFullYear();
      var currentMonth = currentDate.getMonth();
      var startDate = currentYear + "-" + (currentMonth < 10 ? "0" : "") + currentMonth + "-01";

      // Calculate the number of days in the current month
      var daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
      var ap = new DayPilot.Scheduler("ap", {
        timeHeaders: [
          { groupBy: "Day", format: "dd" },
          { groupBy: "Day", format: "ddd" },
        ],
        scale: "Day",
        days: daysInMonth,
        startDate: startDate,
        treeEnabled: true,
        onBeforeCellRender: function (args) {
          (function highlightResourceHolidays() {
            var row = ap.rows.find(args.cell.resource);
            var holidays = row.data.holidays;
            if (!holidays) {
              return;
            }
            var item = holidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.cell.start, args.cell.end);
            });

            if (item) {
              args.cell.backColor = item.backColor;
              if (holidaysDisabled) {
                args.cell.disabled = true;
              }
            }
          })();

          (function highlightGlobalHolidays() {
            var item = globalHolidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.cell.start, args.cell.end);
            });

            if (item) {
              args.cell.backColor = item.backColor;

              if (holidaysDisabled) {
                args.cell.disabled = true;
              }
            }
          })();
        },
        onBeforeTimeHeaderRender: function (args) {
          if (args.header.level === 1) {
            var item = globalHolidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.header.start, args.header.end);
            });

            if (item) {
              var start = new DayPilot.Date(item.start);
              var end = new DayPilot.Date(item.end).addDays(1);

              args.header.areas = [{ start: start, end: end, bottom: 0, height: 5 }];
            }
          }
        },
      });
      ap.resources = [
        {
          name: "Earned Leaves",
          id: "earnedLeaves",
          holidays: [{ start: "2024-03-11", end: "2024-03-11", backColor: "#2DB9F8" }],
        },
        {
          name: "Public Holidays",
          id: "publicHolidays",
          holidays: [{ start: "2024-03-08", end: "2024-03-08", backColor: "#2DB9F8" }],
        },
        { name: "Maternity", id: "maternity" },
        {
          name: "Vestibulum elementum",
          id: "vestibulumElementum",
          holidays: [{ start: "2024-03-14", end: "2024-03-14", backColor: "#2DB9F8" }],
        },
        {
          name: "Donec aliquet",
          id: "Donec aliquet",
          holidays: [{ start: "2024-03-17", end: "2024-03-17", backColor: "#2DB9F8" }],
        },
      ];

      ap.events.list = [];
      ap.weekStarts = 0;
      ap.init();
   

      //currnet mont leave=table
      var globalHolidays = [];

      var holidaysDisabled = false;
      var currentDate = new Date(); // Get current date
      var currentYear = currentDate.getFullYear();
      var currentMonth = currentDate.getMonth() + 1;
      var startDate = currentYear + "-" + (currentMonth < 10 ? "0" : "") + currentMonth + "-01";

      // Calculate the number of days in the current month
      var daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
      var dp = new DayPilot.Scheduler("dp", {
        timeHeaders: [
          { groupBy: "Day", format: "dd" },
          { groupBy: "Day", format: "ddd" },
        ],
        scale: "Day",
        days: daysInMonth,
        startDate: startDate,
        treeEnabled: true,
        onBeforeCellRender: function (args) {
          (function highlightResourceHolidays() {
            var row = dp.rows.find(args.cell.resource);
            var holidays = row.data.holidays;
            if (!holidays) {
              return;
            }
            var item = holidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.cell.start, args.cell.end);
            });

            if (item) {
              args.cell.backColor = item.backColor;
              if (holidaysDisabled) {
                args.cell.disabled = true;
              }
            }
          })();

          (function highlightGlobalHolidays() {
            var item = globalHolidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.cell.start, args.cell.end);
            });

            if (item) {
              args.cell.backColor = item.backColor;

              if (holidaysDisabled) {
                args.cell.disabled = true;
              }
            }
          })();
        },
        onBeforeTimeHeaderRender: function (args) {
          if (args.header.level === 1) {
            var item = globalHolidays.find(function (range) {
              var start = new DayPilot.Date(range.start);
              var end = new DayPilot.Date(range.end).addDays(1);
              return DayPilot.Util.overlaps(start, end, args.header.start, args.header.end);
            });

            if (item) {
              var start = new DayPilot.Date(item.start);
              var end = new DayPilot.Date(item.end).addDays(1);

              args.header.areas = [{ start: start, end: end, bottom: 0, height: 5 }];
            }
          }
        },
      });
      dp.resources = [
        {
          name: "Earned Leaves",
          id: "earnedLeaves",
          holidays: [{ start: "2024-04-11", end: "2024-04-11", backColor: "#2DB9F8" }],
        },
        {
          name: "Public Holidays",
          id: "publicHolidays",
          holidays: [{ start: "2024-04-08", end: "2024-04-08", backColor: "#2DB9F8" }],
        },
        { name: "Maternity", id: "maternity" },
        {
          name: "Vestibulum elementum",
          id: "vestibulumElementum",
          holidays: [{ start: "2024-04-14", end: "2024-04-14", backColor: "#2DB9F8" }],
        },
        {
          name: "Donec aliquet",
          id: "Donec aliquet",
          holidays: [{ start: "2024-04-17", end: "2024-04-17", backColor: "#2DB9F8" }],
        },
      ];

      dp.events.list = [];
      dp.weekStarts = 0;
      dp.init();
      
      $('.scheduler_default_corner div:nth-child(2)').text('TYPE');

      var elements = {
        disable: document.getElementById("disable"),
      };

      (function init() {
        elements.disable.addEventListener("change", function (ev) {
          holidaysDisabled = this.checked;
          console.log("holidaysDisabled", holidaysDisabled);
          hp.update();
          ap.update();
          dp.update();
        });
      })();


      
});