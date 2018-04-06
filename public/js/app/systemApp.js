$(document).ready(function(){

    $('#optionsDepartament').change(function(){

        var parent = $(this).val();
        var newRoute = routeZonesList.replace('parameter', parent);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  var zones = data.list;
                  var table = data.table;
                  $("#optionsZones").html(zones);
                  $("#tableListSystems").html(table);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
    });

    $('#listGroup').change(function(){

        var group = $(this).val();
        var test = group.split(" ");
        var newRoute = routeSubGroup.replace('parameter',test[0]);
        // var newRoute = routeSubGroup.replace('parameter',group.split(" ")[0]);
        console.log(newRoute);

        $.ajax({
            url: newRoute,
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            datatype: 'json',
            success:function(data)
            {
                var zones = data.html;
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
    var token = $("#token").val();
    var input = document.getElementById("CloseCostModal" );
    input.checked = true;
    
    console.log(request);

    $.ajax({
          url: routeStorageCost,
          headers: {'X-CSRF-TOKEN': token},
          type: 'POST',
          datatype: 'json',
          data: request,
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

function searchSubGroup(group)
{
    var Group = group;
    console.log(Group);
}

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

function detectZone(idzone){
    
    if(idzone == null){
        alert("Elija una zona para crear un sistema");
        event.preventDefault();
    }
}

function calculateIndicators(){

    console.log(routeCalculateIndicators);
    
    $.ajax({
          url: routeCalculateIndicators,
          headers: {'X-CSRF-TOKEN': token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
                console.log(data);
                var indicators = data.html;
                $("#systemIndicators").html(indicators);
          },
          error:function(data)
          {
              alert('mal');
          }
      });
};

