
mapboxgl.accessToken = 'pk.eyJ1Ijoicm9uNTcxNDM1IiwiYSI6ImNtM2g3dmcxbzBjajIycnB5NWtwaG1xazMifQ.mhRMxfZ2WfgoAECkTXAXug';

var map = new mapboxgl.Map({
    container: 'map', 
    style: 'mapbox://styles/mapbox/satellite-streets-v11', // Realistic satellite-streets view
    center: [125.3667, 14.1667], // Coordinates for Laguna, Philippines 
    zoom: 1, // Initial zoom level
    minZoom: 9, // Minimum zoom level
    maxZoom: 25, // Maximum zoom level
    maxBounds: [[121.0, 13.8], [121.8, 16.3]] // Southwest and northeast bounds for Laguna area
});

// Add a pulsating red wave effect to Siniloan
map.on('load', function () {
    const locations = [
    { id: 'siniloanWave', coordinates: [121.444, 14.419], color: 'red' },
    { id: 'sanPabloWave', coordinates: [121.328, 14.068], color: 'blue' },
    { id: 'calambaWave', coordinates: [121.165, 14.212], color: 'green' }, 
    { id: 'staCruzWave', coordinates: [121.409, 14.281], color: 'yellow' }
    ];

    
    // Add sources and layers for all locations
    locations.forEach((location) => {
        map.addSource(location.id,  {
            type: 'geojson',
            data: {
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: location.coordinates // Coordinates of Siniloan
                }
            }
        });

        map.addLayer({
            id: location.id + 'Layer',
            type: 'circle',
            source: location.id,
            paint: {
                'circle-radius': [
                    'interpolate',
                    ['linear'],
                    ['number', ['get', 'radius']],
                    0, 0,
                    20, 30
                ],
                'circle-color': 'red',
                'circle-opacity': [
                    'interpolate',
                    ['linear'],
                    ['number', ['get', 'radius']],
                    0, 0.8,
                    20, 0
                ]
            }
        });
    });

    // Simulate animations for all locations
    let radii = {};
    locations.forEach((location) => (radii[location.id] = 0));

    function animateWaves() {
        locations.forEach((location) => {
            radii[location.id] += 0.1;
            if (radii[location.id] > 20) radii[location.id] = 0;

            try {
                map.getSource(location.id).setData({
                    type: 'Feature',
                    properties: { radius: radii[location.id] },
                    geometry: { type: 'Point', coordinates: location.coordinates }
                });
            } catch (error) {
                console.error(`Failed to update source for ${location.id}:`, error);
            }
        });

        requestAnimationFrame(animateWaves);
    }

    animateWaves();

    // Simulate expanding radius effect
    // let radius = 0;
    // function animateWave() {
    //     radius = (radius + 0.3) % 20;
    //     map.getSource('siniloanWave').setData({
    //         type: 'Feature',
    //         properties: { radius: radius },
    //         geometry: { type: 'Point', coordinates: [121.444, 14.419] }
    //     });
    //     requestAnimationFrame(animateWave);
    // }
    // animateWave();


    // let radius = 0;

    // function animateWaveFade() {
    //     radius += 0.10;
    //     if (radius > 20) radius = 0;

    //     try {
    //         map.getSource('siniloanWave').setData({
    //             type: 'Feature',
    //             properties: { radius: radius },
    //             geometry: { type: 'Point', coordinates: [121.444, 14.419] }
    //         });

    //         requestAnimationFrame(animateWaveFade);

    //     } catch (error) {
    //         console.error('Failed to update map source:', error);
    //     }

 
    // }
    // animateWaveFade();



});
