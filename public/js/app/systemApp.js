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

$(document).ready(function(){

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
                console.log(data);
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
    console.log(request);

    $.ajax({
          url: routeStorageCost,
          headers: {'X-CSRF-TOKEN': token},
          type: 'POST',
          datatype: 'json',
          data: request,
          success:function(data)
          {
                console.log(data);
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
                console.log(data);
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


