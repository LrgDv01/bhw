import { yearFilter } from "../utils/filter.js";

function displayWomenChart1(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "2d8bba": "#2d8bba",
    };
    let distributionImmunizationVaccine;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("distributionImmunizationVaccine").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "PCV1", "PCV2", "PCV3", "BCG", "Penta 1", "Penta 2", "Penta 3", "OPV1",
                "OPV2", "OPV3", "IPV", "Vitamin A", "Measles", "MMR"
            ];
            const datasets = Object.keys(ageRanges).map((ageGroup) => {
                const monthlyCounts = monthOrder.map((month) => {
                    return ageRanges[ageGroup].filter(item => item.month === month).length;
                });
                return {
                    // label: ageGroup + ' Y/O',
                    data: monthlyCounts,
                    backgroundColor: backgroundColors[ageGroup],
                };
            });

            const chartHeight = Math.max(400, yearData.length * 40);
            document.getElementById("distributionImmunizationVaccine").height = chartHeight;
            if (distributionImmunizationVaccine) distributionImmunizationVaccine.destroy();
            distributionImmunizationVaccine = new Chart(ctx, {
                type: 'bar',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'y', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Distribution of Immunization by Vaccine Type`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Count per Vaccine Type', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Vaccine Type', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("distributionImmunizationVaccineResetZoomBtn").addEventListener("click", function () {
        if (distributionImmunizationVaccine) distributionImmunizationVaccine.resetZoom();
    });
}

function displayWomenChart2(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#2d8bba",
    };
    let distributionImmunizationAge;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("distributionImmunizationAge").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "0-6 months", "7-12 months", "1-2 Y/O", "3-5 Y/O"
            ];
            const datasets = Object.keys(ageRanges).map((ageGroup) => {
                const monthlyCounts = monthOrder.map((month) => {
                    return ageRanges[ageGroup].filter(item => item.month === month).length;
                });
                return {
                    // label: ageGroup + ' Y/O',
                    data: monthlyCounts,
                    backgroundColor: backgroundColors[ageGroup],
                };
            });

            const chartHeight = Math.max(400, yearData.length * 40);
            document.getElementById("distributionImmunizationAge").height = chartHeight;
            if (distributionImmunizationAge) distributionImmunizationAge.destroy();
            distributionImmunizationAge = new Chart(ctx, {
                type: 'bar',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Distribution of Immunization by Age Group`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Vaccine by Age', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Count per Vaccine Type', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("distributionImmunizationAgeResetZoomBtn").addEventListener("click", function () {
        if (distributionImmunizationAge) distributionImmunizationAge.resetZoom();
    });
}


$(document).ready(function() {
    const yearSelect = new yearFilter();
    displayWomenChart1(yearSelect);
    displayWomenChart2(yearSelect);
});

