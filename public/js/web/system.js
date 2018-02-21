function getSystem(id)
{
        var newRoute = routeSystems.replace('parameter',id);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  console.log(data);
                  var system = data.html;
                  $("#description").html(system);
                  $.getScript(assetGraphics);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
  };
