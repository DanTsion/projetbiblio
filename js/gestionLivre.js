$(document).ready(function () {
    $(".btn-danger").click(function () 
    {
        var btnToDelete = $(this);
        var idToDelete = btnToDelete.val();
        var ajaxUrl = '../ajax/ajaxDeleteLivre.php';
        $.ajax
        ({
           type: "POST",
           url: ajaxUrl,
           data:{action:'delete', id: idToDelete},
           success:function() 
           {
              window.location.replace("../html/gestionLivre.php");
           },
           error: function()
           {
               alert("Problème lors de la suppression");
           },
           timeout: 40000
        });  
    });
    $(".btn-primary").click(function()
    {
        $("#updatediv").css("display", "block");
        var btnToUpdate = $(this);
        var idToUpdate = btnToUpdate.val();
        var ajaxUrl = '../ajax/ajaxSelectLivre.php';
        $.ajax
        ({
            type: "POST",
            url: ajaxUrl,
            data:{id: idToUpdate},
            method: 'POST',
            dataType: 'json',
            success: function(data)
            {
                var idLivre = data.idLivre;
                var titre = data.titre;
                var auteur = data.auteur;
                var editeur = data.editeur;
                var dateDeParution = data.dateDeParution;
                var isbn = data.isbn;
                $("#idLivre").attr("value", idLivre);
                $("#titre").attr("value", titre);
                $("#auteur").attr("value", auteur);
                $("#editeur").attr("value", editeur);
                $("#dateDeParution").attr("value", dateDeParution);
                $("#isbn").attr("value", isbn);
            },
            error: function()
            {
                alert("Ouverture du formulaire impossible");
            },
            timeout: 40000
        })
    });
    $("#cancel").click(function() 
    {
        $(this).parent().parent().hide();    
    });
    $("#cancelimg").click(function() {
        $(this).parent().parent().hide();
    });
    $("#update #cancelBtn").click(function() 
    {
        $(this).parent().parent().hide();    
    });
    $("#emprunt #cancelBtn").click(function() 
    {
        $(this).parent().parent().hide();    
    });
    $("#listeLivres").filterTable();
    $(".btn-info").click(function(){
        $("#empruntdiv").css("display", "block");
        var btnToBorrow = $(this);
        var idToBorrow = btnToBorrow.val();
        var ajaxUrl = '../ajax/ajaxSelectLivre.php';
        $.ajax
        ({
            type: "POST",
            url: ajaxUrl,
            data:{id: idToBorrow},
            method: 'POST',
            dataType: 'json',
            success: function(data)
            {
                var idLivre = data.idLivre;
                var titre = data.titre;
                $("#idLivreToBorrow").attr("value", idLivre);
                $("#livreToBorrow").text(titre);
            },
            error: function()
            {
                alert("Ouverture du formulaire impossible");
            },
            timeout: 40000
        })
    });
    $(".btn-warning").click(function(){
        var btnToDelete = $(this);
        var idToDelete = btnToDelete.val();
        var ajaxUrl = '../ajax/ajaxDeleteEmprunt.php';
        $.ajax
        ({
            type: "POST",
            url: ajaxUrl,
            data:{id: idToDelete},
            success: function()
            {
                window.location.replace("../html/gestionLivre.php");
            },
            error: function()
            {
                alert("Problème lors du retour du livre");
            },
            timeout: 40000
        })
    });
});