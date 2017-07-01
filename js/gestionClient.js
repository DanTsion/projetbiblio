$(document).ready(function () {
    $(".btn-primary").click(function () {
        $("#updatediv").css("display", "block");
        var btnToUpdate = $(this);
        var idToUpdate= btnToUpdate.val();
        var ajaxUrl = '../ajax/ajaxSelectClient.php';
        $.ajax({
           type: "POST",
           url: ajaxUrl,
           data:{id: idToUpdate},
           method: 'POST',
           dataType: 'json',
           success:function(data) {
               
             var idClient = data.idClient;
             var nom = data.nom;
             var prenom = data.prenom;
             var dateDeNaissance = data.dateDeNaissance;
             var email = data.email;
             var adresse = data.adresse;
             var codePostal = data.codePostal;
             var ville = data.ville;
             $("#idClient").attr("value", idClient);
             $("#nom").attr("value", nom);
             $("#prenom").attr("value", prenom);
             $("#dateDeNaissance").attr("value", dateDeNaissance);
             $("#email").attr("value", email);
             $("#adresse").attr("value", adresse);
             $("#codePostal").attr("value", codePostal);
             $("#ville").attr("value", ville);
           },
           error: function () {
                alert("Ouverture du formulaire impossible");
           },
           timeout: 40000
      });  
});
$(".btn-danger").click(function () 
    {
        var btnToDelete = $(this);
        var idToDelete = btnToDelete.val();
        var ajaxUrl = '../ajax/ajaxDeleteClient.php';
        $.ajax
        ({
           type: "POST",
           url: ajaxUrl,
           data:{id: idToDelete},
           success:function() 
           {
              window.location.replace("../html/gestionClient.php");
           },
           error: function()
           {
               alert("Problème lors de la suppression");
           },
           timeout: 40000
        });  
    });
$("#cancel").click(function() {
    $(this).parent().parent().hide();
});
$("#update #cancelBtn").click(function() {
    $(this).parent().parent().hide();
});
$("#listeClients").filterTable();
});