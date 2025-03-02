import { yearFilter } from "../utils/filter.js";

function displayWomenChart1(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#2d8bba",
    };
    let prenatalAttendance;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("prenatalAttendance").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "Children (0-5)", "Youth (6-17)", "Adult (18-59)", "Senior Citizen (60+)"
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
            document.getElementById("prenatalAttendance").height = chartHeight;
            if (prenatalAttendance) prenatalAttendance.destroy();
            prenatalAttendance = new Chart(ctx, {
                type: 'line',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Prenatal Check-up Attendance Over Time`,
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
                        y: { title: { display: true, text: 'Total Check-ups', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("prenatalAttendanceResetZoomBtn").addEventListener("click", function () {
        if (prenatalAttendance) prenatalAttendance.resetZoom();
    });
}

function displayWomenChart2(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#2d8bba",
    };
    let totalPregnantWomen;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("totalPregnantWomen").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "Heart Disease", "Tuberculosis", "Hypertension", "Diabetes", "Asthma"
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
            document.getElementById("totalPregnantWomen").height = chartHeight;
            if (totalPregnantWomen) totalPregnantWomen.destroy();
            totalPregnantWomen = new Chart(ctx, {
                type: 'bar',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Total Pregnant Women by Age Group`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Age Group', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Total Check-ups', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("totalPregnantWomenResetZoomBtn").addEventListener("click", function () {
        if (totalPregnantWomen) totalPregnantWomen.resetZoom();
    });
}

function displayWomenChart3(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const backgroundColors = {
        "10-14": "#2d8bba",
    };
    let supplementation;
    Chart.register(ChartZoom);
    const ctx = document.getElementById("supplementation").getContext("2d");

    const createChart = (year, yearData, ageRanges) => {
        if (!year && (!yearData || yearData.length === 0)) {
            console.log("No data available for the selected year.");
            return;
        } else{
            const monthOrder = [
                "Heart Disease", "Tuberculosis", "Hypertension", "Diabetes", "Asthma"
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
            document.getElementById("supplementation").height = chartHeight;
            if (supplementation) supplementation.destroy();
            supplementation = new Chart(ctx, {
                type: 'bar',
                data: { labels: monthOrder, datasets: datasets },
                options: {
                    indexAxis: 'x', responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Supplemnetation Given Over Time`,
                            font: { size: 24 },
                            color: 'black'
                        },
                        zoom: {
                            pan: { enabled: true, mode: 'xy' },
                            zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: 'x' },
                        },
                    },
                    scales: {
                        x: { title: { display: true, text: 'Total Supplements Given', font: { size: 16 } }, stacked: false },
                        y: { title: { display: true, text: 'Month', font: { size: 16 } }, beginAtZero: true, stacked: false }
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

    document.getElementById("supplementationResetZoomBtn").addEventListener("click", function () {
        if (supplementation) supplementation.resetZoom();
    });
}

function displayWomenChart4(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;
    const chartContainer = document.getElementById("tetanusImmunization");
    const insightContainer = document.getElementById("insight_container"); 
 
    if (!chartContainer || !insightContainer) {
        console.error("Some container not found.");
        return;
    }

    const createInsight = (dataPoints) => {
        if (!dataPoints || dataPoints.length === 0) {
            insightContainer.innerHTML = `<p>No data available for the selected filter.</p>`;
            return;
        }
        const sortedData = [...dataPoints].sort((a, b) => b.y - a.y);
        const highestValue = sortedData[0].y;
        const lowestValue = sortedData[sortedData.length - 1].y;
        const highestGroups = sortedData.filter(dp => dp.y === highestValue);
        const lowestGroups = sortedData.filter(dp => dp.y === lowestValue);
        const highestText = highestGroups.map(g => g.label).join(" and ");
        const lowestText = lowestGroups.map(g => g.label).join(" and ");

        let insightText = "";
        if (highestValue === 0 || highestValue <= 0.01) {
            insightText = "No significant data available for the selected year.";
        }
        else if (highestGroups.length === 1 && lowestGroups.length === 1) {
            insightText = `
                The age group <b>${highestText}</b> has the highest percentage of deworming beneficiaries at <b>${highestValue}%</b>, 
                while <b>${lowestText}</b> has the lowest at <b>${lowestValue}%</b>. 
                This suggests that deworming efforts are focused more on <b>${highestText}</b>.
            `;
        }
        else if (highestGroups.length > 1 && lowestGroups.length === 1) {
            insightText = `
                The age groups <b>${highestText}</b> all have the highest percentage of deworming beneficiaries at <b>${highestValue}%</b>. 
                Meanwhile, the <b>${lowestText}</b> age group has the lowest at <b>${lowestValue}%</b>.
            `;
        }
        else if (highestGroups.length === 1 && lowestGroups.length > 1) {
            insightText = `
                The age group <b>${highestText}</b> has the highest percentage of deworming beneficiaries at <b>${highestValue}%</b>. 
                Meanwhile, the age groups <b>${lowestText}</b> all have the lowest percentage at <b>${lowestValue}%</b>.
            `;
        }
        else if (highestGroups.length > 1 && lowestGroups.length > 1) {
            insightText = `
                The age groups <b>${highestText}</b> have the highest percentage of deworming beneficiaries at <b>${highestValue}%</b>. 
                At the same time, the age groups <b>${lowestText}</b> have the lowest percentage at <b>${lowestValue}%</b>.
            `;
        }
        insightContainer.innerHTML = `<p>${insightText}</p>`;
    };

    const createChart = (year, dewormingAgeRanges) => {
        if (!dewormingAgeRanges || Object.keys(dewormingAgeRanges).length === 0) {
            console.log("No data available for the selected year.");
            insightContainer.innerHTML = `<p>No data available for the selected year.</p>`;
            return;
        }

        const sliceColors = ["#2f5f98", "#6ce5e8"];
        const noDataColor = '#7b7b7b';
        let totalPopulation = Object.values(dewormingAgeRanges).reduce((sum, count) => sum + count, 0);

        const dataPoints = Object.keys(dewormingAgeRanges).map((ageRange, index) => {
            let count = parseFloat(dewormingAgeRanges[ageRange]);
            let percentage = totalPopulation > 0 ? ((count / totalPopulation) * 100).toFixed(2) : 0;

            return {
                label: ageRange,
                y: count > 0 ? parseFloat(percentage) : 0.01,
                color: count == 0 ? noDataColor : sliceColors[index % sliceColors.length]
            };
        });

        // createInsight(dataPoints);

        const chart = new CanvasJS.Chart("tetanusImmunization", {
            animationEnabled: true,
            title: { text: `Tetanus Immunization Distribution by Age Group` },
            // toolTip: { enabled: true, shared: true, content: "{label}: {y}%" },
            data: [{
                type: "pie",
                startAngle: 240,
                // yValueFormatString: "##0.00\"%\"",
                // indexLabel: "{label} old : {y}",
                dataPoints: dataPoints
            }]
        });

        chart.render();
      
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
                createChart(selectedYear, res.dewormingAgeRanges);
            },
            error: function () {
                console.error("Failed to fetch data.");
                insightContainer.innerHTML = `<p>Error loading data. Please try again later.</p>`;
            }
        });
    }

    // reqData(currentYear);
    reqData('2023');

    sendYear.addEventListener("change", (e) => reqData(e.target.value));
}



$(document).ready(function() {
    const yearSelect = new yearFilter();
    displayWomenChart1(yearSelect);
    displayWomenChart2(yearSelect);
    displayWomenChart3(yearSelect);
    displayWomenChart4(yearSelect);
});

