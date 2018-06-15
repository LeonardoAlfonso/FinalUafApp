$(document).ready(function(){

    $('#optionsDepartament').change(function(){

        var parent = $(this).val();
        var newRoute = routeZones.replace('parameter',parent);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  var zones = data.html;
                  $("#optionsZone").html(zones);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });

    });

});
