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

  function getCharacteristics(id)
  {
          var newRoute = routeCharacteristics.replace('parameter',id);
          console.log(newRoute);

          $.ajax({
                url: newRoute,
                headers: {'X-CSRF-TOKEN':token},
                type: 'GET',
                datatype: 'json',
                success:function(data)
                {
                    var characteristics = data.html;
                    $("#ModalBody").html(characteristics);
                },
                error:function(data)
                {
                    alert('mal');
                }
            });
    };

    function getCosts(id)
    {
            var newRoute = routeCosts.replace('parameter',id);
            console.log(newRoute);

            $.ajax({
                  url: newRoute,
                  headers: {'X-CSRF-TOKEN':token},
                  type: 'GET',
                  datatype: 'json',
                  success:function(data)
                  {
                      var costs = data.html;
                      $("#SystemContent").html(costs);
                  },
                  error:function(data)
                  {
                      alert('mal');
                  }
              });
      };

    function getIndicators(id)
    {
            var newRoute = routeIndicators.replace('parameter',id);
            console.log(newRoute);

            $.ajax({
                  url: newRoute,
                  headers: {'X-CSRF-TOKEN':token},
                  type: 'GET',
                  datatype: 'json',
                  success:function(data)
                  {
                      console.log(data);
                      var indicators = data.html;
                      $("#SystemContent").html(indicators);
                  },
                  error:function(data)
                  {
                      alert('mal');
                  }
              });
      };
