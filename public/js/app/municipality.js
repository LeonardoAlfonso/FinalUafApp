function saveMunicipality()
{
    var name = $('#nameMunicipality').val();

   if(jQuery.isEmptyObject(name))
    {
        alert('Seleccione un Municipio ');
    }
    else
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
                  $("#addMunicipality").html(data.viewList);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
    }
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
                $("#addMunicipality").html(data.viewList);
                $("#tableVilages").html(data.tableVillage);
                $("#nameVillage").html(data.nameVillage);
            },
            error:function(data)
            {
                alert('mal');
            }
        });
}

function showVillages(id)
{
    var newRoute = routeShowVillages.replace('parameter', id);
    var idMunicipality = { "idMunicipality" : $('#idMunicipality').val()} ;
    console.log(newRoute);

    $.ajax({
        url: newRoute,
        headers: {'X-CSRF-TOKEN':token},
        type: 'GET',
        datatype: 'json',
        data: idMunicipality,
        success:function(data)
        {
            console.log(data);
            $("#tableVilages").html(data.viewTable);
            $("#nameVillage").html(data.inputName);
            $("#titleMunicipality").html(data.titleMunicipality);
        },
        error:function(data)
        {
            alert('mal');
        }
    });
    
}

function saveVillage()
{
    var name = $('#newVillage').val();

    if(jQuery.isEmptyObject(name))
    {
        alert('Seleccione un Municipio y Coloque un Nombre de departamento');
    }
    else
    {
        var newRoute = routeSaveVillage.replace('parameter', name);
        var idMunicipality = { "idMunicipality" : $('#idMunicipality').val()} ;
        console.log(newRoute);

        $.ajax({
            url: newRoute,
            headers: {'X-CSRF-TOKEN':token},
            type: 'GET',
            datatype: 'json',
            data: idMunicipality,
            success:function(data)
            {
                console.log(data);
                $("#tableVilages").html(data.viewTable);
                $("#nameVillage").html(data.inputName);
            },
            error:function(data)
            {
                alert('mal');
            }
        });
    }
}

function deleteVillage(name)
{
    var newRoute = routeDeleteVillage.replace('parameter', name);
    var idMunicipality = { "idMunicipality" : $('#idMunicipality').val()} ;
    console.log(newRoute);

    $.ajax({
            url: newRoute,
            headers: {'X-CSRF-TOKEN':token},
            type: 'GET',
            datatype: 'json',
            data: idMunicipality,
            success:function(data)
            {
                console.log(data);
                $("#tableVilages").html(data.viewTable);
                $("#nameVillage").html(data.inputName);
            },
            error:function(data)
            {
                alert('mal');
            }
        });
}