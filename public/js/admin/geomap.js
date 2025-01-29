
function setSupported() {
    if (typeof mapboxgl !== 'undefined') {
        return true;
    } 
}

$(document).ready(function() {
    if (setSupported()) {
        mapboxgl.accessToken = 'pk.eyJ1Ijoicm9uNTcxNDM1IiwiYSI6ImNtM2g3dmcxbzBjajIycnB5NWtwaG1xazMifQ.mhRMxfZ2WfgoAECkTXAXug';
        $.ajax({
            method: "GET",
            url: "/admin/get_map_locations",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                const locations = res.locations;
                const locationContainer = document.getElementById('map_locations');
                if (locationContainer) {
                    // selectLocation();
                    displayMap(locations, mapboxgl);
                }
            },
        });
    } 
});

async function geoJsonData() {
    try {
        const response = await fetch('/geojson/map.geojson');
        const data = await response.json();
        return data;
        
    } catch (error) {
        console.error('Error loading or sorting GeoJSON:', error);
        throw error;
    }
}

async function displayMap(locate, mapboxgl) { 
    let popup = null;
    var map_locations = new mapboxgl.Map({
        container: 'map_locations', 
        style: 'mapbox://styles/mapbox/satellite-streets-v11', 
        center: [121.42325831987608,
            14.470382689550888], 
        zoom: 10, 
        minZoom: 0, // Minimum zoom level
        maxZoom: 20 , // Maximum zoom level
        maxBounds: [
            [121.30, 14.40], // Southwest corner 
            [121.55, 14.60]   // Northeast corner 
        ]
    });

    function defaultMapView() {
        map_locations.fitBounds([
            [121.30, 14.40], // Southwest corner
            [121.55, 14.60]  // Northeast corner
        ]);
        setTimeout(function() {
            if (popup) {
                popup.remove();
            }
        }, 1000); 
        setTimeout(function() {
            if (map_locations.getLayer('laguna-points')) {
                map_locations.setFilter('laguna-points', null);
            }
        }, 3000);
    }

    map_locations.on('load', async function () {
        // Fit the map view to the bounds of Laguna
        const data = await geoJsonData();
        map_locations.addSource('barangay', {
            type: 'geojson',
            data: data
        });

        map_locations.loadImage('/img/location_indicator.png', function(error, image) {
            if (error) throw error;

            // Add the image to the map
            map_locations.addImage('custom-location-icon', image);

            // Add points layer
            map_locations.addLayer({
                id: 'laguna-points',
                type: 'symbol',
                source: 'barangay',
                filter: ['==', '$type', 'Point'],
                layout: {
                    'icon-image': 'custom-location-icon',  // Use the custom icon
                    'icon-size': 0.1,                      // Adjust size if needed
                    'icon-allow-overlap': true
                }
            });
        });
      
        // Populate the dropdown
        const dropdown = document.getElementById('location');
        const names = data.features
            .map(feature => feature.properties.name) 
            .filter(name => name)  
            .sort((a, b) => a.toLowerCase().localeCompare(b.toLowerCase()));

        names.forEach(name => {
            const option = document.createElement('option');
            option.value = name;
            option.textContent = name;
            dropdown.appendChild(option);
        }); 

       
        document.getElementById("location").addEventListener("change", (event) => {
            const selectedName = event.target.value; // Get the selected value from the dropdown
            if (map_locations.getLayer('laguna-points')) {
                if (selectedName === "All Barangays") {
                   defaultMapView();
                } else if (selectedName) {
                    map_locations.setFilter('laguna-points', ['==', 'name', selectedName]);
                    const data = map_locations.getSource('barangay')._data;
                
                    const selectedFeature = data.features.find(feature => feature.properties.name === selectedName);
                    if (selectedFeature) {
                        const coordinates = selectedFeature.geometry.coordinates; 
                
                        // Fly to the coordinates
                        map_locations.flyTo({
                            center: coordinates, 
                            zoom: 17, 
                            essential: true 
                        });                        
                        if (popup) {
                            popup.remove();
                        }
                        const matchingLocation = locate.find(loc => loc.name === selectedFeature.properties.name);
                        if (matchingLocation) {
                            setTimeout(function() {
                                    const description = `
                                     <div class="card text-white p-3 m-0" style="background-color: #a6a6a6; border-radius: 3px;>
                                        <div class="card-body m-0 p-0">
                                            <h5 class="card-title text-center m-0 p-0">
                                                <strong>${selectedFeature.properties.name}</strong>
                                                <hr>
                                            </h5>
                                            <p class="card-text text-truncate">
                                                Populations : ${matchingLocation.population}<br>
                                                    Womens: ${matchingLocation.women}<br>
                                                    Children: ${matchingLocation.child}
                                            </p>
                                        </div>
                                    </div>
                                `;
                                popup = new mapboxgl.Popup({ closeButton: false, closeOnClick: false })
                                    .setLngLat(coordinates)
                                    .setHTML(description)
                                    .addTo(map_locations);
                            }, 2000);
                           
                        } else {
                            console.error("No matching location found in the 'locate' array.");
                        }
                    } else {
                        console.error("Selected feature not found in the dataset.");
                    }
                } else {
                    console.error("Invalid selection value.");
                }
            } else {
                console.error("The 'laguna-points' layer is not available.");
            }
        });
    });
}




