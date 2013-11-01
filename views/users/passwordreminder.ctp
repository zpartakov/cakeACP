<?php 
/*
 * form to fill before sending back a new password to the registred user
 */
?>
<style>
.error {
background-color: lightyellow;
color: red;
font-size: 1.5em;
padding: 10px;
margin: 5px;
}
</style>
<script>
$(document).ready(function() {
	 
    $('#btn-submit').click(function() { 
 
        $(".error").hide();
        var hasError = false;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 
        var emailaddressVal = $("#UserEmail").val();
        if(emailaddressVal == '') {
            $("#UserEmail").after('<span class="error">Merci de renseigner votre adresse email.</span>');
            hasError = true;
        }
 
        else if(!emailReg.test(emailaddressVal)) {
            $("#UserEmail").after('<span class="error">Entrer une adresse email valide SVP.</span>');
            hasError = true;
        }
 
        if(hasError == true) { return false; }
 
    });
});
</script>

<?php
//password reminder

$this->pageTitle = "Envoyer un nouveau mot de passe";
?> 
<h1><? echo $this->pageTitle; ?></h1>
Veuillez compléter les champs ci dessous pour obtenir un nouveau mot de passe.<br /> 
Un email avec votre nouveau mot de passe vous sera envoyé à l'adresse de courriel utilisée lors de votre enregistrement. 
<br />
<br />

<form method="GET" id="form_id" action="<? echo CHEMIN; ?>users/renvoiemail"  onsubmit="validate(); return false">
Votre email: <input id="UserEmail" type="text" name="email">
<input type="submit" value="Renvoyer le mot de passe" id="btn-submit">
</form>
<br />
<ul>
<li>Vous n'avez pas encore de compte?</li>
<li>Le système de renvoi ne marche pas?</li>
<li>Vous avez changé d'email?</li>
</ul>
<br />
-> Veuillez <a href="http://www.p2r.ch/accueil_e.html">contacter p2r</a>

