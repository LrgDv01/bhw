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
                indexLabel: "{label} old : {y}",
                dataPoints: dataPoints
            }]
        });

        chart.render();
      
    };



    function generateForecastInsights(historicalData, forecastData, movingAvg) {
        if (!historicalData || Object.keys(historicalData).length === 0) {
            forecastInsightContainer.innerHTML = "<br>No historical data available for accurate forecasting.";
            return;
        }
    
        // Get the last and second-to-last months (for comparing)
        let monthKeys = Object.keys(historicalData).sort(); // Sort keys (YYYY-MM)
        let lastMonthKey = monthKeys.pop(); // Latest month
        let prevMonthKey = monthKeys.pop() || null; // Previous month (if exists)
    
        let lastMonthData = historicalData[lastMonthKey] || {};
        let prevMonthData = prevMonthKey ? historicalData[prevMonthKey] : {};
    
        // Total beneficiaries for last and previous months
        let lastMonthTotal = Object.values(lastMonthData).reduce((sum, count) => sum + count, 0);
        let prevMonthTotal = Object.values(prevMonthData).reduce((sum, count) => sum + count, 0);
    
        // Monthly trend analysis using lastMonthTotal
        let trendType = lastMonthTotal > prevMonthTotal ? "growth" 
                       : lastMonthTotal < prevMonthTotal ? "decline" 
                       : "stability";
    
        // Identify highest and lowest age groups for last month
        let sortedAgeGroups = Object.entries(lastMonthData).sort((a, b) => b[1] - a[1]);
        let highestGroup = sortedAgeGroups.length > 0 ? sortedAgeGroups[0][0] : "N/A";
        let lowestGroup = sortedAgeGroups.length > 1 ? sortedAgeGroups[sortedAgeGroups.length - 1][0] : "N/A";
    
        // Monthly trend insights (now using lastMonthTotal correctly)
        let forecastInsight = "";
        if (lastMonthTotal > prevMonthTotal * 1.2) {
            forecastInsight = "A substantial increase in deworming beneficiaries is expected.";
        } else if (lastMonthTotal > prevMonthTotal * 1.05) {
            forecastInsight = "A gradual rise in deworming beneficiaries is expected.";
        } else if (Math.abs(lastMonthTotal - prevMonthTotal) <= prevMonthTotal * 0.05) {
            forecastInsight = "The forecast suggests a stable trend.";
        } else if (lastMonthTotal < prevMonthTotal * 0.95) {
            forecastInsight = "A slight decline in deworming beneficiaries is predicted.";
        } else if (lastMonthTotal < prevMonthTotal * 0.8) {
            forecastInsight = "A significant drop in deworming beneficiaries is forecasted.";
        }
    
        // Check for age group ties
        let tiedGroups = [];
        let maxValue = Math.max(...Object.values(lastMonthData));
        Object.entries(lastMonthData).forEach(([group, count]) => {
            if (count === maxValue) tiedGroups.push(group);
        });
    
        if (tiedGroups.length > 1) {
            forecastInsight += ` Forecasts indicate that <strong>${tiedGroups.join(" and ")}</strong> will have similar high participation levels.`;
        } else {
            forecastInsight += ` The forecast predicts that <strong>${highestGroup}</strong> will continue to have the highest number of beneficiaries.`;
        }
    
        // Forecast for the next month using movingAvg
        let nextMonthForecast = movingAvg && movingAvg > 0 ? movingAvg.toFixed(2) : "N/A"; // Formatted forecast for next month
        let nextMonthInsight = nextMonthForecast !== "N/A" 
            ? `The forecast predicts <strong>${nextMonthForecast}</strong> beneficiaries for the upcoming month.`
            : "No prediction available for the upcoming month.";
    
        // Generate insight text with **monthly** focus and future prediction
        let insightText = `
            <strong>Insights for ${lastMonthKey}:</strong><br>
            - The total number of beneficiaries in ${lastMonthKey} was <strong>${lastMonthTotal}</strong>.<br>
            - Compared to ${prevMonthKey || 'previous month'}, past trends show a <strong>${trendType}</strong> in deworming beneficiaries.<br>
            - The highest age group in ${lastMonthKey} was <strong>${highestGroup}</strong>.<br>
            - The lowest age group in ${lastMonthKey} was <strong>${lowestGroup}</strong>.<br>
            - ${forecastInsight}<br>
            - ${nextMonthInsight}
        `;
    
        forecastInsightContainer.innerHTML = insightText;
    }
    
    // function generateForecastInsights(historicalData, forecastData, movingAvg) {
    //     if (!historicalData || Object.keys(historicalData).length === 0) {
    //         forecastInsightContainer.innerHTML = "<br>No historical data available for accurate forecasting.";
    //         return;
    //     }
    
    //     // Get the last and second-to-last months
    //     let monthKeys = Object.keys(historicalData).sort(); // Sort keys (YYYY-MM)
    //     let lastMonthKey = monthKeys.pop(); // Latest month
    //     let prevMonthKey = monthKeys.pop() || null; // Previous month (if exists)
    
    //     let lastMonthData = historicalData[lastMonthKey] || {};
    //     let prevMonthData = prevMonthKey ? historicalData[prevMonthKey] : {};
    
    //     // Total beneficiaries for last and previous months
    //     let lastMonthTotal = Object.values(lastMonthData).reduce((sum, count) => sum + count, 0);
    //     let prevMonthTotal = Object.values(prevMonthData).reduce((sum, count) => sum + count, 0);
    
    //     // Monthly trend analysis using lastMonthTotal
    //     let trendType = lastMonthTotal > prevMonthTotal ? "growth" 
    //                    : lastMonthTotal < prevMonthTotal ? "decline" 
    //                    : "stability";
    
    //     // Identify highest and lowest age groups for last month
    //     let sortedAgeGroups = Object.entries(lastMonthData).sort((a, b) => b[1] - a[1]);
    //     let highestGroup = sortedAgeGroups.length > 0 ? sortedAgeGroups[0][0] : "N/A";
    //     let lowestGroup = sortedAgeGroups.length > 1 ? sortedAgeGroups[sortedAgeGroups.length - 1][0] : "N/A";
    
    //     // Monthly trend insights (now using lastMonthTotal correctly)
    //     let forecastInsight = "";
    //     if (lastMonthTotal > prevMonthTotal * 1.2) {
    //         forecastInsight = "A substantial increase in deworming beneficiaries is expected.";
    //     } else if (lastMonthTotal > prevMonthTotal * 1.05) {
    //         forecastInsight = "A gradual rise in deworming beneficiaries is expected.";
    //     } else if (Math.abs(lastMonthTotal - prevMonthTotal) <= prevMonthTotal * 0.05) {
    //         forecastInsight = "The forecast suggests a stable trend.";
    //     } else if (lastMonthTotal < prevMonthTotal * 0.95) {
    //         forecastInsight = "A slight decline in deworming beneficiaries is predicted.";
    //     } else if (lastMonthTotal < prevMonthTotal * 0.8) {
    //         forecastInsight = "A significant drop in deworming beneficiaries is forecasted.";
    //     }
    
    //     // Check for age group ties
    //     let tiedGroups = [];
    //     let maxValue = Math.max(...Object.values(lastMonthData));
    //     Object.entries(lastMonthData).forEach(([group, count]) => {
    //         if (count === maxValue) tiedGroups.push(group);
    //     });
    
    //     if (tiedGroups.length > 1) {
    //         forecastInsight += ` Forecasts indicate that <strong>${tiedGroups.join(" and ")}</strong> will have similar high participation levels.`;
    //     } else {
    //         forecastInsight += ` The forecast predicts that <strong>${highestGroup}</strong> will continue to have the highest number of beneficiaries.`;
    //     }
    
    //     // Generate insight text with **monthly** focus
    //     let insightText = `
    //         <strong>Insights for ${lastMonthKey}:</strong><br>
    //         - The total number of beneficiaries in ${lastMonthKey} was <strong>${lastMonthTotal}</strong>.<br>
    //         - Compared to ${prevMonthKey}, past trends show a <strong>${trendType}</strong> in deworming beneficiaries.<br>
    //         - The highest age group in ${lastMonthKey} was <strong>${highestGroup}</strong>.<br>
    //         - The lowest age group in ${lastMonthKey} was <strong>${lowestGroup}</strong>.<br>
    //         - ${forecastInsight}
    //     `;
    
    //     forecastInsightContainer.innerHTML = insightText;
    // }
    
    
    // function createForecastChart(historicalData) {
    //     if (!historicalData || Object.keys(historicalData).length === 0) {
    //         insightContainer.innerHTML += "<br>No historical data available for forecasting.";
    //         return;
    //     }
    //     let forecastData = new Map(); 
    //     Object.keys(historicalData).forEach(monthYear => {
    //         const [year, month] = monthYear.split('-').map(Number);
    //         let total = Object.values(historicalData[monthYear]).reduce((sum, count) => sum + count, 0);
    //         let dateKey = `${year}-${month}`;
    //         forecastData.set(dateKey, { x: new Date(year, month - 1), y: total });
    //     });
    
    //     let forecastArray = Array.from(forecastData.values()).sort((a, b) => a.x - b.x);
    //     let lastThree = forecastArray.slice(-3);
    //     let movingAvg = lastThree.length > 0 
    //         ? lastThree.reduce((sum, d) => sum + d.y, 0) / lastThree.length
    //         : 0;
    
    //     let lastDate = forecastArray.length > 0 ? forecastArray[forecastArray.length - 1].x : new Date();
    //     let nextMonth = new Date(lastDate);
    //     nextMonth.setMonth(nextMonth.getMonth() + 1);

    //     let nextMonthKey = `${nextMonth.getFullYear()}-${nextMonth.getMonth() + 1}`;
    //     if (!forecastData.has(nextMonthKey)) {
    //         forecastArray.push({ x: nextMonth, y: movingAvg });
    //     }
    
    //     const forecastChart = new CanvasJS.Chart("forecast_chart", {
    //         animationEnabled: true,
    //         title: { text: "Deworming Forecast (Next Month Projection)" },
    //         axisX: { 
    //             valueFormatString: "MMM YYYY", 
    //             title: "Month", 
    //             interval: 1, 
    //             intervalType: "month"
    //         },
    //         axisY: { title: "Counts", includeZero: false },
    //         data: [{
    //             type: "line",
    //             markerSize: 10,
    //             toolTipContent: "{x}: {y}",
    //             dataPoints: forecastArray
    //         }]
    //     });
    //     generateForecastInsights(historicalData, forecastArray, movingAvg);
    //     forecastChart.render();
    // }
    
    // function createForecastChart(historicalData) {
    //     if (!historicalData || Object.keys(historicalData).length === 0) {
    //         insightContainer.innerHTML += "<br>No historical data available for forecasting.";
    //         return;
    //     }
    
    //     let forecastData = new Map(); 
    //     // Process each month-year entry
    //     Object.keys(historicalData).forEach(monthYear => {
    //         const [year, month] = monthYear.split('-').map(Number);
    //         let total = Object.values(historicalData[monthYear]).reduce((sum, count) => sum + count, 0);
    //         let dateKey = `${year}-${month}`;
    //         forecastData.set(dateKey, { x: new Date(year, month - 1), y: total });
    //     });
    
    //     // Create an array of all months in the current year (January to December)
    //     const allMonths = [];
    //     const currentYear = new Date().getFullYear(); // Current year
    //     for (let month = 1; month <= 12; month++) {
    //         const monthKey = `${currentYear}-${month}`;
    //         if (!forecastData.has(monthKey)) {
    //             allMonths.push({ x: new Date(currentYear, month - 1), y: null }); // No data for this month
    //         } else {
    //             allMonths.push(forecastData.get(monthKey)); // Use data if available
    //         }
    //     }
    
    //     // Sorting the months correctly (from January to December)
    //     let forecastArray = allMonths.sort((a, b) => a.x - b.x);
    
    //     // Calculate moving average (using last 3 months)
    //     let lastThree = forecastArray.slice(-3);
    //     let movingAvg = lastThree.length > 0 
    //         ? lastThree.reduce((sum, d) => sum + (d.y || 0), 0) / lastThree.length
    //         : 0;
    
    //     // Predict next month's data (if necessary)
    //     let lastDate = forecastArray.length > 0 ? forecastArray[forecastArray.length - 1].x : new Date();
    //     let nextMonth = new Date(lastDate);
    //     nextMonth.setMonth(nextMonth.getMonth() + 1);
    
    //     // Ensure the forecast for next month is only for the current year
    //     if (nextMonth.getFullYear() === currentYear) {
    //         let nextMonthKey = `${nextMonth.getFullYear()}-${nextMonth.getMonth() + 1}`;
    //         if (!forecastData.has(nextMonthKey)) {
    //             forecastArray.push({ x: nextMonth, y: movingAvg });
    //         }
    //     }
    
    //     // Render the forecast chart
    //     const forecastChart = new CanvasJS.Chart("forecast_chart", {
    //         animationEnabled: true,
    //         title: { text: "Deworming Forecast (Next Month Projection)" },
    //         axisX: { 
    //             valueFormatString: "MMM YYYY", 
    //             title: "Month", 
    //             interval: 1, 
    //             intervalType: "month"
    //         },
    //         axisY: { title: "Counts", includeZero: false },
    //         data: [{
    //             type: "line",
    //             markerSize: 10,
    //             toolTipContent: "{x}: {y}",
    //             dataPoints: forecastArray
    //         }]
    //     });
    
    //     // Call function for insights
    //     // generateForecastInsights(historicalData, forecastArray, movingAvg);
    
    //     // Render the chart
    //     forecastChart.render();
    // }


    function createForecastChart(historicalData) {
        if (!historicalData || Object.keys(historicalData).length === 0) {
            insightContainer.innerHTML += "<br>No historical data available for forecasting.";
            return;
        }
    
        let forecastData = new Map(); 
        // Process each month-year entry
        Object.keys(historicalData).forEach(monthYear => {
            const [year, month] = monthYear.split('-').map(Number);
            let total = Object.values(historicalData[monthYear]).reduce((sum, count) => sum + count, 0);
            let dateKey = `${year}-${month}`;
            forecastData.set(dateKey, { x: new Date(year, month - 1), y: total });
        });
    
        // Create an array of all months in the current year (January to December)
        const allMonths = [];
        const currentYear = new Date().getFullYear(); // Current year
        for (let month = 1; month <= 12; month++) {
            const monthKey = `${currentYear}-${month}`;
            if (!forecastData.has(monthKey)) {
                allMonths.push({ x: new Date(currentYear, month - 1), y: null }); // No data for this month
            } else {
                allMonths.push(forecastData.get(monthKey)); // Use data if available
            }
        }
    
        // Sorting the months correctly (from January to December)
        let forecastArray = allMonths.sort((a, b) => a.x - b.x);
    
        // Calculate moving average (using last 3 months)
        let lastThree = forecastArray.slice(-3);
        let movingAvg = lastThree.length > 0 
            ? lastThree.reduce((sum, d) => sum + (d.y || 0), 0) / lastThree.length
            : 0;
    
        // Predict next month's data (if necessary)
        let lastDate = forecastArray.length > 0 ? forecastArray[forecastArray.length - 1].x : new Date();
        let nextMonth = new Date(lastDate);
        nextMonth.setMonth(nextMonth.getMonth() + 1);
    
        // Adding prediction for the next month
        const nextMonthKey = `${nextMonth.getFullYear()}-${nextMonth.getMonth() + 1}`;
        forecastArray.push({ x: nextMonth, y: movingAvg });
    
        // Render the forecast chart
        const forecastChart = new CanvasJS.Chart("forecast_chart", {
            animationEnabled: true,
            title: { text: "Deworming Forecast (Next Month Projection)" },
            axisX: { 
                valueFormatString: "MMM YYYY", 
                title: "Month", 
                interval: 1, 
                intervalType: "month"
            },
            axisY: { title: "Counts", includeZero: false },
            data: [{
                type: "line",
                markerSize: 10,
                toolTipContent: "{x}: {y}",
                dataPoints: forecastArray
            }, {
                type: "line",
                markerSize: 10,
                toolTipContent: "{x}: {y} (Prediction)",
                dataPoints: forecastArray.filter(point => point.y !== null),  // Display only actual data points
                lineDashType: "dash", // Make prediction line dashed
                showInLegend: true,
                name: "Prediction"
            }]
        });
    
        // Call function for insights
        generateForecastInsights(historicalData, forecastArray, movingAvg);
    
        // Render the chart
        forecastChart.render();
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


