$(document).ready(function() {
//   const currentYear = new Date().getFullYear();
//   const startYear = currentYear - 10; // Change this value to adjust the range
//   const $yearSelect = $('#yearSelect');

//   for (let year = currentYear; year >= startYear; year--) {
//       $yearSelect.append(new Option(year, year));
//   }
//   // Check element 
// //   let graph = $("#monthlyChart1");

//   if(graph.length > 0) {
//     // Optionally, you can add an event listener to handle the year selection
//     $yearSelect.on('change', function() {
//         const selectedYear = $(this).val();
//         displayMonthlyGraph(selectedYear);
//         // Fetch and update the chart data based on the selected year
//     });
//     displayMonthlyGraph(currentYear)
//   }

    const currentYear = new Date().getFullYear();
    // const startYear = currentYear + 4; // Change this value to adjust the range
    // const $diseaseYearSelect = $('#diseaseYearSelect');
    // for (let year = currentYear; year >= startYear; year--) {
    //     $diseaseYearSelect.prepend(new Option(year, year));
    // }

    const diseaseYearSelect = document.getElementById('diseaseYearSelect');
    // for (let year = 2020; year <= 2024; year++) {
    for (let year = 2020; year <= currentYear; year++) {

        const option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        diseaseYearSelect.appendChild(option);
    }
    // Reverse the order of options
    const options = Array.from(diseaseYearSelect.options).slice(1);
    diseaseYearSelect.innerHTML = ""; 
    options.reverse().forEach((option) => diseaseYearSelect.appendChild(option)); // Append in reverse order

    displayDiseaseChart(currentYear)

});
let diseases_chart; 
// let monthlyChart; // Declare a variable to store the chart instance
function displayDiseaseChart(year = null) { 
  const currentYear = new Date().getFullYear();
  let sendYear = year == null ? currentYear : year ;
  $.ajax({
    url: "/admin/dashboard/get_monthly_counts",
    method: "GET",
    data: { year: sendYear },
    success: function (data) {
        // const labels = [];
        // const approvedCounts = [];
        // const pendingCounts = [];
        // const rejectedCounts = [];

        // const sample = [
        //     { year: 2010, month: 1, approved_count: 12, rejected_count: 3 },
        //     { year: 2024, month: 2, approved_count: 15, rejected_count: 5 },
        //     { year: 2024, month: 3, approved_count: 20, rejected_count: 2 },
        //     { year: 2024, month: 4, approved_count: 18, rejected_count: 4 },
        //     { year: 2024, month: 5, approved_count: 25, rejected_count: 6 },
        //     { year: 2024, month: 6, approved_count: 30, rejected_count: 7 },
        // ];

        // data.forEach((item) => {
        //     labels.push(
        //         `${item.year}-${String(item.month).padStart(2, "0")}`
        //     );
        //     approvedCounts.push(item.approved_count);
        //     rejectedCounts.push(item.rejected_count);
        // });

    

        // const ctx = $("#diseases_chart")[0].getContext("2d");
        // Destroy the previous chart instance if it exists
        // if (diseases_chart) {
        //     diseases_chart.destroy();
        // }


        // diseases_chart = new Chart(ctx, {
        //     type: "bar",
        //     data: {
        //         labels: labels,
        //         datasets: [
        //             {
        //                 label: "Approved Requests",
        //                 data: approvedCounts,
        //                 backgroundColor: "rgba(75, 192, 192, 0.2)",
        //                 borderColor: "rgba(75, 192, 192, 1)",
        //                 borderWidth: 1,
        //             },
        //             {
        //                 label: "Rejected Requests",
        //                 data: rejectedCounts,
        //                 backgroundColor: "rgba(255, 99, 132, 0.2)",
        //                 borderColor: "rgba(255, 99, 132, 1)",
        //                 borderWidth: 1,
        //             },
        //         ],
        //     },
        //     options: {
        //         indexAxis: "y",
        //         scales: {
        //             x: {
        //                 beginAtZero: true,
        //             },
        //         },
        //     },
        // });


        // monthlyChart1 = new Chart(ctx1, {
        //     type: "line",
        //     data: {
        //         labels: labels, // X-axis labels
        //         datasets: [
        //             {
        //                 label: "Approved",
        //                 data: approvedCounts,
        //                 backgroundColor: "rgba(75, 192, 192, 0.2)", // Area under the line
        //                 borderColor: "rgba(75, 192, 192, 1)", // Line color
        //                 borderWidth: 2,
        //                 tension: 0.3, // Smoothing of the line
        //                 fill: true, // Fill the area under the line
        //             },
        //             {
        //                 label: "Rejected",
        //                 data: rejectedCounts,
        //                 backgroundColor: "rgba(255, 99, 132, 0.2)", // Area under the line
        //                 borderColor: "rgba(255, 99, 132, 1)", // Line color
        //                 borderWidth: 2,
        //                 tension: 0.3, // Smoothing of the line
        //                 fill: true, // Fill the area under the line
        //             },
        //         ],
        //     },
        //     options: {
        //         responsive: true, // Responsive design
        //         plugins: {
        //             legend: {
        //                 position: "top", // Position of the legend
        //             },
        //             tooltip: {
        //                 enabled: true, // Enable tooltips
        //             },
        //         },
        //         scales: {
        //             x: {
        //                 beginAtZero: false, // Don't force x-axis to start at 0
        //             },
        //             y: {
        //                 beginAtZero: true, // Start y-axis at 0
        //             },
        //         },
        //     },
        // });



    

        // Sample Data
        
        // const districtData = [
        //     { year: 2020, district: "District 3", yellowing: 12, bud_rot: 3, leaf_spot_disease: 5 },
        //     { year: 2020, district: "District 4", yellowing: 8, bud_rot: 5, leaf_spot_disease: 7 },
        //     { year: 2021, district: "District 3", yellowing: 10, bud_rot: 4, leaf_spot_disease: 6 },
        //     { year: 2021, district: "District 4", yellowing: 15, bud_rot: 7, leaf_spot_disease: 9 },
        //     { year: 2022, district: "District 3", yellowing: 18, bud_rot: 6, leaf_spot_disease: 7 },
        //     { year: 2022, district: "District 4", yellowing: 20, bud_rot: 8, leaf_spot_disease: 10 },
        // ];
        
        const generateFullDistrictData = (startYear, endYear) => {
            // const years = [2020, 2021, 2022];
            const districts = ["District 3", "District 4"];
            const fullDistrictData = [];
        
            // years.forEach((year) => {
            for (let year = startYear; year <= endYear; year++) {
                for (let month = 1; month <= 12; month++) {
                    districts.forEach((district) => {
                        fullDistrictData.push({
                            year: year,
                            month: month,
                            district: district,
                            yellowing: Math.floor(Math.random() * 21), // Random value between 0–20
                            bud_rot: Math.floor(Math.random() * 11),    // Random value between 0–10
                            leaf_spot_disease: Math.floor(Math.random() * 16), // Random value between 0–15
                        });
                    });
                }
            }
            // });
        
            return fullDistrictData;
        };
        
        const districtData = generateFullDistrictData(2020, currentYear);
        // console.log("districtData >>>", districtData);
        const district3Checkbox = document.getElementById("district3Filter");
        const district4Checkbox = document.getElementById("district4Filter");


        // Generate for Monthly and Yearly data
        function generateDiseaseData(startYear, endYear) {
            const data = [];
            for (let year = startYear; year <= endYear; year++) {
                for (let month = 1; month <= 12; month++) {
                    data.push({
                        year: year,
                        month: month,
                        yellowing: Math.floor(Math.random() * 50) + 1, // Random value between 1-50
                        bud_rot: Math.floor(Math.random() * 30) + 1, // Random value between 1-30
                        leaf_spot_disease: Math.floor(Math.random() * 40) + 1, // Random value between 1-40
                    });
                }
            }
            return data;
        }
        
        const sample_data = generateDiseaseData(2020, currentYear);
        console.log("sample_data >>>", sample_data);
        // console.log(sample_data);

        function getYearlyData(data) {
            const yearlyData = [];
            const yearlyTotals = {};
    
            // Sum all monthly values for each year
            data.forEach((item) => {
                if (!yearlyTotals[item.year]) {
                    yearlyTotals[item.year] = { yellowing: 0, bud_rot: 0, leaf_spot_disease: 0 };
                }
                yearlyTotals[item.year].yellowing += item.yellowing;
                yearlyTotals[item.year].bud_rot += item.bud_rot;
                yearlyTotals[item.year].leaf_spot_disease += item.leaf_spot_disease;
            });
    
            for (const year in yearlyTotals) {
                yearlyData.push({
                    year: parseInt(year),
                    yellowing: yearlyTotals[year].yellowing,
                    bud_rot: yearlyTotals[year].bud_rot,
                    leaf_spot_disease: yearlyTotals[year].leaf_spot_disease,
                });
            }
    
            return yearlyData;
        }



        // const yearlyData = getYearlyData(sample_data);

        // Reduce the dataset for display purposes (optional)
        // const selectedData = sample_data.slice(0, 12); // Display first 12 entries (one year)

        // Extract labels and datasets
        // const labels = selectedData.map(
        //     (item) => `${item.year}-${String(item.month).padStart(2, "0")}`
        // );
        // const yellowingData = selectedData.map((item) => item.yellowing);
        // const budRotData = selectedData.map((item) => item.bud_rot);
        // const leafSpotData = selectedData.map((item) => item.leaf_spot_disease);

        // Populate the dropdown with years (2010 to 2024)

        

        function updateChart(displayYearly, displayMonthly, selectedYear) {

            let labels = [];
            let yellowingData = [];
            let budRotData = [];
            let leafSpotData = [];
            

            const filteredAll = selectedYear === "all" 
            ? sample_data 
            : sample_data.filter(item => item.year === parseInt(selectedYear));
           
            let fildis = selectedYear === "all"
                ? districtData
                : districtData.filter((item) => item.year === parseInt(selectedYear)); // Use the integer value for comparison
            
            const filteredDistrict = fildis.filter((item) => {
                const isDistrict3Checked = district3Checkbox.checked && item.district === "District 3";
                const isDistrict4Checked = district4Checkbox.checked && item.district === "District 4";
            
                return isDistrict3Checked || isDistrict4Checked;
            });

            if (displayYearly) {
                const yearlyData = getYearlyData(filteredAll);
                yearlyData.forEach((item) => {
                    labels.push(item.year.toString());
                    yellowingData.push(item.yellowing);
                    budRotData.push(item.bud_rot);
                    leafSpotData.push(item.leaf_spot_disease);
                });

               if ($("#district3Filter").is(":checked") || $("#district4Filter").is(":checked") ) {

            
                    const yrs = [...new Set(filteredDistrict.map((item) => item.year))];
                    labels = [...yrs];
                    yellowingData = yrs.map((year) =>
                        filteredDistrict 
                            .filter((item) => item.year === year)
                            .reduce((sum, item) => sum + item.yellowing, 0)
                    );
                    budRotData = yrs.map((year) =>
                        filteredDistrict
                            .filter((item) => item.year === year)
                            .reduce((sum, item) => sum + item.bud_rot, 0)
                    );
                    leafSpotData = yrs.map((year) =>
                        filteredDistrict
                            .filter((item) => item.year === year)
                            .reduce((sum, item) => sum + item.leaf_spot_disease, 0)
                    );

               }
               
            }

            if (displayMonthly) {
                filteredAll.slice(0, 12).forEach((item) => {
                    labels.push(`${item.year}-${String(item.month).padStart(2, "0")}`);
                    yellowingData.push(item.yellowing);
                    budRotData.push(item.bud_rot);
                    leafSpotData.push(item.leaf_spot_disease);
                });

                if ($("#district3Filter").is(":checked") || $("#district4Filter").is(":checked") ) { 
                 
                    const uniqueMonths = [...new Set(filteredDistrict.map((item) => `${item.year}-${String(item.month).padStart(2, "0")}`))].slice(0, 12);
                    labels = [...uniqueMonths];
            
                    yellowingData = uniqueMonths.map((label) => {
                        const [year, month] = label.split("-");
                        return filteredDistrict
                            .filter((item) => item.year == year && item.month == month)
                            .reduce((sum, item) => sum + item.yellowing, 0);
                    });
            
                    budRotData = uniqueMonths.map((label) => {
                        const [year, month] = label.split("-");
                        return filteredDistrict
                            .filter((item) => item.year == year && item.month == month)
                            .reduce((sum, item) => sum + item.bud_rot, 0);
                    });
            
                    leafSpotData = uniqueMonths.map((label) => {
                        const [year, month] = label.split("-");
                        return filteredDistrict
                            .filter((item) => item.year == year && item.month == month)
                            .reduce((sum, item) => sum + item.leaf_spot_disease, 0);
                    });
                }


                // filteredDistrict.forEach((item) => {
                //     if (item.district == "District 3") {
                //         return filteredDistrict;
                //     }
                // });
                // console.log("filteredDistrict >> ", filteredDistrict);
               

            }

            if (diseases_chart) {
                diseases_chart.destroy();
            }
        
            const ctx = $("#diseases_chart")[0].getContext("2d");
            diseases_chart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels, // X-axis labels
                    datasets: [
                        {
                            label: "Yellowing",
                            data: yellowingData,
                            backgroundColor: "rgba(255, 206, 86, 0.6)",
                            borderColor: "rgba(255, 206, 86, 1)",
                            borderWidth: 1,
                        },
                        {
                            label: "Bud Rot",
                            data: budRotData,
                            backgroundColor: "rgba(75, 192, 192, 0.6)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                        },
                        {
                            label: "Leaf Spot Disease",
                            data: leafSpotData,
                            backgroundColor: "rgba(153, 102, 255, 0.6)",
                            borderColor: "rgba(153, 102, 255, 1)",
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    indexAxis: "y", // Horizontal bar chart
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top",
                        },
                        tooltip: {
                            enabled: true,
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: true, // Start x-axis at 0
                        },
                    },
                },
            });
        }


        // Initial chart render with all data
        updateChart(true, true, 'all');


        // For Monthly and Yearly Filter
        // Event Listener for Year Selection
        document.getElementById("diseaseYearSelect").addEventListener("change", (event) => {
            const selectedYear = event.target.value; // Get the selected year from dropdown
            if ($("#monthlyFilter").prop("checked", true)) {
                $("#yearlyFilter").prop("checked", false);
                updateChart(false, true, selectedYear);
            }  
        });

  
        // Event Listeners for Checkboxes
        document.getElementById("monthlyFilter").addEventListener("change", (event) => {
            if (event.target.checked) {
               $("#yearlyFilter").prop("checked", false);   
               updateChart(false, true, $("#diseaseYearSelect").val());
            } 
            else {
                $("#district3Filter").prop("checked", false);
                $("#district4Filter").prop("checked", false);
                updateChart(true, true, 'all'); 
            }
        });

        document.getElementById("yearlyFilter").addEventListener("change", (event) => {
            if (event.target.checked) {
               $("#monthlyFilter").prop("checked", false); 
                updateChart(true, false, 'all'); 
            } 
            else {
                $("#district3Filter").prop("checked", false);
                $("#district4Filter").prop("checked", false);
                updateChart(true, true, 'all'); 
            }
        });

        
        // For Districts Filter
        // Add event listeners to checkboxes
        district3Checkbox.addEventListener("change", (event) => {
            $("#district4Filter").prop("checked", false); 
            if (event.target.checked && $("#yearlyFilter").is(":checked")) {  
                updateChart(true, false, 'all'); 
            }
            if (event.target.checked &&  $("#monthlyFilter").is(":checked")) {
                updateChart(false, true, $("#diseaseYearSelect").val()); 
            }else {
                if ($("#yearlyFilter").is(":checked")) {
                    updateChart(true, false, 'all'); 
                }
                else if ($("#monthlyFilter").is(":checked")) {
                    updateChart(false, true, $("#diseaseYearSelect").val()); 
                }
              
            }

        });

        district4Checkbox.addEventListener("change", (event) => {
            $("#district3Filter").prop("checked", false); 
            if (event.target.checked && $("#yearlyFilter").is(":checked")) {  
                updateChart(true, false, 'all'); 
            }
            if (event.target.checked &&  $("#monthlyFilter").is(":checked")) {
                updateChart(false, true, $("#diseaseYearSelect").val()); 
            }else {
                if ($("#yearlyFilter").is(":checked")) {
                    updateChart(true, false, 'all'); 
                }
                else if ($("#monthlyFilter").is(":checked")) {
                    updateChart(false, true, $("#diseaseYearSelect").val()); 
                }
              
            }
            
        });
  


        // Initialize the chart with all data
        // updateChart(
        //     [...new Set(data.map((item) => item.year))],
        //     data.reduce((acc, item) => acc.concat(item.yellowing), []),
        //     data.reduce((acc, item) => acc.concat(item.bud_rot), []),
        //     data.reduce((acc, item) => acc.concat(item.leaf_spot_disease), [])
        // );



    },
  });
}