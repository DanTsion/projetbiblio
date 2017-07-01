function verifTitre(champ)
{
    if(!champ.value)
    {
        $("#titre").css("border","1px solid red");
        $("#titreError").html("* Veuillez entrer un titre");
        return false;
    }
    else
    {
        $("#titre").css("border","1px solid #a0a0a0");
        $("#titreError").html("");
        return true;
    }
}

function verifAuteur(champ)
{
    var regex = /^[A-Z]{1}[A-Za-zàáâäçèéêëìíîïñòóôöùúûü ,.'-]+$/;
    if(!regex.test(champ.value))
    {
        $("#auteur").css("border","1px solid red");
        $("#auteurError").html("* Veuillez entrer un auteur avec une majuscule");
        return false;
    }
    else
    {
        $("#auteur").css("border","1px solid #a0a0a0");
        $("#auteurError").html("");
        return true;
    }
}

function verifEditeur(champ)
{
    var regex = /^[A-Z]{1,}[A-Za-z ,.'-]+$/;
    if(!regex.test(champ.value))
    {
        $("#editeur").css("border","1px solid red");
        $("#editeurError").html("* Veuillez entrer un editeur avec une majuscule");
        return false;
    }
    else
    {
        $("#editeur").css("border","1px solid #a0a0a0");
        $("#editeurError").html("");
        return true;
    }
}

function verifIsbn(champ)
{
    var regex = /^(ISBN){1}[ ]{1}[0-9]{3}[ ]{1}[0-9]{1}[ ]{1}[0-9]{4}[ ]{1}[0-9]{4}[ ]{1}[0-9]{1}$/;
    if(!regex.test(champ.value))
    {
        $("#isbn").css("border","1px solid red");
        $("#isbnError").html("* Veuillez entrer ISBN valide ex: ISBN 000 0 0000 0000 0");
        return false;
    }
    else
    {
        $("#isbn").css("border","1px solid #a0a0a0");
        $("#isbnError").html("");
        return true;
    }
    
function verifDateDeParution(champ)
{
    var regex = /(0[1-9]|[1-2][0-9]|30|31)(\/)(0[1-9]|1[0-2])(\/)(1[0-9][0-9][0-9]|20[0-9][0-9])/;
    if(!regex.test(champ.value))
    {
        $("#dateDeParution").css("border","1px solid red");
        $("#dateDeParutionError").html("* Veuillez entrer une date valide");
        return false;
    }
    else
    {
        $("#dateDeParution").css("border","1px solid #a0a0a0");
        $("#dateDeParutionError").html("");
        return true;
    }
}
}

function verifForm(f)
{
    var titreOk = verifTitre(f.titre);
    var auteurOk = verifAuteur(f.auteur);
    var editeurOk = verifEditeur(f.editeur);
    var isbnOk = verifIsbn(f.isbn);
    var dateDeParutionOk = verifDateDeParution(f.dateDeParution);
    
    if( titreOk && auteurOk && editeurOk && isbnOk && dateDeParutionOk)
    {
        return true;
    }
    else
    {
        alert("Veuillez remplir correctement tous les champs ");
        return false;
    }
}    
