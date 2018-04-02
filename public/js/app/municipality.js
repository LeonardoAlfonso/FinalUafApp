function saveMunicipality()
{
        var name = $('#nameMunicipality').val();
        console.log(name);
        var newRoute = routeSaveMunicipality.replace('parameter', name);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  console.log(data);
                  $("#tableMunicipalities").html(data.viewTable);
                  $("#ClimaticSelectStyle").html(data.viewList);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
  };

function deleteMunicipality(id)
{
        var newRoute = routedeleteMunicipality.replace('parameter', id);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                    console.log(data);
                    $("#tableMunicipalities").html(data.viewTable);
                    $("#ClimaticSelectStyle").html(data.viewList);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
}
