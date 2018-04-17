function deleteUserConfirm(){
    var deleteConfirm = confirm("Está seguro de borrar el usuario? ");
        if (deleteConfirm == false)
        {
            event.preventDefault();
        }  
}

function confirmCancel(){
    var cancelConfirm = confirm("Está seguro de cancelar? Se perderan los cambios ");
        if (cancelConfirm == false)
        {
            event.preventDefault();
        }  
}


function searchWord(){

    var parent = $("#InputSearchWord").val();
    var newRoute = routeSearchWord.replace('parameter', parent);
    console.log(newRoute);
    
    $.ajax({
          url: newRoute,
          headers: {'X-CSRF-TOKEN': token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
                var tableUsers = data.html;
                $("#ListUsersTable").html(tableUsers);
          },
          error:function(data)
          {
              alert('mal');
          }
      });
};

$(document).ready(function(){

    $("#InputSearchWord").keypress(function(event) {
        if(event.key == "Enter")
        {
            searchWord();
        }
    });
});