var map = L.map('map').setView([1.94, -72.11], 7);

var basemap = L.esri.basemapLayer('Gray').addTo(map);

var layer1 = L.esri.featureLayer({
                  url: 'https://prubassig.agenciadetierras.gov.co/pruebasig/rest/services/Servicios_ANT/ServicioWMS_ZonaReservaCampesina/MapServer/0',
                      style: function (feature) {
                          return { color: 'red', weight: 2 };
                      }}).addTo(map);

var layer2 = L.esri.featureLayer({
                  url: 'https://prubassig.agenciadetierras.gov.co/pruebasig/rest/services/Servicios_ANT/ServicioWMS_ZonaReservaCampesina/MapServer/1',
                      style: function (feature) {
                          return { color: 'blue', weight: 2 };
                      }}).addTo(map);