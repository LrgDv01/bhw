import { yearFilter } from "./utils/filter.js";

function displayChildChart(year = null) {
    const currentYear = new Date().getFullYear();
    let sendYear = year == null ? currentYear : year;

    const chartContainer = document.getElementById("deworming_chart");
    const insightContainer = document.getElementById("insight_container"); 
    const forecastContainer = document.getElementById("forecast_chart");
    const forecastInsightContainer = document.getElementById("forecast_insight_container"); 

    if (!chartContainer || !insightContainer || !forecastContainer) {
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

        const highestText = highestGroups.map(g => g.label).join(", ");
        const lowestText = lowestGroups.map(g => g.label).join(", ");

        let insightText = "";

        if (highestValue === 0 || highestValue <= 0.01) {
            insightText = "No significant data available for deworming beneficiaries.";
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

        const sliceColors = ["#36a2eb", "#ffce56", "#4bc0c0", "#9966ff"];

        let totalPopulation = Object.values(dewormingAgeRanges).reduce((sum, count) => sum + count, 0);

        const dataPoints = Object.keys(dewormingAgeRanges).map((ageRange, index) => {
            let count = parseFloat(dewormingAgeRanges[ageRange]);
            let percentage = totalPopulation > 0 ? ((count / totalPopulation) * 100).toFixed(2) : 0;

            return {
                label: ageRange,
                y: count > 0 ? parseFloat(percentage) : 0.01,
                color: sliceColors[index % sliceColors.length]
            };
        });

        createInsight(dataPoints);

        const chart = new CanvasJS.Chart("deworming_chart", {
            animationEnabled: true,
            title: { text: `Deworming Beneficiaries by Age (${year})` },
            toolTip: { enabled: true, shared: true, content: "{label}: {y}%" },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.00\"%\"",
                indexLabel: "{label} : {y}",
                dataPoints: dataPoints
            }]
        });

        chart.render();
      
    };

    function createForecastChart(historicalData) {
        if (!historicalData || Object.keys(historicalData).length === 0) {
            insightContainer.innerHTML += "<br>No historical data available for forecasting.";
            return;
        }
    
        let forecastData = [];
        Object.keys(historicalData).forEach(year => {
            let total = Object.values(historicalData[year]).reduce((sum, count) => sum + count, 0);
            forecastData.push({ x: new Date(year, 0), y: total });
        });
    
        let movingAvg = forecastData.slice(-3).reduce((sum, d) => sum + d.y, 0) / 3;
        let nextYear = parseInt(Object.keys(historicalData).pop()) + 1;
        forecastData.push({ x: new Date(nextYear, 0), y: movingAvg });
    
        const forecastChart = new CanvasJS.Chart("forecast_chart", {
            animationEnabled: true,
            title: { text: "Deworming Forecast (Next Year Projection)" },
            axisX: { valueFormatString: "YYYY", title: "Dates" },
            axisY: { title: "Counts", includeZero: false },
            data: [{
                type: "line",
                markerSize: 10,
                toolTipContent: "{x}: {y}",
                dataPoints: forecastData
            }]
        });
    
        forecastChart.render();
    
        let lastYear = forecastData[forecastData.length - 2]?.y || 0;  // Last recorded year's data
        let nextYearForecast = movingAvg.toFixed(2);  // Predicted value for next year
        let trendType = movingAvg > lastYear ? "growth" : movingAvg < lastYear ? "decline" : "stability";
    
        // Find highest and lowest age groups in the current year
        let currentYear = Object.keys(historicalData).pop();
        let currentYearData = historicalData[currentYear] || {};
        let sortedAgeGroups = Object.entries(currentYearData).sort((a, b) => b[1] - a[1]);
        let highestGroup = sortedAgeGroups.length > 0 ? sortedAgeGroups[0][0] : "N/A";
        let lowestGroup = sortedAgeGroups.length > 1 ? sortedAgeGroups[sortedAgeGroups.length - 1][0] : "N/A";
    
        // Handle missing or limited data
        let dataYears = Object.keys(historicalData);
        let dataCoverage = dataYears.length;
        let dataInsight = dataCoverage === 0
            ? "No historical data available for accurate forecasting."
            : dataCoverage === 1
                ? "Limited data available, forecast may not be reliable."
                : `Data available from <strong>${dataYears[0]}</strong> to <strong>${dataYears[dataYears.length - 1]}</strong>.`;
    
        // Generate insight based on forecast trend
        let forecastInsight = "";
        if (movingAvg > lastYear * 1.2) {
            forecastInsight = "The forecast predicts a substantial increase in deworming beneficiaries.";
        } else if (movingAvg > lastYear * 1.05) {
            forecastInsight = "A gradual rise in deworming beneficiaries is expected.";
        } else if (Math.abs(movingAvg - lastYear) <= lastYear * 0.05) {
            forecastInsight = "The forecast suggests a stable trend.";
        } else if (movingAvg < lastYear * 0.95) {
            forecastInsight = "A slight decline in deworming beneficiaries is predicted.";
        } else if (movingAvg < lastYear * 0.8) {
            forecastInsight = "A significant drop in deworming beneficiaries is forecasted.";
        }
    
        // Handling Age Group Trends
        let tiedGroups = [];
        let maxValue = Math.max(...Object.values(currentYearData));
        Object.entries(currentYearData).forEach(([group, count]) => {
            if (count === maxValue) tiedGroups.push(group);
        });
    
        if (tiedGroups.length > 1) {
            forecastInsight += ` Forecasts indicate that <strong>${tiedGroups.join(" and ")}</strong> will have similar high participation levels.`;
        } else {
            forecastInsight += ` The forecast predicts that <strong>${highestGroup}</strong> will continue to have the highest number of beneficiaries.`;
        }
    
        // Combining insights
        let insightText = `
            <strong>Insights:</strong><br>
            - The forecast predicts <strong>${nextYearForecast}</strong> beneficiaries next year.<br>
            - Past trends show a <strong>${trendType}</strong> in deworming beneficiaries.<br>
            - The highest age group this year was <strong>${highestGroup}</strong>.<br>
            - The lowest age group this year was <strong>${lowestGroup}</strong>.<br>
            - ${forecastInsight}<br>
            - ${dataInsight}
        `;
    
        forecastInsightContainer.innerHTML = insightText;
    }
    

    let url = window.userType === '0' ? '/admin/get_dashboard_info' : '/admin-midwife/get_dashboard_info';
    function reqData(selectedYear) {
        $.ajax({
            url: url,
            method: "GET",
            data: { year: selectedYear },
            success: function (res) {
                createChart(selectedYear, res.dewormingAgeRanges);
                createForecastChart(res.historicalDewormingData);
                console.log('historicalDewormingData', res.historicalDewormingData);
            },
            error: function () {
                console.error("Failed to fetch data.");
                insightContainer.innerHTML = `<p>Error loading data. Please try again later.</p>`;
                forecastInsightContainer.innerHTML = `<p>Error loading data. Please try again later.</p>`;  
            }
        });
    }

    reqData(currentYear);
    sendYear.addEventListener("change", (e) => reqData(e.target.value));
}


$(document).ready(function () {
    const yearSelect = new yearFilter();
    displayChildChart(yearSelect);
});


