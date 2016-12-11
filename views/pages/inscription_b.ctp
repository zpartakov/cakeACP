<?php
echo "fixme"; exit;

/* Copyright (C) 2001-2002	Rodolphe Quiedeville	<rodolphe@quiedeville.org>
 * Copyright (C) 2001-2002	Jean-Louis Bergamo		<jlb@j1b.org>
 * Copyright (C) 2006-2013	Laurent Destailleur		<eldy@users.sourceforge.net>
 * Copyright (C) 2012		Regis Houssin			<regis.houssin@capnetworks.com>
 * Copyright (C) 2012		J. Fernando Lagrange    <fernando@demo-tic.org>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *	\file       htdocs/public/members/new.php
 *	\ingroup    member
 *	\brief      Example of form to add a new member
 *
 *  Note that you can add following constant to change behaviour of page
 *  MEMBER_NEWFORM_AMOUNT               Default amount for autosubscribe form
 *  MEMBER_NEWFORM_EDITAMOUNT           Amount can be edited
 *  MEMBER_NEWFORM_PAYONLINE            Suggest paypemt with paypal of paybox
 *  MEMBER_NEWFORM_DOLIBARRTURNOVER     Show field turnover (specific for dolibarr foundation)
 *  MEMBER_URL_REDIRECT_SUBSCRIPTION    Url to redirect once subscribe submitted
 *  MEMBER_NEWFORM_FORCETYPE            Force type of member
 *  MEMBER_NEWFORM_FORCEMORPHY          Force nature of member (mor/phy)
 *  MEMBER_NEWFORM_FORCECOUNTRYCODE     Force country
 */

define("NOLOGIN",1);		// This means this output page does not require to be logged.
define("NOCSRFCHECK",1);	// We accept to go on this page from external web site.

// For MultiCompany module
$entity=(! empty($_GET['entity']) ? (int) $_GET['entity'] : (! empty($_POST['entity']) ? (int) $_POST['entity'] : 1));
if (is_numeric($entity)) define("DOLENTITY", $entity);

require '../web/gestion/main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/adherents/class/adherent.class.php';
require_once DOL_DOCUMENT_ROOT.'/adherents/class/adherent_type.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/extrafields.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formcompany.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';

// Init vars
$errmsg='';
$num=0;
$error=0;
$backtopage=GETPOST('backtopage','alpha');
$action=GETPOST('action','alpha');

// Load translation files
$langs->load("main");
$langs->load("members");
$langs->load("companies");
$langs->load("install");
$langs->load("other");

// Security check
if (empty($conf->adherent->enabled)) accessforbidden('',1,1,1);

if (empty($conf->global->MEMBER_ENABLE_PUBLIC))
{
    print $langs->trans("Auto subscription form for public visitors has not been enabled");
    exit;
}

$extrafields = new ExtraFields($db);


/**
 * Show header for new member
 *
 * @param 	string		$title				Title
 * @param 	string		$head				Head array
 * @param 	int    		$disablejs			More content into html header
 * @param 	int    		$disablehead		More content into html header
 * @param 	array  		$arrayofjs			Array of complementary js files
 * @param 	array  		$arrayofcss			Array of complementary css files
 * @return	void
 */
function llxHeaderVierge($title="Formulaire d'inscription à la coopérative le panier bio a deux roues", $head="", $disablejs=0, $disablehead=0, $arrayofjs='', $arrayofcss='')
{
    global $user, $conf, $langs, $mysoc;
    top_htmlhead($head, $title="Formulaire d'inscription à la coopérative le panier bio a deux roues", $disablejs, $disablehead, $arrayofjs, $arrayofcss); // Show html headers
//    print '<head>';
//		<link type="text/css" rel="stylesheet" href="declaration2.css"/>';
    print '        <LINK REL="SHORTCUT ICON" href="images/favicon.ico">
<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == "block")
          e.style.display = "none";
       else
          e.style.display = "block";
    }
//-->
</script>
<style>h3, p, li, ul{
	padding: 0px;
	margin: 0px;
	font-family: "trebuchet MS";
	font-size:14px;
}

html{
	overflow:-moz-scrollbars-vertical;
	overflow-y:scroll;
}
body{
	background-image:url(images/template.jpg)

}
a:link {font-family: "trebuchet MS";font-weight:normal;}
.jnotify-container {max-height: 2070px !important;}
#page{
	width: 880px;
	background-color: #FFFFFF;
	margin:0px auto;

	padding: 10px;

}

/*Coin arrondis*/
#fond{
	background-image:url(images/page_up.png);
	background-repeat:no-repeat;
	background-position:bottom;
	margin:0px auto;
	width: 900px;
	height: 47px;
}
#image{
	background-image: url(images/p2r_Logo_last_vert.png);
	background-repeat:no-repeat;
	background-position: left;
	height: 178px;
	width:188px;
	margin-left:40px;
	margin-top:30px;
	margin-bottom:10px;
	float:left;
	position:relative;


}
#image1{
	/*background-image: url(images/cadre_kiwi.gif);
	background-repeat:no-repeat;*/
	width:600px;
	height:180px;
	float:left;
	margin-top:40px;
	margin-bottom:5px;
	margin-left:10px;
	position:relative;
	left: 10px;

}
#image1 img{
	border:0px;
}

/*menu*/
#principal{
	text-align:left;
	padding-bottom:0px;
	margin-top:40px;
	clear:both;
	border-bottom: 1px solid #ccc;
	width:795px;
	margin-left:auto;
	margin-right:auto;


}
#principal li{
	display:inline;
	padding-left:80px;


}
#principal a{
	text-decoration:none;
	color: #000000;
	font-size: 18px;
}
#principal a:hover{
	color: #6BAB21;

}
#principal a.active{
	color: #6BAB21;

}
#sstitres {
	text-align: left;
	margin:auto;
	font-size:10px;
	padding-left:100px;
	padding-top:5px;
	width:795px;


}

#sstitres li{
	display:inline;
	padding-left:20px;
}
#sstitres a{
	text-decoration:none;
	color:#000000;
	font-size:12px;
}
#sstitres a:hover{
	color: #6BAB21;
}
#sstitres a.active{
	color: #6BAB21;
}
.vert{
	color:#6BAB21;
	font-size: 40px;
}
/* texte */
br{
	margin-bottom:5px;
}
p{
	margin-bottom:5px;
}
p a{
	text-decoration:none;
}
p a:hover{
	text-decoration:underline;
}
#col_left{
	display:block;
	width:360px;
	padding-right:5px;
	float:left;
	text-align:justify;
	margin-bottom:40px;

}
#col_left_accueil{
	display:block;
	width:500px;
	padding-right:5px;
	float:left;
	text-align:justify;
	margin-bottom:40px;

}

#col_right{
	text-align:justify;
	width:360px;
	float:left;
	padding-left:67px;
	padding-top:0px;
}


#col_right_accueil{
    text-align:left;
    width:200px;
	float:right;
	padding-left:10px;
	padding-top:0px;
	padding-right:10px;
	border:1px solid #6BAB21;;
}
#col_right_acp{
    text-align:left;
    width:200px;
	float:right;
	padding-left:10px;
	padding-top:0px;
	padding-right:10px;
	border:1px solid #6BAB21;;
	margin-top: 40px;
}

#col_right_recettes1{
    text-align:left;
    width:200px;
	float:right;
	padding-left:10px;
	padding-top:0px;
	padding-right:10px;
	border:1px solid #6BAB21;;
	margin-top:0px;
}
#col_right_recettes2{
    text-align:left;
    width:200px;
	float:right;
	padding-left:10px;
	padding-top:0px;
	padding-right:10px;
	border:1px solid #6BAB21;;
	margin-top:330px;
}



#col_right_titre{
	text-align:justify;
	width:360px;
	float:left;
	padding-left:67px;

}
h3{
	margin-bottom: 15px;
	margin-top: 0px;
	color:#6BAB21;
	font-size:14pt;
}
h3 a{
	color:#551A8B;


}
h3 a:hover{

}
h4{
	color:#6BAB21;
	margin-top: 25px;
	margin-bottom:20px;

	padding-top:20px;
}
h5{
	color:#76171D;
	margin-top:10px;
	font-size:13pt;
	text-align:left;
	margin-bottom:5px;
}
#texte{
	font-family:Arial;
	width:800px;
	margin:0px auto;
	padding-top: 60px;
	word-spacing:0.1em;
}
#texte ul{
	margin-top: 15px;
	list-style:circle;
	margin-bottom:5px;
	padding-left:15px;


}
#texte ul.recette{
	list-style:none;
	padding:0px;

	width:448px;
	padding:5px;
	margin-top:10px;
	margin-bottom:20px;
	float:left;
}
#texte ul.recette2{
	float:left;
	width:300px;
	padding-top:96px;
	margin-left:20px;
	list-style: decimal;
	margin-bottom:60px;
	margin-top:30px;
}
/* pied de page */
#pied p{
	text-align:center;
	font-size: 11px;
	width: 500px;
	border-top: 1px solid  #000000;
	margin:auto;
	margin-top:0px;
	padding-top: 5px;
	margin-bottom:0px;
	color: #000000;

}
#pied{
	clear:both;
	padding-top:10px;

}
</style>';
//</head>';
    print '<body id="mainbody" class="publicnewmemberform" style="background-image: url(/images/template.jpg);">';
    print '<div id="page">
	<a href="/"><div id="titre">    </div>

  <div id="image"></div>
  <div id="image1">
  	<img src="images/carottes.jpg" alt="" />

  </div></a>


    <ul id="principal">
        <li><a href="index.html">ACCUEIL</a></li>
        <li><a href="cooperative_a.html">LA COOPERATIVE</a></li>
        <li><a href="paniers_a.html">LES PANIERS</a></li>
        <li><a href="inscription_a.html" class="active">INSCRIPTION</a></li>
    </ul>


    <ul id="sstitres">
        <li><a href="inscription_a.html">démarche d\'inscription et obligations de coopérateur</a></li>

        <li><a href="inscription_b.php"  class="active">formulaire d\'inscription</a></li>

    </ul>

    <div id="texte">
    <h3>FORMULAIRE D\'INSCRIPTION</h3>';
}

/**
 * Show footer for new member
 *
 * @return	void
 */
function llxFooterVierge()
{
    print '</div>';

    printCommonFooter('public');

    print '  </div>
</div><div id="fond">
  <div id="pied">
    <p>© 2012 • Le panier bio à deux roues • contact: info(at)p2r.ch</p>
  </div>
</div>
</body>';
    print "</html>";
}



/*
 * Actions
 */

// Action called when page is submited
if ($action == 'add')
{
    if (empty($_POST["civility_id"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "Veuillez sélectionner un titre civilité<br>\n";
    }
    // test if login already exists
    if (empty($conf->global->ADHERENT_LOGIN_NOT_REQUIRED))
    {
        if(! GETPOST('login'))
        {
            $error+=1;
            $errmsg .= $langs->trans("ErrorFieldRequired",$langs->transnoentitiesnoconv("Login"))."<br>\n";
        }
        $sql = "SELECT login FROM ".MAIN_DB_PREFIX."adherent WHERE login='".$db->escape(GETPOST('login'))."'";
        $result = $db->query($sql);
        if ($result)
        {
            $num = $db->num_rows($result);
        }
        if ($num !=0)
        {
            $error+=1;
            $langs->load("errors");
            $errmsg .= $langs->trans("ErrorLoginAlreadyExists")."<br>\n";
        }
        if (!isset($_POST["pass1"]) || !isset($_POST["pass2"]) || $_POST["pass1"] == '' || $_POST["pass2"] == '' || $_POST["pass1"]!=$_POST["pass2"])
        {
            $error+=1;
            $langs->load("errors");
            $errmsg .= $langs->trans("ErrorPasswordsMustMatch")."<br>\n";
        }
        if (! GETPOST("email"))
        {
            $error+=1;
            $errmsg .= $langs->trans("ErrorFieldRequired",$langs->transnoentitiesnoconv("EMail"))."<br>\n";
        }//Ajout AlainR
                $sql = "SELECT email FROM ".MAIN_DB_PREFIX."adherent WHERE email='".$db->escape(GETPOST('email'))."'";
        $result = $db->query($sql);
        if ($result)
        {
            $num = $db->num_rows($result);
        }
        if ($num !=0)
        {
            $error+=1;
            $langs->load("errors");
            $errmsg .= "L'adresse électronique existe déjà.<br>\n";
        }

    }
    if (GETPOST('type') <= 0)
    {
        $error+=1;
        $errmsg .= $langs->trans("ErrorFieldRequired",$langs->transnoentitiesnoconv("Type"))."<br>\n";
    }
    if (! in_array(GETPOST('morphy'),array('mor','phy')))
    {
        $error+=1;
        $errmsg .= $langs->trans("ErrorFieldRequired",$langs->transnoentitiesnoconv('Nature'))."<br>\n";
    }
    if (empty($_POST["lastname"]))
    {
        $error+=1;
        $errmsg .= $langs->trans("ErrorFieldRequired",$langs->transnoentitiesnoconv("Lastname"))."<br>\n";
    }
    if (empty($_POST["firstname"]))
    {
        $error+=1;
        $errmsg .= $langs->trans("ErrorFieldRequired",$langs->transnoentitiesnoconv("Firstname"))."<br>\n";
    }
    if (GETPOST("email") && ! isValidEmail(GETPOST("email")))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= $langs->trans("ErrorBadEMail",GETPOST("email"))."<br>\n";
    }
    $birthday=dol_mktime($_POST["birthhour"],$_POST["birthmin"],$_POST["birthsec"],$_POST["birthmonth"],$_POST["birthday"],$_POST["birthyear"]);
    if ($_POST["birthmonth"] && empty($birthday))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= $langs->trans("ErrorBadDateFormat")."<br>\n";
    }
    if (! empty($conf->global->MEMBER_NEWFORM_DOLIBARRTURNOVER))
    {
        if (GETPOST("morphy") == 'mor' && GETPOST('budget') <= 0)
        {
            $error+=1;
            $errmsg .= $langs->trans("ErrorFieldRequired",$langs->transnoentitiesnoconv("TurnoverOrBudget"))."<br>\n";
        }
    }//Ajout AlainR : vérification des champs vides suivants : adresse, NPA, localité, au moins 1 tél., champs complémentaires
    if (empty($_POST["address"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "L'adresse est obligatoire<br>\n";
    }
    if (empty($_POST["zipcode"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "Le code postal est obligatoire<br>\n";
    }
    if (empty($_POST["town"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "La localité est obligatoire<br>\n";
    }
    if (empty($_POST["phone_perso"]) AND empty($_POST["phone_mobile"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "L'indication d'au moins 1 num. de tél. est obligatoire<br>\n";
    }
    if (empty($_POST["options_TaillePanier"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "Veuillez choisir une taille de panier<br>\n";
    }
    if (empty($_POST["options_Oeufs"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "Veuillez vous déterminer par rapport à l'abonnement Oeufs<br>\n";
    }
    if (empty($_POST["options_fromage"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "Veuillez vous déterminer par rapport à l'abonnement Fromage<br>\n";
    }
    if (empty($_POST["options_Categorie_point_distrib"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "Veuillez sélectionner un point de livraison<br>\n";
    }
    if (empty($_POST["options_paiements"]))
    {
        $error+=1;
        $errmsg .= "Veuillez choisir une fréquence de paiement<br>\n";
    }
    if (empty($_POST["statuts"]))
    {
        $error+=1;
        $langs->load("errors");
        $errmsg .= "L'acceptation des statuts est obligatoire<br>\n";
    }

    if (isset($public)) $public=1;
    else $public=0;

    if (! $error)
    {
        // email a peu pres correct et le login n'existe pas
        $adh = new Adherent($db);
        $adh->statut      = -1;
        $adh->public      = $_POST["public"];
        $adh->firstname   = $_POST["firstname"];
        $adh->lastname    = $_POST["lastname"];
        $adh->civility_id = $_POST["civility_id"];
        $adh->societe     = $_POST["societe"];
        $adh->address     = $_POST["address"];
        $adh->zip         = $_POST["zipcode"];
        $adh->town        = $_POST["town"];
        $adh->phone_perso = $_POST["phone_perso"];
        $adh->phone_mobile = $_POST["phone_mobile"];
        $adh->email       = $_POST["email"];
        if (empty($conf->global->ADHERENT_LOGIN_NOT_REQUIRED))
        {
            $adh->login       = $_POST["login"];
//            $adh->pass        = $_POST["pass1"];
//            $adh->pass        = md5(u4uGYrPWiRd8cEshMV3LuLrm2Ix5Lo5zv9YuiruY.$_POST["pass1"]);
            $adh->pass        = sha1(u4uGYrPWiRd8cEshMV3LuLrm2Ix5Lo5zv9YuiruY.$_POST["pass1"]);
        }
        $adh->photo       = $_POST["photo"];
        $adh->note        = $_POST["note"];
        $adh->country_id  = $_POST["country_id"];
        $adh->state_id    = $_POST["state_id"];
        $adh->typeid      = $_POST["type"];
        $adh->note        = $_POST["comment"];
        $adh->morphy      = $_POST["morphy"];
        $adh->birth       = $birthday;


        // Fill array 'array_options' with data from add form
        $extralabels=$extrafields->fetch_name_optionals_label($adh->table_element);
        $ret = $extrafields->setOptionalsFromPost($extralabels,$adh);
		if ($ret < 0) $error++;

        $result=$adh->create($user);
        if ($result > 0)
        {
			require_once DOL_DOCUMENT_ROOT.'/core/class/CMailFile.class.php';

            // Send email to say it has been created and will be validated soon...
            if (! empty($conf->global->ADHERENT_AUTOREGISTER_MAIL) && ! empty($conf->global->ADHERENT_AUTOREGISTER_MAIL_SUBJECT))
            {
                $result=$adh->send_an_email($conf->global->ADHERENT_AUTOREGISTER_MAIL,$conf->global->ADHERENT_AUTOREGISTER_MAIL_SUBJECT,array(),array(),array(),"","",0,-1);
            }

            // Send email to the foundation to say a new member subscribed with autosubscribe form
            if (! empty($conf->global->MAIN_INFO_SOCIETE_MAIL) && ! empty($conf->global->ADHERENT_AUTOREGISTER_NOTIF_MAIL_SUBJECT) &&
                  ! empty($conf->global->ADHERENT_AUTOREGISTER_NOTIF_MAIL) )
            {
            	$to=$adh->makeSubstitution($conf->global->MAIN_INFO_SOCIETE_MAIL);
            	$from=$conf->global->ADHERENT_MAIL_FROM;
				$mailfile = new CMailFile(
					$conf->global->ADHERENT_AUTOREGISTER_NOTIF_MAIL_SUBJECT,
					$to,
					$from,
					$adh->makeSubstitution($conf->global->ADHERENT_AUTOREGISTER_NOTIF_MAIL),
					array(),
					array(),
					array(),
					"",
					"",
					0,
					-1
				);

            	if (! $mailfile->sendfile())
            	{
            		dol_syslog($langs->trans("ErrorFailedToSendMail",$from,$to), LOG_ERR);
            	}
            }

            if (! empty($backtopage)) $urlback=$backtopage;
            else if (! empty($conf->global->MEMBER_URL_REDIRECT_SUBSCRIPTION))
            {
                $urlback=$conf->global->MEMBER_URL_REDIRECT_SUBSCRIPTION;
                // TODO Make replacement of __AMOUNT__, etc...
            }
            else $urlback=$_SERVER["PHP_SELF"]."?action=added";

            if (! empty($conf->global->MEMBER_NEWFORM_PAYONLINE))
            {
                if ($conf->global->MEMBER_NEWFORM_PAYONLINE == 'paybox')
                {
                    $urlback=DOL_MAIN_URL_ROOT.'/public/paybox/newpayment.php?from=membernewform&source=membersubscription&ref='.$adh->ref;
                    if (price2num(GETPOST('amount'))) $urlback.='&amount='.price2num(GETPOST('amount'));
                    if (GETPOST('email')) $urlback.='&email='.urlencode(GETPOST('email'));
                    if (! empty($entity)) $urlback.='&entity='.$entity;
                }
                else if ($conf->global->MEMBER_NEWFORM_PAYONLINE == 'paypal')
                {
                    $urlback=DOL_MAIN_URL_ROOT.'/public/paypal/newpayment.php?from=membernewform&source=membersubscription&ref='.$adh->ref;
                    if (price2num(GETPOST('amount'))) $urlback.='&amount='.price2num(GETPOST('amount'));
                    if (GETPOST('email')) $urlback.='&email='.urlencode(GETPOST('email'));
                    if (! empty($conf->global->PAYPAL_SECURITY_TOKEN) && ! empty($conf->global->PAYPAL_SECURITY_TOKEN_UNIQUE))
                    {
                    	$urlback.='&securekey='.dol_hash($conf->global->PAYPAL_SECURITY_TOKEN . 'membersubscription' . $adh->ref, 2);
                    }
                    if (! empty($entity)) $urlback.='&entity='.$entity;
                }
                else
                {
                    dol_print_error('',"Autosubscribe form is setup to ask an online payment for a not managed online payment");
                    exit;
                }
            }

            dol_syslog("member ".$adh->ref." was created, we redirect to ".$urlback);
            Header("Location: ".$urlback);
            exit;
        }
        else
        {
            $errmsg .= join('<br>',$adh->errors);
        }
    }
}

// Action called after a submited was send and member created succesfully
// If MEMBER_URL_REDIRECT_SUBSCRIPTION is set to url we never go here because a redirect was done to this url.
// backtopage parameter with an url was set on member submit page, we never go here because a redirect was done to this url.
if ($action == 'added')
{
    llxHeaderVierge($langs->trans("NewMemberForm"));

    // Si on a pas ete redirige
    print $langs->trans("NewMemberbyWeb");// "Merci de votre inscription. Veuillez patienter, un collaborateur prendra contact avec vous."
    print '</center>';

    llxFooterVierge();
    exit;
}



/*
 * View
 */

$form = new Form($db);
$formcompany = new FormCompany($db);
$adht = new AdherentType($db);
$extrafields->fetch_name_optionals_label('adherent');    // fetch optionals attributes and labels


llxHeaderVierge($langs->trans("NewSubscription"));
    print '<div><p>Veuillez indiquer vos coordonnées complètes (un seul nom svp!), la taille du panier désiré, le type de paiement, ainsi que le lieu de livraison.</p>
    	 <p>Il se peut que certains points de livraison soient saturés. Dans ce cas nous vous contacterons pour trouver une alternative.</p>
		 <p>Une fois le formulaire rempli, cliquez sur "enregistrer".</p><br>';

/*print_titre($langs->trans("NewSubscription"));

if (! empty($conf->global->MEMBER_NEWFORM_TEXT)) print $langs->trans($conf->global->MEMBER_NEWFORM_TEXT)."<br>\n";
else print $langs->trans("NewSubscriptionDesc",$conf->global->MAIN_INFO_SOCIETE_MAIL)."<br>\n";
*/
dol_htmloutput_errors($errmsg);

print '<div align="center">';

//print '<br>'.$langs->trans("FieldsWithAreMandatory",'*').'<br>';
//print $langs->trans("FieldsWithIsForPublic",'**').'<br>';

print '<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery(document).ready(function () {
        function initmorphy()
        {
                if (jQuery("#morphy").val()==\'phy\') {
                    jQuery("#trcompany").hide();
                }
                if (jQuery("#morphy").val()==\'mor\') {
                    jQuery("#trcompany").show();
                }
        };
        initmorphy();
        jQuery("#morphy").click(function() {
            initmorphy();
        });
        jQuery("#selectcountry_id").change(function() {
           document.newmember.action.value="create";
           document.newmember.submit();
        });
        function initfromage()
        {
            if (jQuery("#options_Categorie_point_distrib").val()==9) { jQuery(".fromage").hide(); }
            if (jQuery("#options_Categorie_point_distrib").val()==15) { jQuery(".fromage").hide(); }
            if (jQuery("#options_Categorie_point_distrib").val()==3) { jQuery(".fromage").hide(); }
            if (jQuery("#options_Categorie_point_distrib").val()<>9) { jQuery(".fromage").show(); }
            if (jQuery("#options_Categorie_point_distrib").val()<>15) { jQuery(".fromage").show(); }
            if (jQuery("#options_Categorie_point_distrib").val()<>3) { jQuery(".fromage").show(); }
        };initfromage();
        jQuery("#options_Categorie_point_distrib").change(function() {initfromage();});
        jQuery("#options_Categorie_point_distrib").click(function() {initfromage();});
    });
});
</script>';

// Print form
print '<form action="'.$_SERVER["PHP_SELF"].'" method="POST" name="newmember">'."\n";
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'" / >';
print '<input type="hidden" name="entity" value="'.$entity.'" />';
print '<input type="hidden" name="action" value="add" />';

print '<div id="divsubscribe">';
print '<table class="border" summary="form to subscribe" id="tablesubscribe">'."\n";

// Type
if (empty($conf->global->MEMBER_NEWFORM_FORCETYPE))
{
    $listoftype=$adht->liste_array();
    $tmp=array_keys($listoftype);
    $defaulttype='';
    $isempty=1;
    if (count($listoftype)==1) { $defaulttype=$tmp[0]; $isempty=0; }
    print '<tr><td width="15%">'.$langs->trans("Type").'</td><td width="35%">';
    print $form->selectarray("type",  $adht->liste_array(), GETPOST('type')?GETPOST('type'):$defaulttype, $isempty);
    print '</td></tr>'."\n";
}
else
{
    $adht->fetch($conf->global->MEMBER_NEWFORM_FORCETYPE);
    //print $adht->libelle;
    print '<input type="hidden" id="type" name="type" value="'.$conf->global->MEMBER_NEWFORM_FORCETYPE.'">';
}
// Moral/Physic attribute
print '<input type="hidden" id="morphy" name="morphy" value="phy">';//modif AlainR : pas le choix, uniquement 'physique'
// Civility
print '<tr><td>'.$langs->trans('UserTitle').'</td><td>';
print '<select class="flat" name="civility_id">
<option value=""> </option>
<option value="MME">Madame</option>
<option value="MR">Monsieur</option>
</select></td></tr>'."\n";
// Lastname
print '<tr><td>'.$langs->trans("Lastname").'</td><td><input type="text" name="lastname" size="40" value="'.dol_escape_htmltag(GETPOST('lastname')).'"></td></tr>'."\n";
// Firstname
print '<tr><td>'.$langs->trans("Firstname").'</td><td><input type="text" name="firstname" size="40" value="'.dol_escape_htmltag(GETPOST('firstname')).'"></td></tr>'."\n";
// Company
print '<tr id="trcompany" class="trcompany"><td>'.$langs->trans("Company").'</td><td><input type="text" name="societe" size="40" value="'.dol_escape_htmltag(GETPOST('societe')).'"></td></tr>'."\n";
// Address
print '<tr><td>'.$langs->trans("Address").'</td><td>'."\n";
print '<textarea name="address" id="address" wrap="soft" cols="40" rows="'.ROWS_3.'">'.dol_escape_htmltag(GETPOST('address')).'</textarea></td></tr>'."\n";
// Zip / Town
print '<tr><td>'.$langs->trans('Zip').' / '.$langs->trans('Town').'</td><td>';
print $formcompany->select_ziptown(GETPOST('zipcode'), 'zipcode', array('town','selectcountry_id','state_id'), 6, 1);
print ' / ';
print $formcompany->select_ziptown(GETPOST('town'), 'town', array('zipcode','selectcountry_id','state_id'), 0, 1);
print '</td></tr>';
// Country
print '<tr><td width="25%">'.$langs->trans('Country').'</td><td>';
$country_id=GETPOST('country_id');
if (! $country_id && ! empty($conf->global->MEMBER_NEWFORM_FORCECOUNTRYCODE)) $country_id=getCountry($conf->global->MEMBER_NEWFORM_FORCECOUNTRYCODE,2,$db,$langs);
if (! $country_id && ! empty($conf->geoipmaxmind->enabled))
{
    $country_code=dol_user_country();
    //print $country_code;
    if ($country_code)
    {
        $new_country_id=getCountry($country_code,3,$db,$langs);
        //print 'xxx'.$country_code.' - '.$new_country_id;
        if ($new_country_id) $country_id=$new_country_id;
    }
}
$country_code=getCountry($country_id,2,$db,$langs);
print $form->select_country($country_id,'country_id');
print '</td></tr>';
/*/ State
if (empty($conf->global->SOCIETE_DISABLE_STATE))
{
    print '<tr><td>'.$langs->trans('State').'</td><td>';
    if ($country_code) print $formcompany->select_state(GETPOST("state_id"),$country_code);
    else print '';
    print '</td></tr>';
}*/
// EMail
print '<tr><td>'.$langs->trans("Email").'</td><td><input type="text" name="email" size="40" value="'.dol_escape_htmltag(GETPOST('email')).'"></td></tr>'."\n";
// Téléphones
print '<tr><td>'.$langs->trans("PhonePerso").'</td><td><input type="text" name="phone_perso" size="20" value="'.(GETPOST('phone_perso','alpha')?GETPOST('phone_perso','alpha'):$object->phone_perso).'"></td></tr>';
print '<tr><td>'.$langs->trans("PhoneMobile").'</td><td><input type="text" name="phone_mobile" size="20" value="'.(GETPOST('phone_mobile','alpha')?GETPOST('phone_mobile','alpha'):$object->phone_mobile).'"></td></tr>';
// Login
if (empty($conf->global->ADHERENT_LOGIN_NOT_REQUIRED))
{
    print '<tr><td>'.$langs->trans("Login").'</td><td><input type="text" name="login" size="20" value="'.dol_escape_htmltag(GETPOST('login')).'"></td></tr>'."\n";
    print '<tr><td>'.$langs->trans("Password").'</td><td><input type="password" name="pass1" size="20" value="'.GETPOST("pass1").'"></td></tr>'."\n";
    print '<tr><td>'.$langs->trans("PasswordAgain").'</td><td><input type="password" name="pass2" size="20" value="'.GETPOST("pass2").'"></td></tr>'."\n";
}
/*/ Birthday
print '<tr id="trbirth" class="trbirth"><td>'.$langs->trans("DateToBirth").'</td><td>';
print $form->select_date($birthday,'birth',0,0,1,"newmember");
print '</td></tr>'."\n";
// Photo
print '<tr><td>'.$langs->trans("URLPhoto").'</td><td><input type="text" name="photo" size="40" value="'.dol_escape_htmltag(GETPOST('photo')).'"></td></tr>'."\n";*/
// Public
print '<input type="hidden" name="public" value="0" checked>';
print '<div id="expl_oeufs" style="float:right;width:420px;margin-right:10px;padding:5px;border:1px solid #aaa; display:none;">
		<h2>Explications par rapport aux livraisons d\'oeufs</h2>
		<p>Sur les 45 livraisons de panier par an, 9 livraisons comprennent des oeufs pour tous les coopérateurs (compris dans le contrat "paniers").
		<p>En vous inscrivant à cet abonnement régulier de 4 oeufs, vous aurez des oeufs frais bio dans TOUS vos paniers. Cet abonnement "oeufs" concerne donc les 36 livraisons restantes.</p>
		Il est lié au modèle contractuel de distribution des paniers et n\'est donc accessible qu\'aux membres de la coopérative.
		Les modalités de paiement, les conditions de résiliation et autres sont calqués sur ce modèle.</p>

		<p>La boite de 4 oeufs étant à 4.-, il en résulte un tarif annuel de 144.- (pour 36 livraisons).</p>
		</div>';
// Extrafields
foreach($extrafields->attribute_label as $key=>$value)
{
    print "<tr><td";
if ($value=="Avec abonnement fromage ?") {print ' class="fromage"';}
    print ">".$value;
if ($value=="Avec abonnement oeufs ?") {print "<!--<br />(<a href=\"javascript:toggle_visibility('expl_oeufs');\">Explications</a>)-->";}
    print "</td><td";
if ($value=="Avec abonnement fromage ?") {print ' class="fromage"';}
    print ">";
    print $extrafields->showInputField($key,GETPOST('options_'.$key));
    print "</td></tr>\n";
}
// Comments
print '<tr>';
print '<td valign="top">'.$langs->trans("Comments").'</td>';
print '<td valign="top"><textarea name="comment" wrap="soft" cols="60" rows="'.ROWS_4.'">'.dol_escape_htmltag(GETPOST('comment')).'</textarea></td>';
print '</tr>'."\n";

// Add specific fields used by Dolibarr foundation for example
if (! empty($conf->global->MEMBER_NEWFORM_DOLIBARRTURNOVER))
{
    $arraybudget=array('50'=>'<= 100 000','100'=>'<= 200 000','200'=>'<= 500 000','300'=>'<= 1 500 000','600'=>'<= 3 000 000','1000'=>'<= 5 000 000','2000'=>'5 000 000+');
    print '<tr id="trbudget" class="trcompany"><td>'.$langs->trans("TurnoverOrBudget").'</td><td>';
    print $form->selectarray('budget', $arraybudget, GETPOST('budget'), 1);
    print ' € or $';

    print '<script type="text/javascript">
    jQuery(document).ready(function () {
        initturnover();
        jQuery("#morphy").click(function() {
            initturnover();
        });
        jQuery("#budget").change(function() {
                if (jQuery("#budget").val() > 0) { jQuery(".amount").val(jQuery("#budget").val()); }
                else { jQuery("#budget").val(\'\'); }
        });
        /*jQuery("#type").change(function() {
            if (jQuery("#type").val()==1) { jQuery("#morphy").val(\'mor\'); }
            if (jQuery("#type").val()==2) { jQuery("#morphy").val(\'phy\'); }
            if (jQuery("#type").val()==3) { jQuery("#morphy").val(\'mor\'); }
            if (jQuery("#type").val()==4) { jQuery("#morphy").val(\'mor\'); }
            initturnover();
        });*/
        function initturnover() {
            if (jQuery("#morphy").val()==\'phy\') {
                jQuery(".amount").val(20);
                jQuery("#trbudget").hide();
                jQuery("#trcompany").hide();
            }
            if (jQuery("#morphy").val()==\'mor\') {
                jQuery(".amount").val(\'\');
                jQuery("#trcompany").show();
                jQuery("#trbirth").hide();
                jQuery("#trbudget").show();
                if (jQuery("#budget").val() > 0) { jQuery(".amount").val(jQuery("#budget").val()); }
                else { jQuery("#budget").val(\'\'); }
            }
        }
    });
    </script>';
    print '</td></tr>'."\n";
}
if (! empty($conf->global->MEMBER_NEWFORM_AMOUNT)
|| ! empty($conf->global->MEMBER_NEWFORM_PAYONLINE))
{
    // $conf->global->MEMBER_NEWFORM_SHOWAMOUNT is an amount
    $amount=0;
    if (! empty($conf->global->MEMBER_NEWFORM_AMOUNT)) {
        $amount=$conf->global->MEMBER_NEWFORM_AMOUNT;
    }

    if (! empty($conf->global->MEMBER_NEWFORM_PAYONLINE))
    {
        $amount=GETPOST('amount')?GETPOST('amount'):$conf->global->MEMBER_NEWFORM_AMOUNT;
    }
    // $conf->global->MEMBER_NEWFORM_PAYONLINE is 'paypal' or 'paybox'
    print '<tr><td>'.$langs->trans("Subscription").'</td><td class="nowrap">';
    if (! empty($conf->global->MEMBER_NEWFORM_EDITAMOUNT))
    {
        print '<input type="text" name="amount" id="amount" class="flat amount" size="6" value="'.$amount.'">';
    }
    else
    {
        print '<input type="text" name="amount" id="amounthidden" class="flat amount" disabled="disabled" size="6" value="'.$amount.'">';
        print '<input type="hidden" name="amount" id="amount" class="flat amount" size="6" value="'.$amount.'">';
    }
    print ' '.$langs->trans("Currency".$conf->currency);
    print '</td></tr>';
}
print "</table>\n";

print '<br /><input name="statuts" id="statuts" value="accepté!" type="checkbox"> <label for="statuts" class="inline">Je déclare avoir pris connaissance des <a target="_blank" href="http://www.p2r.ch/cooperative_d.html">statuts</a> et j\'accepte les conditions de paiement stipulées sur ce site.</label><br />';
// Save
print '<br><center>';
print '<input type="submit" value="'.$langs->trans("Save").'" id="submitsave" class="button">';
if (! empty($backtopage))
{
    print ' &nbsp; &nbsp; <input type="submit" value="'.$langs->trans("Cancel").'" id="submitcancel" class="button">';
}
print '</center>';
print "<br></div></form>\n";
print '</div>';
print
llxFooterVierge();
$db->close();
