$(document).ready(function()
{
    $(".btn-default").click(function()
    {
        var idLivre = $("#livre").val();
        var idClient = $("#client").val();
        var ajaxUrl = '../ajax/ajaxCreateEmprunt.php';
        $.ajax
        ({
            type: "POST",
            url: ajaxUrl,
            data: {idClient: idClient, idLivre: idLivre},
            success: function()
            {
                window.location.replace("../html/gestionLivre.php");
            },
            error: function()
            {
                alert("Emprunt impossible");
            },
            timeout: 40000
        });
    });
});