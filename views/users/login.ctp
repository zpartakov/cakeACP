<?php
$this->pageTitle = "Authentification";
App::import('Lib', 'functions'); //imports app/libs/functions 

?> 
<h1><? echo $this->pageTitle; ?></h1>
<? #if ($session->check('Message.auth')) $session->flash('auth');?> 
 <?/* if ($this->$Session->check('Message.auth')) $this->Ssession->flash('auth');*/?> 
 <?
echo $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
    echo $form->input('username', array('label' => 'Utilisateur'));
    echo $form->input('password', array('label' => 'Mot de passe'));
    echo $form->end('Login');
?>

 <br />
<ul>
<li>Mot de passe oublié? <a href="<? echo CHEMIN; ?>users/passwordreminder">Faites-vous envoyer votre mot de passe</a></li>
<li>Vous n'avez pas encore de compte? <a href="http://www.p2r.ch/inscription_b.html">Enregistrez-vous</a></li>
</ul>

<br>
<br>
<h1><a href=logout>Logout</a></h1>
