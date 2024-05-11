// reload page in generate report 
$(document).ready(function() {

        $('#reset').on('click', function(){
            // Reload the page on reset button click
            location.reload();

        });

});


$(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })

  

  // Function to toggle and persist the theme
  function toggleTheme() {
      const body = document.body;
      if (body.classList.contains('dark-mode')) {
          body.classList.remove('dark-mode');
          body.classList.add('light-mode');
          localStorage.setItem('theme', 'light');
      } else {
          body.classList.remove('light-mode');
          body.classList.add('dark-mode');
          localStorage.setItem('theme', 'dark');
      }
  }
  // Add a click event listener to the theme toggle button
  const themeToggle = document.getElementById('theme-toggle');
  themeToggle.addEventListener('click', toggleTheme);

  // Retrieve the user's theme preference from local storage
  const savedTheme = localStorage.getItem('theme');
  // Set the theme based on the user's preference
  if (savedTheme === 'dark') {
      document.body.classList.add('dark-mode');
  } else if (savedTheme === 'light') {
      document.body.classList.add('light-mode');
  }
  
  function confirmDelete(url) {
      if (confirm('Delete?')) {
          // Create a hidden form and submit it programmatically
          var form = document.createElement('form');
          form.action = url;
          form.method = 'POST';
          form.innerHTML = '@csrf @method("delete")';
          document.body.appendChild(form);
          form.submit();
      }
  }
  
  $(document).ready(function() {
      $("#generate_pdf").on("click", function() {
          // Submit the form directly when the "Generate PDF" button is clicked
          $("#exportForm").submit();
      });
      $('#reset').on('click', function() {
          // Reload the page on reset button click
          location.reload();
      });
  });
  
  document.addEventListener('DOMContentLoaded', function() {
      var filterType = document.getElementById('filter_type');
      var yearFilter = document.getElementById('yearFilter');
      var dateFilter = document.getElementById('dateFilter');
      filterType.addEventListener('change', function() {
          if (filterType.value === 'year') {
              yearFilter.style.display = 'block';
              dateFilter.style.display = 'none';
          } else {
              yearFilter.style.display = 'none';
              dateFilter.style.display = 'block';
          }
      });
  });
  
  document.addEventListener('DOMContentLoaded', function() {
      var isTextSelected = false;
      $('body').on('mousedown', function(event) {
          isTextSelected = false;
      });
      $('body').on('mouseup', function(event) {
          isTextSelected = (window.getSelection().toString() !== '');
      });
      $('tbody').on('click', 'tr.clickable-row', function(event) {
          // Check if the event target is not an input field to avoid handling clicks on inputs
          if (!$(event.target).is('input')) {
              // Prevent right-click default behavior
              if (event.button === 2 || isTextSelected) {
                  event.preventDefault();
                  return;
              }
              var url = $(this).data('href');
              if (url) {
                  window.location = url;
              }
          }
      });
  });

// for delete

function confirmDelete(unitId) {
  if (confirm("Are you sure you want to delete this unit?")) {
      // Get the delete form
      var deleteForm = document.getElementById('delete-form-' + unitId);

      // Submit the form
      deleteForm.submit();
  }
}