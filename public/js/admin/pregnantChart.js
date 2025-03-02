import { yearFilter } from "./utils/filter.js";

function displayWomenChart(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#6ce5e8",
        "15-19": "#41b8d5",
        "20-49": "#2d8bba"
    };
    let pregnant_chart;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("pregnant_chart").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            const datasets = Object.keys(ageRanges).map((ageGroup) => {
                const monthlyCounts = monthOrder.map((month) => {
                    return ageRanges[ageGroup].filter(item => item.month === month).length;
                });
                return {
                    // label: ageGroup + ' Y/O',
                    label: 'Trimester',
                    data: monthlyCounts,
                    backgroundColor: backgroundColors[ageGroup],
                };
            });

            const chartHeight = Math.max(400, yearData.length * 40);
            document.getElementById("pregnant_chart").height = chartHeight;
            if (pregnant_chart) pregnant_chart.destroy();
            pregnant_chart = new Chart(ctx, {
                type: 'line',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Total Pregnant Women Ages by Group (${year})`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Month', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Count of Women', font: { size: 16 } }, beginAtZero: true, stacked: false }
                    },
                },
            });
        }
    };

    let url = window.userType === '0' ? '/admin/get_dashboard_info' 
            : window.userType === '1' ? '/admin-midwife/get_dashboard_info' 
            : '/bhw/get_dashboard_info';
    function reqData(selectedYear) {
        $.ajax({
            url: url,
            method: "GET",
            data: { year: selectedYear },
            success: function (res) {
                createChart(selectedYear, res.yearDataWithMonth, res.womenAgeRanges);
            }
        });
    }
    reqData(currentYear);

    sendYear.addEventListener("change", (e) => {
        const selectedYear = e.target.value;
        reqData(selectedYear);
    });

    document.getElementById("pregnantResetZoomBtn").addEventListener("click", function () {
        if (pregnant_chart) pregnant_chart.resetZoom();
    });
}

$(document).ready(function() {
    const yearSelect = new yearFilter();
    displayWomenChart(yearSelect);
});

