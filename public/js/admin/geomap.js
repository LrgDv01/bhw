
function setSupported() {
    if (typeof mapboxgl !== 'undefined') {
        return true;
    } 
}

$(document).ready(function() {
    if (setSupported()) {
        mapboxgl.accessToken = 'pk.eyJ1Ijoicm9uNTcxNDM1IiwiYSI6ImNtM2g3dmcxbzBjajIycnB5NWtwaG1xazMifQ.mhRMxfZ2WfgoAECkTXAXug';

        $.ajax({
            type: "GET",
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
        const response = await fetch('/geojson/laguna_map.geojson');
        const data = await response.json();
        return data;
        
    } catch (error) {
        console.error('Error loading or sorting GeoJSON:', error);
        throw error;
    }
}

function zoomOut(map) {
    map.flyTo({
        center: [121.423, 14.281],
        zoom: 3,
        speed: 1.2,
        curve: 1,
        easing(t) {
            return t;
        }
    });

} 

async function displayMap(locate, mapboxgl) { 

    var map_locations = new mapboxgl.Map({
        container: 'map_locations', 
        style: 'mapbox://styles/mapbox/satellite-streets-v11', // Realistic satellite-streets view
        center: [121.37575102352582,
            14.27976852821142], // Coordinates for Sta. Cruz, Laguna
        zoom: 3, // Set zoom level suitable for the area
        minZoom: 3, // Minimum zoom level
        maxZoom: 16, // Maximum zoom level
        maxBounds: [
            [121.0, 13.8],  // Southwest corner (lower latitude for the southern part of Laguna)
            [122.0, 14.8]   // Northeast corner (higher latitude for the northern part of Laguna)
        ]
    });
   
    map_locations.on('load', async function () {
        // Fit the map view to the bounds of Laguna
        const data = await geoJsonData();
        map_locations.addSource('barangay', {
            type: 'geojson',
            data: data
        });

        // Add polygon layer
        map_locations.addLayer({
            id: 'laguna-boundary',
            type: 'line',
            source: 'municipal',
            filter: ['==', '$type', 'Polygon'],
            paint: {
                'line-color': '#FFD700',
                'line-width': 3,
                'line-dasharray': [2, 2]
            }
        });

        map_locations.loadImage('/img/location_indicator.png', function(error, image) {
            if (error) throw error;

            // Add the image to the map
            map_locations.addImage('custom-location-icon', image);

            // Add points layer
            map_locations.addLayer({
                id: 'laguna-points',
                type: 'symbol',
                source: 'municipal',
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
                    setTimeout(function() {
                        document.getElementById('details').style.display = 'none';
                        displayMap(locate, mapboxgl); // Recursive call to reload the map
                    }, 500);
               
                } else if (selectedName) {
                    locate.forEach(loc =>{
                    });
                    map_locations.setFilter('laguna-points', ['==', 'name', selectedName]);
                } else {
                    console.error("Invalid selection value.");
                }
            } else {
                console.error("The 'laguna-points' layer is not available.");
            }
        });
        
        let popup = null;
        // Add tooltips for the points
        map_locations.on('mouseenter', 'laguna-points', (e) => {
            const coordinates = e.features[0].geometry.coordinates.slice();
            const properties = e.features[0].properties;

            locate.forEach(loc =>{

            })
        
        });

        map_locations.on('mouseleave', 'laguna-points', () => {
            if (popup) {
                popup.remove(); 
            }
            map_locations.getCanvas().style.cursor = '';
        });
    });
}




