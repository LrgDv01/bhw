
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
                const simulation = res.simulation;
                const locationContainer = document.getElementById('map_locations');
                const simulationContainer = document.getElementById('map_simulation');
                if (locationContainer) {
                    // selectLocation();
                    displayMap(locations, mapboxgl);
                } else if (simulationContainer) {
                    mapSimulation(simulation, mapboxgl);
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
        map_locations.addSource('municipal', {
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

        map_locations.loadImage('/img/municipal_loc.png', function(error, image) {
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
                if (selectedName === "All Municipal") {
                    setTimeout(function() {
                        document.getElementById('details').style.display = 'none';
                        displayMap(locate, mapboxgl); // Recursive call to reload the map
                    }, 500);
               
                } else if (selectedName) {
                    locate.forEach(loc =>{
                        if (loc.name === selectedName) {
                            document.getElementById('lot-area').textContent = loc.lot_area;
                            document.getElementById('number-of-trees').textContent = loc.trees;
                            document.getElementById('meters').textContent = loc.meters;
                            document.getElementById('details').style.display = 'block';
                        }
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
                if (loc.name === properties.name) {
               
                    const description = `
                    <div style="background-color: #28a745; padding: 15px; border-radius: 5px; color: white; border: none;">
                        <strong>${properties.name}</strong><br>
                        Lot Area: ${loc.lot_area}<br>
                        Trees: ${loc.trees}<br>
                        Meters: ${loc.meters}
                    </div>
                `;
                popup = new mapboxgl.Popup({ closeButton: false, closeOnClick: false })
                .setLngLat(coordinates)
                .setHTML(description)
                .addTo(map_locations);
                }
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

async function mapSimulation(simulate, mapboxgl) {
    const map_simulation = new mapboxgl.Map({
        container: 'map_simulation', 
        style: 'mapbox://styles/mapbox/satellite-streets-v11', 
        center: [121.423, 14.281], 
        zoom: 3, 
        minZoom: 3, 
        maxZoom: 16, 
        maxBounds: [ 
            [120.99, 13.8],  // Southwest corner (lower latitude for Laguna)
            [122.10, 14.7]   // Northeast corner (higher latitude for Laguna)
        ]
    });

    map_simulation.on('load', async function () {
        // Load geoJSON data
        const data = await geoJsonData();

        // Add the geoJSON data as a source
        map_simulation.addSource('municipal', {
            type: 'geojson',
            data: data
        });

       // Add a layer for red dots
        map_simulation.addLayer({
            id: 'glowing-points',
            type: 'circle',
            source: 'municipal',
            paint: {
                'circle-radius': 1, // Initial radius
                'circle-color': 'red',
                'circle-opacity': 0.9,
                'circle-blur': 0.5
            },
            filter: ['==', ['geometry-type'], 'Point']
        });

        // Add layer for municipal boundaries (polygons)
        map_simulation.addLayer({
            id: 'boundary',
            type: 'fill',
            source: 'municipal',
            paint: {
                'fill-color': 'darkblue',
                'fill-opacity': 0.2
            },
            filter: ['==', ['geometry-type'], 'Polygon']
        });

        let time = 0;
        // Animation loop for wave effect
        function animateWave() {
            time += 0.03; // Smaller value slows down the animation
            // Use a sine wave for smoother animation
            radius = 10 + Math.sin(time) * 3; // Oscillates between 5 and 15
            map_simulation.setPaintProperty('glowing-points', 'circle-radius', radius);
            // Request next frame
            requestAnimationFrame(animateWave);
        }

        // Start the animation
        animateWave();
        // Add interactivity: Popup on click
        map_simulation.on('click', 'glowing-points', (e) => {
            const name = e.features[0].properties.name || 'Unknown';
            const coordinates = e.features[0].geometry.coordinates.slice();

            new mapboxgl.Popup()
                .setLngLat(coordinates)
                .setHTML(`<strong>${name}</strong>`)
                .addTo(map_simulation);
        });

        // Change cursor on hover
        map_simulation.on('mouseenter', 'glowing-points', () => {
            map_simulation.getCanvas().style.cursor = 'pointer';
        });
        map_simulation.on('mouseleave', 'glowing-points', () => {
            map_simulation.getCanvas().style.cursor = '';
        });
    });
}




