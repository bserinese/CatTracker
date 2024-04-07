    import locations from './locations.json' assert { type: 'json' };

    // const locations = fetch('https://server.com/locations.json').then((response) => response.json()).then((json) => console.log(json));
    
    const points = locations.points;
    //console.log(points);
      const map = L.map('map').setView([44.4439, -73.0586], 17);
  
      const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);
      
          const CatIcon = L.Icon.extend({
          options: {
              iconSize:     [40, 39],
              iconAnchor:   [0, 0],
              popupAnchor:  [0, 0]
          }
      });
  
      const greenIcon = new CatIcon({iconUrl: 'cat.png'});
      
  L.marker([44.443401, -73.058594]).addTo(map)
      .bindPopup('Luna&lsquo;s HQ')
      .openPopup();
      
      for (var i = 0; i < points.length; i++) {
    let marker = new L.marker([points[i].latitude, points[i].longitude],{icon: greenIcon})
      .bindPopup(points[i].time)
      .addTo(map);
      }
      
      