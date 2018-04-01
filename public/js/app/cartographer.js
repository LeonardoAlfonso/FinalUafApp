$(document).ready(function(){

    $('#fileControl').change(function(){

        var parent = $(this).val().split("\\");
        var name = parent[parent.length-1];
        $("#addMap").html(name);
    });
    
    $("#IPAP").click(function() {
        $("#IPAP").val('');
    });

    $("#IPAP").keyup(function(event) {
        var IPAP = document.getElementById('IPAP').value;
        var IPS = document.getElementById('IPS').value;
        var IVPR = parseInt(IPAP) + parseInt(IPS);
        $("#IVPR").val(IVPR);

        console.log(IVPR);
    });

    $("#IPS").click(function() {
        $("#IPS").val('');
    });

    $("#IPS").keyup(function(event) {
        var IPAP = document.getElementById('IPAP').value;
        var IPS = document.getElementById('IPS').value;
        var IVPR = parseInt(IPAP) + parseInt(IPS);
        console.log(IVPR);
        $("#IVPR").val(IVPR);
    });
});
