function verifNomClient(champ)
{
    var regex = /^[A-Z' ]+$/;
    if(!regex.test(champ.value))
    {
        $("#nom").css("border","1px solid red");
        $("#nomError").html("* Veuillez entrer un nom en Majuscule");
        return false;
    }
    else
    {
        $("#nom").css("border","1px solid #a0a0a0");
        $("#nomError").html("");
        return true;
    }
}

function verifPrenomClient(champ)
{
    var regex = /^[A-Z]{1}[a-zàáâäçèéêëìíîïñòóôöùúûü']+([-]{1}[A-Z]{1}[a-zàáâäçèéêëìíîïñòóôöùúûü']+)?$/;
    if(!regex.test(champ.value))
    {
        $("#prenom").css("border","1px solid red");
        $("#prenomError").html("* Veuillez entrer un prénom avec une Masjuscule");
        return false;
    }
    else
    {
        $("#prenom").css("border","1px solid #a0a0a0");
        $("#prenomError").html("");
        return true;
    }
}

function verifMail(champ)
{
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$/;
    if(!regex.test(champ.value))
    {
        $("#email").css("border","1px solid red");
        $("#emailError").html("* Veuillez entrer une adresse email valide");
        return false;
    }
    else
    {
        $("#email").css("border","1px solid #a0a0a0");
        $("#emailError").html("");
        return true;
    }
}

function verifCodePostal(champ)
{
    var regex = /^[0-9]{5}$/;
    if(!regex.test(champ.value))
    {
        $("#codePostal").css("border","1px solid red");
        $("#codePostalError").html("* Veuillez entrer un code postal a 5 chiffres");
        return false;
    }
    else
    {
        $("#codePostal").css("border","1px solid #a0a0a0");
        $("#codePostalError").html("");
        return true;
    }
}

function verifAdresse(champ)
{
    if(!champ.value)
    {
        $("#adresse").css("border","1px solid red");
        $("#adresseError").html("* Veuillez entrer un adresse postale valide");
        return false;
    }
    else
    {
        $("#adresse").css("border","1px solid #a0a0a0");
        $("#adresseError").html("");
        return true;
    }
}

function verifVille(champ)
{
    var regex = /^[A-Z -]{3,}$/;
    if(!regex.test(champ.value))
    {
        $("#ville").css("border","1px solid red");
        $("#villeError").html("* Veuillez entrer une ville en majuscule");
        return false;
    }
    else
    {
        $("#ville").css("border","1px solid #a0a0a0");
        $("#villeError").html("");
        return true;
    }
}

function verifDate(champ)
{
    var regex = /(0[1-9]|[1-2][0-9]|30|31)(\/)(0[1-9]|1[0-2])(\/)(1[0-9][0-9][0-9]|20[0-9][0-9])/;
    if(!champ.value && !regex.test(champ.value))
    {
        $("#dateDeNaissance").css("border","1px solid red");
        $("#dateDeNaissanceError").html("* Veuillez entrer une date valide");
        return false;
    }
    else
    {
        $("#dateDeNaissance").css("border","1px solid #a0a0a0");
        $("#dateDeNaissanceError").html("");
        return true;
    }
}

function verifForm(f)
{
    var nomOk = verifNomClient(f.nom);
    var prenomOk = verifPenomClient(f.prenom);
    var mailOk = verifMail(f.mail);
    var adresseOk = verifAdresse(f.adresse);
    var cpOk = verifCodePostal(f.codepostal);
    var villeOk = verifVille(f.ville);
    var dateOk = verifDate(f.dateDeNaissance);
    
    if( nomOk && prenomOk && mailOk && adresseOk && cpOk && villeOk && dateOk)
    {
    return true;
    }
    else
    {
        alert("Veuillez remplir correctement tous les champs ");
        return false;
    }
}