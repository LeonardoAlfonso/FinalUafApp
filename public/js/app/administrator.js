$(document).ready(function(){

    $('#deleteUserJS').click(function(event){
        var deleteConfirm = confirm("Está seguro de borrar el usuario? ");
                if (deleteConfirm == false)
                {
                    event.preventDefault();
                }  
        });

        $('#SaveChangesUser').click(function(){
                alert("Cambios Guardados");
            });

    });