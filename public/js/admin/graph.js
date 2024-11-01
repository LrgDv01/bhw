$(document).ready(function() {
  const currentYear = new Date().getFullYear();
  const startYear = currentYear - 10; // Change this value to adjust the range
  const $yearSelect = $('#yearSelect');

  for (let year = currentYear; year >= startYear; year--) {
      $yearSelect.append(new Option(year, year));
  }
  // Check element 
  let graph = $("#monthlyChart");
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
let monthlyChart; // Declare a variable to store the chart instance
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

        data.forEach((item) => {
            labels.push(
                `${item.year}-${String(item.month).padStart(2, "0")}`
            );
            approvedCounts.push(item.approved_count);
            rejectedCounts.push(item.rejected_count);
        });

        const ctx = $("#monthlyChart")[0].getContext("2d");
        // Destroy the previous chart instance if it exists
        if (monthlyChart) {
          monthlyChart.destroy();
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
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    },
  });
}