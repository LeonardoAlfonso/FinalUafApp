$(document).ready(function(){

    $('#fileControl').change(function(){

        var parent = $(this).val().split("\\");
        var name = parent[parent.length-1];
        $("#addMap").html(name);
        $("#fileState").val(name);
    });

    $("#Temperatura").click(function() {
        $("#Temperatura").val('');
    });

    $("#Altitud").click(function() {
        $("#Altitud").val('');
    });

    $("#IPAP").click(function() {
        $("#IPAP").val('');
    });

    $("#IPAP").keyup(function(event) {
        var IPAP = document.getElementById('IPAP').value;
        var IPS = document.getElementById('IPS').value;
        var IVPR = (parseInt(IPAP) + parseInt(IPS))/2;
        $("#IVPR").val(IVPR);

        console.log(IVPR);
    });

    $("#IPS").click(function() {
        $("#IPS").val('');
    });

    $("#IPS").keyup(function(event) {
        var IPAP = document.getElementById('IPAP').value;
        var IPS = document.getElementById('IPS').value;
        var IVPR = (parseInt(IPAP) + parseInt(IPS))/2;
        console.log(IVPR);
        $("#IVPR").val(IVPR);
    });

    $('#CancelButton').click(function(event){
        var cancelConfirm = confirm("Está seguro de Cancelar? Perderá todos los cambios");
            if (cancelConfirm == false)
            {
                event.preventDefault();
            }  
    });

});

function deleteZoneConfirm(){
    var deleteConfirm = confirm("Está seguro de borrar la Zona?");
        if (cancelConfirm == false)
        {
            event.preventDefault();
        }  
};
