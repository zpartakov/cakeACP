<?php
/*
 * all the dolibarr external cakePHP functions for cakeCocagne
 *
 */

 /*
  * dirties functions to connect to c5 db out of cakePhp core
  *
  */
function erp_connect_db()	{
//radeff todo change on another server
$server=SERVERMYSQL;                              // user name for you database
$login=DOLIBARR_LOGINMYSQL;                              // user name for you database
$pass=DOLIBARR_PASSWORDMYSQL;                                   // pass word to the database if you dont have a password
 $db=mysql_connect($server,$login,$pass) or  die("Unable  to  select  database");

 return $db;

 }

function erp_use_database($db) {
 $sql="USE "	.DOLIBARR_DBMYSQL; //lesjardinsdecocagnech3
 //echo $sql; exit;
 $sql=mysql_query($sql);
 if(!$sql){
   echo "Erreur SQL: " .mysql_error();
 }
}

function erp_db_name()	{
$database_name=DOLIBARR_DBMYSQL;                     //name of the database

 $db_name=$database_name;

 return $db_name;

}

function  erp_etiquettes(){
  erp_db_name(); //assignation du nom de la db
  erp_connect_db(); //connexion à la db
  erp_use_database(); //selection db
  //contrats abo
}


//mysql table structure
/*
llx_contrat
1	rowidPrimary
2	ref
3	ref_supplier
4	ref_ext
5	entity
6	tms
7	datec
8	date_contrat
9	statut
10	mise_en_service
11	fin_validite
12	date_cloture
13	fk_soc
14	fk_projet
15	fk_commercial_signature
16	fk_commercial_suivi
17	fk_user_author
18	fk_user_mise_en_service
19	fk_user_cloture
20	note_private
21	note_public
22	model_pdf
23	import_key
24	extraparams
25	ref_customer

---
llx_societe

rowid
nom
entity
ref_ext
ref_int
statut
parent
tms
datec
status
code_client
code_fournisseur
code_compta
code_compta_fournisseur
address
zip
town
fk_departement
fk_pays
phone
fax
url
email
skype
fk_effectif
fk_typent
fk_forme_juridique
fk_currency
siren
siret
ape
idprof4
idprof5
idprof6
tva_intra
capital double
fk_stcomm
note_private
note_public
prefix_comm
client
fournisseur
supplier_account
fk_prospectlevel
customer_bad
customer_rate double
supplier_rate double
fk_user_creat
fk_user_modif
remise_client double
mode_reglement
cond_reglement
mode_reglement_supplier
cond_reglement_supplier
fk_shipping_method
tva_assuj
localtax1_assuj
localtax1_value
localtax2_assuj
localtax2_value
barcode
fk_barcode_type
price_level
outstanding_limit
default_lang
logo
canvas
import_key
webservices_url
webservices_key
name_alias
fk_incoterms
location_incoterms
model_pdf
fk_multicurrency
multicurrency_code
---
table llx_adherent
rowid : radeff=1!, mary smith2
table llx_adherent_extrafields
rowid //user id
pdd //no point de distribution
*/
