function saveMunicipality()
{
        var name = $('#nameMunicipality').val();
        var newRoute = routeSaveMunicipality.replace('parameter', name);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  var table = data.html;
                  $("#tableMunicipalities").html(table);
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
                  var table = data.html;
                  $("#tableMunicipalities").html(table);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
}
