$(document).ready(function(){

    $('#listGroup').change(function(){

        var group = $(this).val();
        var test = group.split(" ");
        var newRoute = routeSubGroup.replace('parameter',test[0]);
        console.log(newRoute);

        $.ajax({
            url: newRoute,
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            datatype: 'json',
            success:function(data)
            {
                var zones = data.html;

                if(group == "Mano de Obra")
                {
                    var jornalValue = $("#jornalSystem").val();
                    $('#unitaryCost').prop("readonly", true)

                    if(jornalValue.trim().length == 0)
                    {
                        $('#unitaryCost').val("Escribir un Valor de Jornal");
                    }
                    else
                    {
                        $('#unitaryCost').val(jornalValue);
                    }
                }
                else
                {
                    $('#unitaryCost').val("")
                    $('#unitaryCost').prop("readonly", false)
                }

                $("#listSubGroup").html(zones);

            },
            error:function(data)
            {
                alert('mal');
            }
        });
    });

});

function saveCost(){
    var request = $("#newCost").serializeArray();
    var test = $("#detailTest").val();
    var token = $("#token").val();
    var inputClose = document.getElementById("CloseCostModal");
    var inputShow = document.getElementById("ShowCostModal");

    console.log(request);
    console.log(test);

    $.ajax({
        url: routeStorageCost,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        datatype: 'json',
        data: request,
        success:function(data)
        {   
            var modalCost = data.modal;
            var tableCost = data.table;
            $("#costModal").html(modalCost);
            
            if(data.validation)
            {
                inputClose.checked = false;
                inputShow.checked = true;        
            }
            else
            {
                inputClose.checked = true;
                inputShow.checked = false;
                $("#BodyCostTable").html(tableCost);
            }
              
        },
        error:function(data)
        {
            alert('mal');
        }
    });
};

function deleteCost(id){

    var newRoute = routeDeleteCost.replace('parameter',id);
    console.log(newRoute);

    $.ajax({
          url: newRoute,
          headers: {'X-CSRF-TOKEN': token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
                var costs = data.html;
                $("#BodyCostTable").html(costs);
          },
          error:function(data)
          {
              alert('mal');
          }
      });
};

function saveEntry(){
    var request = $("#newEntry").serializeArray();
    var token = $("#token").val();
    console.log(request);

        $.ajax({
            url: routeStorageEntry,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            datatype: 'json',
            data: request,
            success:function(data)
            {
                var entries = data.html;
                $("#BodyEntryTable").html(entries);
            },
            error:function(data)
            {
                alert('mal');
            }
        });
};

function deleteEntry(id){

    var newRoute = routeDeleteEntry.replace('parameter',id);
    console.log(newRoute);

    $.ajax({
          url: newRoute,
          headers: {'X-CSRF-TOKEN': token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
                var entries = data.html;
                $("#BodyEntryTable").html(entries);
          },
          error:function(data)
          {
              alert('mal');
          }
      });
};