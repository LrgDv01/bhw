$(document).ready(function() {
  const currentYear = new Date().getFullYear();
  const startYear = currentYear - 10; // Change this value to adjust the range
  const $yearSelect = $('#yearSelect');

  for (let year = currentYear; year >= startYear; year--) {
      $yearSelect.append(new Option(year, year));
  }
  // Check element 
  let graph = $("#monthlyChart");
  let graph1 = $("#monthlyChart1");

  if(graph.length > 0) {
    // Optionally, you can add an event listener to handle the year selection
    $yearSelect.on('change', function() {
        const selectedYear = $(this).val();
        displayMonthlyGraph(selectedYear);
        // Fetch and update the chart data based on the selected year
    });
    displayMonthlyGraph(currentYear)
  }
  
});
let monthlyChart; 
let monthlyChart1; // Declare a variable to store the chart instance
function displayMonthlyGraph(year = null) { 
  const currentYear = new Date().getFullYear();
  let sendYear = year == null ? currentYear : year ;
  $.ajax({
    url: "/admin/dashboard/get_monthly_counts",
    method: "GET",
    data: { year: sendYear },
    success: function (data) {
        const labels = [];
        const approvedCounts = [];
        const pendingCounts = [];
        const rejectedCounts = [];

        const data1 = [
            { year: 2024, month: 1, approved_count: 12, rejected_count: 3 },
            { year: 2024, month: 2, approved_count: 15, rejected_count: 5 },
            { year: 2024, month: 3, approved_count: 20, rejected_count: 2 },
            { year: 2024, month: 4, approved_count: 18, rejected_count: 4 },
            { year: 2024, month: 5, approved_count: 25, rejected_count: 6 },
            { year: 2024, month: 6, approved_count: 30, rejected_count: 7 },
        ];
        

        data1.forEach((item) => {
            labels.push(
                `${item.year}-${String(item.month).padStart(2, "0")}`
            );
            approvedCounts.push(item.approved_count);
            rejectedCounts.push(item.rejected_count);
        });

        const ctx = $("#monthlyChart")[0].getContext("2d");
        const ctx1 = $("#monthlyChart1")[0].getContext("2d");
        // Destroy the previous chart instance if it exists
        if (monthlyChart) {
          monthlyChart.destroy();
        }
        if (monthlyChart1) {
            monthlyChart1.destroy();
          }

        monthlyChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Approved Requests",
                        data: approvedCounts,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1,
                    },
                    {
                        label: "Rejected Requests",
                        data: rejectedCounts,
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor: "rgba(255, 99, 132, 1)",
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                indexAxis: "y",
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                },
            },
        });


        monthlyChart1 = new Chart(ctx1, {
            type: "line",
            data: {
                labels: labels, // X-axis labels
                datasets: [
                    {
                        label: "Approved",
                        data: approvedCounts,
                        backgroundColor: "rgba(75, 192, 192, 0.2)", // Area under the line
                        borderColor: "rgba(75, 192, 192, 1)", // Line color
                        borderWidth: 2,
                        tension: 0.3, // Smoothing of the line
                        fill: true, // Fill the area under the line
                    },
                    {
                        label: "Rejected",
                        data: rejectedCounts,
                        backgroundColor: "rgba(255, 99, 132, 0.2)", // Area under the line
                        borderColor: "rgba(255, 99, 132, 1)", // Line color
                        borderWidth: 2,
                        tension: 0.3, // Smoothing of the line
                        fill: true, // Fill the area under the line
                    },
                ],
            },
            options: {
                responsive: true, // Responsive design
                plugins: {
                    legend: {
                        position: "top", // Position of the legend
                    },
                    tooltip: {
                        enabled: true, // Enable tooltips
                    },
                },
                scales: {
                    x: {
                        beginAtZero: false, // Don't force x-axis to start at 0
                    },
                    y: {
                        beginAtZero: true, // Start y-axis at 0
                    },
                },
            },
        });

    },
  });
}