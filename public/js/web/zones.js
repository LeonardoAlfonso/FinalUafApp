function zoneElements(id)
{
        var newRoute = routeElements.replace('parameter',id);
        console.log(newRoute);
        //
        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  var element = data.html;
                  $("#description").html(element);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
  };

  function SocioeconomicCharacteristics(id)
  {
          var newRoute = routeSocioeconomicCharacteristics.replace('parameter',id);
          console.log(newRoute);
          //
          $.ajax({
                url: newRoute,
                headers: {'X-CSRF-TOKEN':token},
                type: 'GET',
                datatype: 'json',
                success:function(data)
                {
                    var element = data.html;
                    $("#description").html(element);
                },
                error:function(data)
                {
                    alert('mal');
                }
            });
    };
