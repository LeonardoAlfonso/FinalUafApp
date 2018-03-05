$(document).ready(function(){

    $('#optionsDepartament').change(function(){

        var parent = $(this).val();
        var newRoute = routeZonesList.replace('parameter',parent);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  console.log(data);
                  var zones = data.html;
                  $("#optionsZones").html(zones);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });

    });

    $('#optionsDepartament').change(function(){

        var parent = $(this).val();
        var newRoute = routeZonesList.replace('parameter',parent);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  console.log(data);
                  var zones = data.html;
                  $("#optionsZones").html(zones);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });

    });

});

function saveCost()
{
        var request = $("#newCost").serializeArray();
        var token = $("#token").val();
        console.log(routeStorageCost);

        $.ajax({
              url: routeStorageCost,
              headers: {'X-CSRF-TOKEN': token},
              type: 'POST',
              datatype: 'json',
              data: request,
              success:function(data)
              {
                  console.log(data);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
  };
