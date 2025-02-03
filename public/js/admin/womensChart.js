$(document).ready(function() {
    const currentYear = new Date().getFullYear();
    const yearSelect = document.getElementById('yearSelect');
    if (yearSelect) {
        for (let year = 1990; year <= currentYear; year++) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
        const options = Array.from(yearSelect.options).slice(1);
        yearSelect.innerHTML = ""; 
        options.reverse().forEach((option) => yearSelect.appendChild(option)); 
        displayWomenChart(yearSelect, currentYear);
    }
});
function displayWomenChart(year = null) { 
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year ;
    const backgroundColors = [
        "rgba(230, 25, 75, 0.6)",    // Red
        "rgba(60, 180, 75, 0.6)",    // Green
        "rgba(255, 225, 25, 0.6)",   // Yellow
        "rgba(0, 130, 200, 0.6)",    // Blue
        "rgba(245, 130, 48, 0.6)",   // Orange
        "rgba(145, 30, 180, 0.6)",   // Purple
        "rgba(70, 240, 240, 0.6)",   // Cyan
        "rgba(240, 50, 230, 0.6)",   // Magenta
        "rgba(210, 245, 60, 0.6)",   // Lime
        "rgba(250, 190, 212, 0.6)",  // Pink
        "rgba(0, 128, 128, 0.6)",    // Teal
        "rgba(220, 190, 255, 0.6)",  // Lavender
    ];
    let womens_chart;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("womens_chart").getContext("2d");
    const createChart = (year, yearData) => {
        if (!yearData || yearData.length === 0) {
            console.log("No data available for the selected year.");
            return;
        }
        const monthOrder = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const barangayNames = [...new Set(yearData.map(item => item.name))];
        const groupedData = {};
        yearData.forEach(item => {
            if (!groupedData[item.month]) {
                groupedData[item.month] = {};
            }
            groupedData[item.month][item.name] = item.population;
        });
        
        const sortedMonths = Object.keys(groupedData).sort(
            (a, b) => monthOrder.indexOf(a) - monthOrder.indexOf(b)
        );
        const datasets = sortedMonths.map((month, index) => ({
            label: month, 
            data: barangayNames.map(name => groupedData[month][name] || 0), 
            backgroundColor: backgroundColors[index % backgroundColors.length],
        }));
        const chartHeight = Math.max(400, yearData.length * 40); 
        document.getElementById("womens_chart").height = chartHeight;
        if (womens_chart) womens_chart.destroy();
        console.log('year ', year);
        womens_chart = new Chart(ctx, {
            type: 'bar',
            data: { labels: barangayNames, datasets: datasets,},
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false,
                plugins: { 
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: `Women in Reproductive Ages (${year})`,
                        font: { size: 24 },
                    },
                    zoom: {
                        pan: { enabled: true, mode: 'xy' },
                        zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'y' },
                    },
                },
                scales: {
                    x: { title: { display: true, text: 'Counts', font: { style: 'italic', size: 16 } }, stacked: true, },
                    y: { title: { display: true, text: 'Barangays', font: { style: 'italic', size: 16 } }, beginAtZero: true, stacked: true, }
                },
            },
        });
    };

    let url = window.userType === '0' ? '/admin/get_dashboard_info' : '/admin-midwife/get_dashboard_info';
    function reqData(selectedYear) {
        $.ajax({
            url: url,
            method: "GET",
            data: { year: selectedYear},
            success: function (res) {
                createChart(selectedYear, res.yearData); 
            }
        });
    }
    reqData(currentYear);
    sendYear.addEventListener("change", (e) => {
        const selectedYear = e.target.value;
        reqData(selectedYear);
    });
  
    document.getElementById("resetZoomBtn1").addEventListener("click", function () {
        if (womens_chart) womens_chart.resetZoom();
    });
}