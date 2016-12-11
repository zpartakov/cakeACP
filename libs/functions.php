<?php
/*
 * all the external cakePHP functions for cakeCocagne
 * 
 */
 
 /*
  * dirties functions to connect to c5 db out of cakePhp core
  * 
  */
function connect_db()	{
//radeff todo change on another server
$server=SERVERMYSQL;                              // user name for you database
$login=LOGINMYSQL;                              // user name for you database
$pass=PASSWORDMYSQL;                                   // pass word to the database if you dont have a password 
	$db=mysql_connect($server,$login,$pass) or  die("Unable  to  select  database");
		
	return $db;
	
	}
	
function use_database($db) {
	$sql="USE "	.DBMYSQL;
	//echo $sql; exit;
	$sql=mysql_query($sql);
	if(!$sql){
		echo "Erreur SQL: " .mysql_error();
	} 
}

function db_name()	{
$database_name=DBMYSQL;                     //name of the database

	$db_name=$database_name;
	
	return $db_name;
	
} 


/* print 100 emails of new Cocagne's members */
function c5_new_users(){
	db_name();
	connect_db();
	use_database();
	$sql="SELECT uEmail FROM Users ORDER BY uID DESC LIMIT 0,100";
	$sql=mysql_query($sql);
	if(!$ql) {
		echoe "error sql: " .mysql_error(); exit;
	}
	for($i=0; $i++; $i<mysql) {
		echo "<br/>" .mysql_result($sql,$i,'uEmail');
	}
}








/* old from pmCake */ 
####### PROJECTS ##########
function facture($client_id) {
	//pm_tasks.status=5: statut en attente
	//echo $client_id;
	
	$sql="
	SELECT id FROM pm_projects
	WHERE pm_organization_id=".$client_id; 
	//echo $sql; exit;
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
$pid=mysql_result($sql,0,'id');
	
	$sql="
	SELECT * FROM pm_tasks
	WHERE pm_tasks.project=".$pid ."
	 AND pm_tasks.status=5
	 ORDER BY pm_tasks.start_date"; 
	//echo $sql; exit;
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
$lesheures="<table><tr><th>Date</th><th>Libellé</th><th>Tarif horaire</th><th>Heures</th><th>Total</th></tr>";
$i=0; $heures=0;

while($i<mysql_num_rows($sql)){
	
$lesheures.= "<tr><td>";
$lesheures.=mysql_result($sql,$i,'pm_tasks.start_date');
$lesheures .="</td><td>";
$lesheures.=mysql_result($sql,$i,'pm_tasks.name');
$lesheures .="</td><td>CHF 90.-";
$lesheures .="</td><td>";


		$sql2="
			SELECT SUM(hours) AS hours FROM pm_tasks_time 
			WHERE task=" .mysql_result($sql,$i,'pm_tasks.id');
			//echo $sql2;
			#echo mysql_result($sql,$i,'hours');
			$sql2=mysql_query($sql2);
			$hours=mysql_result($sql2,0,'hours');
			$lesheures.= $hours;
$lesheures .="</td><td>";
$lesheures .=$hours*90;
$heures=$heures+$hours*90;
$lesheures .=".-</td></tr>";
$i++;
}
$lesheures.= "<tr><td><strong>Total</strong></td><td colspan=\"4\"><strong>CHF&nbsp;".$heures.".-</strong></td>";

$lesheures.="</table>";
	
return $lesheures;
}

function temps_moyen_booking($pid,$cherche) {
$sql2="
SELECT SUM(hours) AS hours, COUNT(id) AS tasks   
FROM pm_tasks_time 
WHERE pm_tasks_time.task 
IN 
	(
		SELECT id FROM pm_tasks 
		WHERE project=32 
		AND pm_tasks.name LIKE 'idBooking%'
	) ";
	
	
//	echo $sql2;
	#echo mysql_result($sql,$i,'hours');
	$sql2=mysql_query($sql2);
	$hours=mysql_result($sql2,0,'hours');
	$sql3="	SELECT COUNT(id) AS tasks FROM pm_tasks WHERE project=32 AND pm_tasks.name LIKE '".$cherche."%'";
	$sql3=mysql_query($sql3);
	$tasks=mysql_result($sql3,0,'tasks');
	
	echo "<br>Total heures pour ce type de demande: " .$hours ." pour: #" .$tasks ." demandes";
	echo "<br>Moyenne heures pour ce type de demande: " .intval($hours/$tasks) ." heures";
}

function temps_moyen_lime($pid,$cherche) {
$sql2="
SELECT SUM(hours) AS hours, COUNT(id) AS tasks   
FROM pm_tasks_time 
WHERE pm_tasks_time.task 
IN 
	(
		SELECT id FROM pm_tasks 
		WHERE project=36
	) ";
	
	
//	echo $sql2;
	#echo mysql_result($sql,$i,'hours');
	$sql2=mysql_query($sql2);
	$hours=mysql_result($sql2,0,'hours');
	$sql3="	SELECT COUNT(id) AS tasks FROM pm_tasks WHERE project=36 AND pm_tasks.name LIKE '".$cherche."%'";
	$sql3=mysql_query($sql3);
	$tasks=mysql_result($sql3,0,'tasks');
	
	echo "<br>Total heures pour ce type de demande: " .$hours ." pour: #" .$tasks ." demandes";
	echo "<br>Moyenne heures pour ce type de demande: " .intval($hours/$tasks) ." heures";
}

function temps_moyen($pid,$cherche) {
$sql2="
SELECT SUM(hours) AS hours, COUNT(id) AS tasks   
FROM pm_tasks_time 
WHERE pm_tasks_time.task 
IN 
	(
		SELECT id FROM pm_tasks 
		WHERE project=" .$pid ."
	) ";
	
	
//	echo $sql2;
	#echo mysql_result($sql,$i,'hours');
	$sql2=mysql_query($sql2);
	$hours=mysql_result($sql2,0,'hours');
	$sql3="	SELECT COUNT(id) AS tasks FROM pm_tasks WHERE project=" .$pid ." AND pm_tasks.name LIKE '".$cherche."%'";
	$sql3=mysql_query($sql3);
	$tasks=mysql_result($sql3,0,'tasks');
	
	echo "<br>Total heures pour ce type de demande: " .$hours ." pour: #" .$tasks ." demandes";
	echo "<br>Moyenne heures pour ce type de demande: " .intval($hours/$tasks) ." heures";
}


function Total_heures($pid) {
$sql2="
SELECT SUM(hours) AS hours FROM pm_tasks_time WHERE pm_tasks_time.task IN (SELECT id FROM pm_tasks WHERE project=" .$pid .") ";
	//echo $sql2;
	#echo mysql_result($sql,$i,'hours');
	$sql2=mysql_query($sql2);
	$hours=mysql_result($sql2,0,'hours');
	echo $hours;
}

/* show tasks for current project */
function project_tasks_show($plib,$pid,$order,$statut,$operator,$anchor) {
	
	$sql="SELECT * FROM pm_tasks WHERE project=".$pid;

	/*tâche 	statut 	priorité 	début 	délai 	milestone 	heures 	ok 	Actions*/
	$sql="SELECT `id`, `priority`, `status`, `name`, `start_date`,`due_date`,`milestone` FROM `pm_tasks` WHERE project=".$pid;
	
	
	if($_GET['statut']) {$statut = $_GET['statut'];}
		$statut = " AND status" .$operator .$statut;

	$sql.=$statut;
	$sql.= " ORDER BY " .$order;
	#echo $sql;
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }
	
echo '	<a name="'.$anchor .'"></a>
	<div class="pmTasks index" style="background-color: #F1CB84; padding-bottom: 13px;">
	<a name="taches"></a><h2>';
echo $plib;
echo " (".mysql_num_rows($sql) .") ";
echo '<a href="/intranet/pmcake/pm_tasks/add"><img src="/intranet/pmcake/img/toolbar/add.png" alt="Ajouter" title="Ajouter" /></a>';
//e($html->link($html->image('toolbar/add.png', array('alt' => 'Ajouter', 'title' => 'Ajouter')), array('controller' => 'pm_tasks', 'action'=>'add'), array('escape' => false)));
echo '
</h2>
	<table>
	<tr>
			<th>tâche</th>
			<th>statut</th>
			<th>priorité</th>
			<th>début</th>
			<th>délai</th>
			<th>milestone</th>
			<th>heures</th>
			<th>ok</th>
			<th class="actions" colspan="2">Actions</th>
	</tr>
';


$i=0;
while($i<mysql_num_rows($sql)){
			$class = null;
		if (intval($i/2) == ($i/2)) {
			$class = ' class="altrow"';
		}
	echo '			<tr' .$class .'>
		<td>';
	//echo $this->Html->link(mysql_result($sql,$i,'name'), array('controller' => 'pm_tasks', 'action' => 'view', mysql_result($sql,$i,'id')));
	#echo '<a href="/intranet/pmcake/pm_tasks/view/' .mysql_result($sql,$i,'id') .'">' .mysql_result($sql,$i,'name') .'</a>';
	
		echo '<a href="' .CHEMIN .'pm_tasks/edit/'.mysql_result($sql,$i,'id').'" class="tooltip">'.mysql_result($sql,$i,'name');
/*
if(strlen(	mysql_result($sql,$i,'description'))>0) {
	echo '<em><span></span>'.nl2br(mysql_result($sql,$i,'description')).'</em>';
}*/
	echo '</a>';
	
	
	echo '</td>
				<td>';
		statut(mysql_result($sql,$i,'status'));
	echo '		</td>
		<td>';
	prioriteView( mysql_result($sql,$i,'priority'));

	echo '&nbsp;</td>
				<td>';
	echo mysql_result($sql,$i,'start_date');
	echo '&nbsp;</td>
		<td>';
	echo mysql_result($sql,$i,'due_date');
	echo '&nbsp;</td>
		<td>';
	echo mysql_result($sql,$i,'milestone');
	echo '&nbsp;</td>
		<td>';
		total_hours_task(mysql_result($sql,$i,'id'));
	echo '</td>
	<td class="oktask">
	     <!-- ############ task ok ######### -->
			&#x2714;<input type="checkbox" title="OK?" onChange="task_ok(';
	echo mysql_result($sql,$i,'id');
	echo ',this.value)">
			<!-- http://fr.wikipedia.org/wiki/Coche_%28typographie%29 -->
		</td>
		<td class="actions">
		<!-- ################ PUSH DELAYS  ################  -->
		<form action="repousser" method="GET" name="';
	echo mysql_result($sql,$i,'id');
	echo '">
		<input type="hidden" name="identifiant" value="';
	echo mysql_result($sql,$i,'id');
	echo '">
		<input type="image" src="/pmcake/img/icons/bullet_arrow.gif" alt="Déplacer à demain" title="Déplacer à demain" name="demain" value="demain">
        <select name="ajout" class="micro" size="1" onChange="task_goto_URL(';
	echo mysql_result($sql,$i,'id');
	echo ',this.value)">';
	delais();
	echo '</select>';
	$idaction=mysql_result($sql,$i,'id');
	les_actions($idaction);
	echo '      </form>
			</td>
		</tr>';
		$i++;
		}
	echo '	</table>
		</div>
	';
}

/*function to get a scrolling list of projets and highlight the current project if exists*/
function projets_sel($pid) {
$sql="SELECT id, name, type FROM pm_projects ORDER BY name"; 
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
$i=0;
echo "<option value=''>### projet ###" ."</option>";
while($i<mysql_num_rows($sql)){
	if(mysql_result($sql,$i,'type')=="p") {
		$css="projet_sel_perso";
	} else {
		$css="projet_sel";
		
	}
	echo "<option class=\"" .$css ."\" value=\"" .mysql_result($sql,$i,'id') ."\"";
	if($pid==mysql_result($sql,$i,'id')){
		echo " selected";
	}
	echo ">" .mysql_result($sql,$i,'name') ."</option>";
	$i++;
	}
}


/*function to print the name of a given project*/
function projet_nom_print($pid) {
$sql="SELECT name FROM pm_projects WHERE id=".$pid; 
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}

	
	echo "<a href=\"" .CHEMIN. "pm_projects/view/" .$pid ."\">";
	echo mysql_result($sql,0,'name');
	echo "</a>";
}


/*function to return the name of a given project*/
function projet_nom_return($pid) {
$sql="SELECT name FROM pm_projects WHERE id=".$pid; 
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}

	return utf8_encode(mysql_result($sql,0,'name'));
}

/*function to get a scrolling list of projets and highlight the current project if exists*/
function statut_sel($statut) {
	$statuts=array(
	"Complet (client)", 
	"Complet", 
	"Non commencé", 
	"Ouvert", 
	"Suspendu",
	 "En attente",
	 "Délégué",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	"Incubateur",
	 "",
	 "",
	 "",
	 "",
	"Références"
	);	
	for($i=0;$i<23;$i++) {
		$zestatut=$statuts[$i];
			if(strlen($zestatut)>1) {
				echo "<option value=\"" .$i ."\"";
				if($statut==$i){
					echo " selected";
				}
				echo ">" .$zestatut ."</option>";
			}
	}
}


/*function to get a scrolling list of projets and highlight the current project if exists*/
function statut_radio($id,$statut) {
	$statuts=array(
	"Complet (client)", 
	"Complet", 
	"Non commencé", 
	"Ouvert", 
	"Suspendu",
	 "En attente",
	 "Délégué",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	 "",
	"Incubateur",
	 "",
	 "",
	 "",
	 "",
	"Références"
	);	
	for($i=0;$i<count($statuts);$i++) {
		$zestatut=$statuts[$i];
			if(strlen($zestatut)>1&&$zestatut!="Complet (client)") {
				echo "<span>
<input type=\"radio\" name=\"radiovalue\" value=\"" .$i ."\"";

				echo " onChange=\"task_change_status(".$id.",".$i.")\"";
				if($statut==$i){
					echo " checked";
				}
				echo " / >&nbsp;" .$zestatut;
								echo "</span>";
			}
	}
}
/* function to extract specified status */
function statut($id) {
	$statut=""; $lestyle="";
	if($id==0) {
		$statut="Complet (client)";
	}elseif($id==1) {
		$statut="Complet";
	}elseif($id==2) {
		$statut="Non commencé";
	}elseif($id==3) {
		$statut="Ouvert";
	}elseif($id==4) {
		$statut="Suspendu";
	}elseif($id==5) {
	}elseif($id==6) {
	}elseif($id==7) {
	}elseif($id==17) { //café papo 17
		$statut="Incubateur"; //dreams, boîte à idées
		$lestyle='" style="width: 20px"';
	}elseif($id==22) { //22 vla les flics
		$statut="Références"; //references	
		$lestyle='" style="width: 30px"';
	}
	
	echo '<img src="/pmcake/img/gfx_status/' .$id .'.gif" alt="' .$statut .'" title="' .$statut .'" ' .$lestyle .' />';

	}
	/* function to return specified status */
function statutreturn($id) {
	$statut=""; $lestyle="";
	if($id==0) {
		$statut="Complet (client)";
	}elseif($id==1) {
		$statut="Complet";
	}elseif($id==2) {
		$statut="Non commencé";
	}elseif($id==3) {
		$statut="Ouvert";
	}elseif($id==4) {
		$statut="Suspendu";
	}elseif($id==5) {
	}elseif($id==6) {
	}elseif($id==7) {
	}elseif($id==17) { //café papo 17
		$statut="Incubateur"; //dreams, boîte à idées
		$lestyle='" style="width: 20px"';
	}elseif($id==22) { //22 vla les flics
		$statut="Références"; //references	
		$lestyle='" style="width: 20px"';
	}
	
	return '<img src="/pmcake/img/gfx_status/' .$id .'.gif" alt="' .$statut .'" title="' .$statut .'" ' .$lestyle .' />';

	}
	
####### TASKS #########

/*function to get a scrolling list of tasks and select the current task if exists*/
function tasks_sel($tid) {
$sql="SELECT id, name FROM pm_tasks ORDER BY name"; 
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
$i=0;
while($i<mysql_num_rows($sql)){
	echo "<option value=\"" .mysql_result($sql,$i,'id') ."\"";
	if($tid==mysql_result($sql,$i,'id')){
		echo " selected";
	}
	echo ">" .mysql_result($sql,$i,'name') ."</option>";
	$i++;
	}
}

function completion($completion) {
	$pourcent=array(0,10,20,30,40,50,60,70,80,90,100);
	for($i=0;$i<11;$i++) {	
		echo "<option value=\"" .$pourcent[$i] ."\"";
		if($i==$completion) {
			echo " selected";
			}
		echo ">" .$pourcent[$i] ."%</option>";
	}
}
	
function priorite($priorite) {
	$prioritelib=array("Vide","Très faible","Faible","Moyenne","Elevée","Très élevée");
	$prioritecolor=array(  "white", "#00FF00", "#90EE90" ,"#FFA500" ,"#FFC0CB","#FF6C7F");
	for($i=0;$i<6;$i++) {	
		echo "<option value=\"" .$i ."\"";
		if($i==$priorite) {
			echo " selected";
			}
			echo " style=\"background-color: "  .$prioritecolor[$i] ."\"";
		echo ">" .$prioritelib[$i] ."</option>";
	}
}

function prioritehighlight($priorite) {
	$prioritelib=array("Vide","Très faible","Faible","Moyenne","Elevée","Très élevée");
	$prioritecolor=array(  "white","#00FF00"           , "#90EE90"     ,"#FFA500"       ,"#FFC0CB","#FF6C7F");

	echo "<div style=\"background-color: "  .$prioritecolor[$priorite] ."\">";
	
}
	
function prioriteView($i) {
	$prioritelib=array("Vide","Très faible","Faible","Moyenne","Elevée","Très élevée");
	$prioritecolor=array(  "white","#00FF00"           , "#90EE90"     ,"#FFA500"       ,"#FFC0CB","#FF6C7F");

		echo "<span style=\"background-color: "  .$prioritecolor[$i] ."\">" .$prioritelib[$i] ."</span>";
}
	
/*
 * change priority of a given task
 */
function prioriteViewSelCol($priorite,$idtask) {
	$prioritelib=array("Vide","Très faible","Faible","Moyenne","Elevée","Très élevée");
	$prioritecolor=array(  "white", "#00FF00", "#90EE90" ,"#FFA500" ,"#FFC0CB","#FF6C7F");
	echo "<div id=\"priorite" .$idtask ."\" style=\"padding: 3px; background-color:"  .$prioritecolor[$priorite] ."\">";
	echo "<select id=\"PmTaskPriority\" name=\"data[PmTask][priority]\" ";
	//echo "size=\"6\"";
	//echo " onchange=\"change_priorite(".$idtask .",this.value)\">";
	echo ">";
	echo "<option value=\"\">*** priorité *** </option>";
	for($i=0;$i<6;$i++) {	
		echo "<option value=\"" .$i ."\"";

			echo " style=\"background-color: "  .$prioritecolor[$i] ."\"";
			if($i==$priorite) {
			echo " selected";
			}		echo ">";
		
		echo $prioritelib[$i] ."</option>";
	}
	echo "</select></div>";
}

/*function to print the name of a given task*/
function task_nom_print($pid) {
$sql="SELECT name FROM pm_tasks WHERE id=".$pid; 
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
    echo "<a href=\"" .CHEMIN. "pm_tasks/view/" .$pid ."\">";
	echo mysql_result($sql,0,'name');
	echo "</a>";
	
	
	
}
/*time spent on a task*/
function total_hours_task($task_id) {
		$sql2="
			SELECT SUM(hours) AS hours FROM pm_tasks_time 
			WHERE task=" .$task_id;
			#echo $sql2;
			#echo mysql_result($sql,$i,'hours');
			$sql2=mysql_query($sql2);
			$hours=mysql_result($sql2,0,'hours');
			echo $hours;
		$sql2="
			SELECT pm_tasks_time.id AS id, date, sum(hours) AS hours FROM pm_tasks_time 
			WHERE task=" .$task_id ." 
			GROUP BY date";
		echo "&nbsp;<a href=\"javascript:showdetailtaskhours()\">Détail</a><p><div id=\"showdetailtaskhours\" style=\"display: none\">Détail heures:<br/>";
			#echo $sql2;
			#echo mysql_result($sql,$i,'hours');
			$sql2=mysql_query($sql2);
			$i=0;
			while($i<mysql_num_rows($sql2)) {
			$hours=mysql_result($sql2,$i,'hours');
			dateSQL2frSmall(mysql_result($sql2,$i,'date'));
			echo ", <a href=\"/intranet/pmcake/pm_tasks_times/edit/" .mysql_result($sql2,$i,'id')."\">";
			echo $hours;
			echo "</a><br/>";
			$i++;
			}
			echo "</div></p>";
			
}


#############################################################################

/*
 * function random list of tasks (todos, wishlist, reference) for home suggestions
 */
	function random_list_todos($nrandom,$prof_or_private) {
		/*
		 * $prof_or_private
		 * private: proj.type =='p'
		 */		
		if($prof_or_private=='p'){
			$prof_or_private=" LIKE '".$prof_or_private."'";
			$private="privé";
			$p="p";
		} else {
			$prof_or_private=" NOT LIKE 'p'";
			$private="prof.";
			$p="";
		}
		
		echo "
		<style>
		li {
		margin-bottom: 3px;
		}
		</style>
		
		<div class=\"random_list_todos\"><a name=\"random_list_todos".$p."\"></a>";
		//echo $this->html->image('dices0.png');
echo "<h2><img style=\"padding-top: 4px; padding-left: 6px; padding-right: 10px; width: 20px; height: 20px\" src=\"/intranet/pmcake/img/dices0.png\" alt=\"" .$nrandom ." tâches aléatoires\">";
		echo "Liste aléatoire de #" .$nrandom." tâches/idées (".$private .")</h2>";
		$sql="
		SELECT * FROM pm_tasks AS tas, pm_projects as proj 
		WHERE tas.status > 1 
		AND tas.status < 22 
	    AND tas.due_date <> '--' 
		AND tas.project=proj.id 
		AND proj.type ".$prof_or_private ."  
		ORDER BY RAND()
		LIMIT " .$nrandom;
		//echo $sql;
			$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}

/* todo: sort by due_date, not finished, begin */	
	while ($row = mysql_fetch_array($sql, MYSQL_NUM)) {
    $all_data[] = $row;
}

// $all_data is now a 2-D array with all your data.
usort($all_data, "due_date");
/*
echo "<pre>";
	print_r($all_data); 
echo "</pre>";
exit;
*/
/* todo: sort by due_date, not finished, end */	
	
	
	$i=0;
	$i=0;$lesid="";
	echo "<table>";
    echo "<tr><th>Statut</th><th>Libellé</th><th>Projet</th><th>Délai</th><th>Début</th></tr>";
	while($i<mysql_num_rows($sql)){
		$class = null;
		if (intval($i/2) == ($i/2)) {
			$class = ' class="altrow"';
		} 		
		
		if(mysql_result($sql,$i,'status')==5 ) {
/* special classes for statuts wait */
			$class = ' class="wait"';
			} 
	echo "<tr" .$class ."><td>";
	if(mysql_result($sql,$i,'proj.type')=="p") {
		perso_list();
	}
	echo "&nbsp;";
	statut(mysql_result($sql,$i,'status'));
	echo "</td><td>";
	echo ' <a href="' .CHEMIN .'pm_tasks/edit/'.mysql_result($sql,$i,'id').'" class="tooltip">'.mysql_result($sql,$i,'name');
	if(strlen(	mysql_result($sql,$i,'description'))>0) {
		echo '<em><span></span>'.nl2br(mysql_result($sql,$i,'description')).'</em>';
	}
	echo '</a>';
	echo "</td><td>";
	echo '<a href="/intranet/pmcake/pm_projects/view/'.mysql_result($sql,$i,'proj.id').'">'.mysql_result($sql,$i,'proj.name').'</a>';
	echo "</td><td>";	
	dateSQL2fr(mysql_result($sql,$i,'due_date'));
	echo "</td><td>";	
	echo "<em style=\"font-size: smaller\">(";
	dateSQL2frSmall(mysql_result($sql,$i,'start_date'));
	echo ")</em> ";
	
	
	echo "</td></tr>";
		$i++;
	}
	echo "</table>";
	echo "</div>";
	
	}
	
	/* MAIN function to extract the list of current tasks for a given category / period */
function print_tasks($catlib,$quand) {
	$datenow=date("Y-m-d");
	/*
	 * is the task private or not?
	 */
	if($catlib=="prof") {
		$projtyp=" AND proj.type !='p'";
	} elseif($catlib=="perso") {
		$projtyp=" AND proj.type ='p'";	
	}
	
	/*
	 * when
	 */
	if($quand=="auj") {
		$quandSQL=" AND (tas.due_date <= '".date("Y-m-d")."'"; 
	}elseif($quand=="demain") {
		$quandSQL=" AND (tas.due_date <= DATE_ADD('$datenow', INTERVAL 1 DAY) AND (tas.due_date > '$datenow') ";
	}
	
	/*
	 * is it a task, a dream or a reference?
	 */
	$taskstatus="< 17";

	if($catlib=="dreams") {
		$taskstatus="= 17";
	}
	if($catlib=="ref") {
		$taskstatus="= 22";
	}
	
	/*
	 * sorting list
	 */
	$ordertask=" ORDER BY tas.priority DESC, tas.status ASC, tas.due_date ASC";
	if($quand=="futur"){
		$ordertask=" ORDER BY tas.due_date ASC, tas.priority DESC, tas.status ASC";
		
	}
	/*
	 * present tasks
	 */
	global $sql, $idc;
	$sql="
	SELECT * FROM pm_tasks AS tas, pm_projects as proj 
	WHERE tas.status > 1 
	AND tas.status " .$taskstatus . $quandSQL
	." AND tas.due_date <> '--') 
	AND tas.project=proj.id " .$projtyp .$ordertask;

	/*
	 * future tasks
	 */
	if($quand=="futur") {
		$sql="
		SELECT * FROM pm_tasks AS tas, pm_projects as proj 
		WHERE tas.status > 1 
		AND tas.status < 17 
		AND (tas.due_date > DATE_ADD('".$datenow."', INTERVAL 1 DAY)) AND tas.due_date <> '--' 
		AND tas.project=proj.id " .$ordertask ." 
		LIMIT 0, 30";
	}
	
	/*
	 * tests: show sql query; uncomment for debug
	 */
	//echo nl2br($sql)."<br>"; //tests
	/*
	 * run sql query
	 */
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	/*
	 * display main category
	 */
	echo '<div id="' .$catlib .'"><h2><a name="' .$catlib .'"></a>'. ucfirst($catlib) .'</h2><form id="'.$catlib.'">';
	
	/*
	 * some special css classes to hide/show
	 */
	/*
	 * tomorrow tasks
	 */
	if($quand=="demain") {
echo '<small><a onclick="montrecache1();"><img src="/intranet/pmcake/img/icons/open_tab.gif"></a></small>
<div id="tomorrowContainer" style="display: none;">';
/*
 * future tasks
 */
	}elseif($quand=="futur") {
#echo '<div id="clickme2" style="display: block; position: relative; top: 18px; right: 20px;"><small><a onclick="montrecache2();"><img src="/intranet/pmcake/img/icons/open_tab.gif"></a></small></div><div id="futureContainer" style="display: none;">';
echo '<small><a onclick="montrecache2();"><img src="/intranet/pmcake/img/icons/open_tab.gif"></a></small>
<div id="futureContainer" style="display: none;">';
	}
	/*
	 * total on field tasks + headers of the table
	 */
	echo '<h3>Total tâches en cours: #'.mysql_num_rows($sql).'</h3>
			<table cellpadding="0" cellspacing="0">
			<tr>
				<th>project</th>
				<th>priority</th>
				<th>status</th>
			<!--	<th>owner</th>-->
				<th>name</th>
				<th>due_date</th>
				<th>milestone</th>
				<th class="actions" colspan="2">Actions
				</th>
			</tr>
	';

	/*
	 * loop on results
	 */
	$i=0;$lesid="";
	while($i<mysql_num_rows($sql)){
			$idc=mysql_result($sql,$i,'id');
		
		$class = null;
		if (intval($i/2) == ($i/2)) {
			$class = ' class="altrow"';
		} 		
		
		if(mysql_result($sql,$i,'status')==5 ) {
/* special classes for statuts wait */
			$class = ' class="wait"';
			} 
	echo "<tr" .$class;
	echo " id=\"tr" .mysql_result($sql,$i,'id')."\"";
	echo  ">";
	//experimental not working (select all and apply a common action
	#echo '<input id="User1Id" class="model_id" type="checkbox" value="1" name="data[User][1][id]">';
//	<input id="PmTask' .mysql_result($sql,$i,'id').'" class="cb-element" type="checkbox" value="' .mysql_result($sql,$i,'id').'" name="data[PmTask][' .mysql_result($sql,$i,'id').'][id]"></td>';
	echo "<td>";
echo     '<input type="checkbox" name="checkboxlist" value="'.mysql_result($sql,$i,'id').'" />';
	if(mysql_result($sql,$i,'proj.type')=="p") {
		perso_list();
	}
	echo '<a href="/intranet/pmcake/pm_projects/view/'.mysql_result($sql,$i,'proj.id').'">'.mysql_result($sql,$i,'proj.name').'</a>';
	echo "</td>";
	echo "<td>";
	//prioriteView(mysql_result($sql,$i,'priority'));
	prioriteView(mysql_result($sql,$i,'priority'), mysql_result($sql,$i,'id'));
	
	echo "</td>";
	echo "<td>";
	statut(mysql_result($sql,$i,'status'));
	echo  "</td>";
/*
 * affiche titre de la tâche
 */
	echo '<td>';
	echo '&nbsp;<a style="text-align: top" class="tooltip" href="/intranet/pmcake/pm_tasks/edit/' .$idc .'" alt="Modifier" title="Modifier">';
	echo mysql_result($sql,$i,'name');
	
/* affiche description, si elle existe */	
	if(strlen(	mysql_result($sql,$i,'description'))>0) {
		echo '<div id="detailstache'.mysql_result($sql,$i,'id').'"><em><span></span>'.nl2br(mysql_result($sql,$i,'description')).'</em></div>';
	}
	echo '</a>';
	//echo "</div>";
	echo "</td>";
	echo "<td>";
	dateSQL2fr(mysql_result($sql,$i,'due_date'));
	echo "<br /><em style=\"font-size: smaller\">(";
	dateSQL2frSmall(mysql_result($sql,$i,'start_date'));
	echo ")</em> ";
	echo "</td>";
	echo "<td>" .mysql_result($sql,$i,'milestone') ."</td>";
	echo "<td>";
	################ BEGIN PUSH DELAYS  ################
	push_delays($idc,$table);
	echo '<td>
		<a href="/intranet/pmcake/pm_tasks/view/' .$idc .'" alt="Voir" title="Voir">
			<img src="/intranet/pmcake/img/toolbar/loupe.png" alt="Voir" />
		</a>
		<a href="/intranet/pmcake/pm_tasks/edit/' .$idc .'" alt="Modifier" title="Modifier">
			<img src="/intranet/pmcake/img/toolbar/editor.png" alt="Modifier" />
		</a>
		<a href="/intranet/pmcake/pm_tasks/delete/' .$idc .'" alt="Effacer" title="Effacer" onclick="return confirm(\'Voulez-vous vraiment effacer cet élément ?\');">
			<img src="/intranet/pmcake/img/toolbar/drop.png" alt="effacer" />
		</a>
		</td>
		</tr>';
	 ################ END PUSH DELAYS  ################  
	/* ACTIONS END */
		echo "</tr>\n\n";
		/* stores id's */
		$lesid=$lesid.mysql_result($sql,$i,'id').";";
		
		$i++;
	}
	echo '
	</table>';
	    echo '<select id="pousserdelais" class="btnadd" onChange="sendselected()">';
    delais();
    echo '</select>';
    
    
	echo '
<!--
<div class="choose_action">
Action à effectuer sur les éléments sélectionnés&nbsp;
<?php
push_all_delays($catlib);
?>
</div>
!-->
</form>';
	
	?>

	<?php 	
	
	if($quand=="demain"||$quand=="futur") {
		echo "</div>";
	}

echo '</div>
<!-- CLOSE '.$catlib.' TASKS -->
	';
}


/* extract the tasks for a given projects, to select the parent_task_id for a given task */
function parent_tasks($pid,$task_id) {
	//no project (new task)
	if($pid=="") {
	echo "<option value=\"0\">--- no parent ---</option>";	
	} else {
$sql="SELECT id, name FROM pm_tasks WHERE project=".$pid." AND status>2 AND status < 10 ORDER BY name"; 
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
$i=0;
echo "<option value=\"0\">--- no parent ---</option>";
while($i<mysql_num_rows($sql)){
	echo "<option value=\"" .mysql_result($sql,$i,'id') ."\"";
	if($task_id==mysql_result($sql,$i,'id')){
		echo " selected";
	}
	echo ">" .mysql_result($sql,$i,'name') ."</option>";
	$i++;
	}
}
}

/* extract the parent task for a given task */
function parent_task($task_id) {
		//no project (new task)
	$sql="SELECT parent_id FROM pm_tasks WHERE id=".$task_id; 
//	echo "<br>".$sql ."<br>"; //tests
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$task_id=mysql_result($sql,0,'parent_id');
	if($task_id>0) {
	$sql="SELECT id, name FROM pm_tasks WHERE id=".$task_id ." ORDER BY due_date"; 
	echo "<tr><td>";
//	echo "<br>".$sql ."<br>"; //tests
	#do and check sql
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	if(mysql_num_rows($sql)>0) {
		echo "<h2>Parent</h2>";
		//echo "<ol>";
	while($i<mysql_num_rows($sql)){
		echo "<li><a href=\"" .mysql_result($sql,$i,'id') ."\">" .mysql_result($sql,$i,'name') ."</a></li>";
		$i++;
		}
		//echo "</ol>";

	}
	echo "</td></tr>";
	/**/
	}
}


function parent_task_small($task_id) {
		//no project (new task)
	$sql="SELECT parent_id FROM pm_tasks WHERE id=".$task_id; 
//	echo "<br>".$sql ."<br>"; //tests
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$task_id=mysql_result($sql,0,'parent_id');
	if($task_id>0) {
	$sql="SELECT id, name FROM pm_tasks WHERE id=".$task_id ." ORDER BY due_date"; 
	#do and check sql
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	if(mysql_num_rows($sql)>0) {
	while($i<mysql_num_rows($sql)){
		echo "<a href=\"" .mysql_result($sql,$i,'id') ."\">" .mysql_result($sql,$i,'name') ."</a>";
		$i++;
		}

	}
	} else {
		echo " - ";
	}
}


/* extract the children tasks for a given task */
function children_tasks($task_id) {
	$sql="SELECT id, name FROM pm_tasks WHERE parent_id=".$task_id ." ORDER BY due_date"; 
	//echo "<br>".$sql ."<br>"; //tests
	#do and check sql
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	if(mysql_num_rows($sql)>0) {
		echo "<tr><td>";
	echo "<h2>Children Tasks</h2>";
		echo "<ol>";
	while($i<mysql_num_rows($sql)){
		echo "<li><a href=\"" .mysql_result($sql,$i,'id') ."\">" .mysql_result($sql,$i,'name') ."</a></li>";
		$i++;
		}
		echo "</ol>";


	echo "</td></tr>";	
	}
}

/* total hours today */
function task_total_today($s_edate2) {
	
	$sql="
	SELECT * FROM pm_tasks_time, pm_projects 
	WHERE pm_tasks_time.date 
	LIKE '$s_edate2' 
	AND pm_tasks_time.project=pm_projects.id 
	AND pm_projects.type NOT LIKE 'p' 
	GROUP BY pm_projects.name

	";

	#echo nl2br($sql)."<br>";
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}

	#echo $sql;
	//echo "Total ";
	//dateSQL2fr($s_edate2);
	echo "Tot: ";
	$i=0;
	$total=0;
	while($i<mysql_num_rows($sql)){
	$pmid=mysql_result($sql,$i,'pm_tasks_time.project');
	$sql2="
	SELECT SUM(hours) AS hours FROM pm_tasks_time 
	WHERE pm_tasks_time.date 
	LIKE '$s_edate2' 
	AND pm_tasks_time.project=$pmid
	";
	$sql2=mysql_query($sql2);
	$hours=mysql_result($sql2,0,'hours');
	$total=$total+$hours;

	$i++;
	}
	echo $total;
	echo "h";
	
}
			    
/* resume times for a given week */
function task_resume_week() {
	/*
	 * semaine précédente
	 */
	$jour=date("D");
	if($jour=="Mon"){
			$recule=7;
		}elseif($jour=="Tue"){
			$recule=8;
		}elseif($jour=="Wed"){
			$recule=9;
		}elseif($jour=="Thu"){
			$recule=10;
		}elseif($jour=="Fri"){
			$recule=11;
		}elseif($jour=="Sat"){
			$recule=12;
		}elseif($jour=="Sun"){
			$recule=13;
		}
	$recule=$recule*24*3600;
	$date_beg=date("U");
	$date_beg=$date_beg-$recule;
	$week = date('W', $date_beg);
	$date_fin=$date_beg+(7*24*3600);
	$date_fin=$date_beg+(4*24*3600);	
	$date_begL= date('D, Y-m-d',$date_beg);
	$date_beg= date('Y-m-d',$date_beg);
	$date_finL= date('D, Y-m-d',($date_fin-(24*2600)));
	$date_fin= date('Y-m-d',$date_fin);
	$sql="
	SELECT  SUM(pm_tasks_time.hours) AS hours, pm_projects.name 
	FROM pm_tasks_time, pm_projects 
	WHERE 
	pm_tasks_time.date >= '$date_beg'
	AND  pm_tasks_time.date <= '$date_fin'
	AND pm_tasks_time.project=pm_projects.id 
	AND pm_projects.type NOT LIKE 'p' 
	GROUP BY pm_projects.name 
	";
//	echo nl2br($sql)."<br>";
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	$total=0;
	echo "<h2>Total pour la semaine #" .$week ." du " .$date_begL ." au " .$date_finL ."</h2><table>";
	while($i<mysql_num_rows($sql)){
	echo "<tr><td style=\"padding: 3px\">";
	echo mysql_result($sql,$i,'pm_projects.name');
	echo "</td><td>";
	echo mysql_result($sql,$i,'hours');
	$total=$total+mysql_result($sql,$i,'hours');
	echo "</td></tr>";
	$i++;
	}
	echo "<tr><td>Total</td><td>".$total ."</td></tr>";
	echo "</table>";

/*
 * semaine courante
 */

	$jour=date("D");
		if($jour=="Mon"){
			$recule=0;
		}elseif($jour=="Tue"){
			$recule=1;
		}elseif($jour=="Wed"){
			$recule=2;
		}elseif($jour=="Thu"){
			$recule=3;
		}elseif($jour=="Fri"){
			$recule=4;
		}elseif($jour=="Sat"){
			$recule=5;
		}elseif($jour=="Sun"){
			$recule=6;
		}
	$recule=$recule*24*3600;
	$date_beg=date("U");
	$date_beg=$date_beg-$recule;
	$week = date('W', $date_beg);
	$date_fin=$date_beg+(7*24*3600);
	$date_fin=$date_beg+(4*24*3600);
	$date_begL= date('D, Y-m-d',$date_beg);
	$date_beg= date('Y-m-d',$date_beg);
	$date_finL= date('D, Y-m-d',($date_fin-(24*2600)));
	$date_fin= date('Y-m-d',$date_fin);
	$sql="
	SELECT  SUM(pm_tasks_time.hours) AS hours, pm_projects.name 
	FROM pm_tasks_time, pm_projects 
	WHERE 
	pm_tasks_time.date >= '$date_beg'
	AND  pm_tasks_time.date <= '$date_fin'
	AND pm_tasks_time.project=pm_projects.id 
	AND pm_projects.type NOT LIKE 'p' 
	GROUP BY pm_projects.name 
	";
//	echo nl2br($sql)."<br>";
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	$total=0;
	echo "<h2>Total pour la semaine courante #" .$week ." du " .$date_begL ." au " .$date_finL ."</h2><table>";
	while($i<mysql_num_rows($sql)){
	echo "<tr><td style=\"padding: 3px\">";
	echo mysql_result($sql,$i,'pm_projects.name');
	echo "</td><td>";
	echo mysql_result($sql,$i,'hours');
	$total=$total+mysql_result($sql,$i,'hours');
	echo "</td></tr>";
	$i++;
	}
	echo "<tr><td>Total</td><td>".$total ."</td></tr>";
	echo "</table>";
}

/* resume task for a given date */

function task_resume($s_edate2) {
	$sql="
	SELECT * FROM pm_tasks_time, pm_projects 
	WHERE pm_tasks_time.date 
	LIKE '$s_edate2' 
	AND pm_tasks_time.project=pm_projects.id 
	AND pm_projects.type NOT LIKE 'p' 
	GROUP BY pm_projects.name 
	";

	#echo nl2br($sql)."<br>";
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}

	#echo $sql;
	echo "<h2>Totaux pour le: ";
	dateSQL2fr($s_edate2);
	echo "</h2><table>";
	$i=0;
	$total=0;
	while($i<mysql_num_rows($sql)){
	echo "<tr><td style=\"padding: 3px\">";
	echo mysql_result($sql,$i,'name');
	$pmid=mysql_result($sql,$i,'pm_tasks_time.project');
	echo "</td><td>";
	$sql2="
	SELECT SUM(hours) AS hours FROM pm_tasks_time 
	WHERE pm_tasks_time.date 
	LIKE '$s_edate2' 
	AND pm_tasks_time.project=$pmid
	";
	#echo $sql2;
	#echo mysql_result($sql,$i,'hours');
	$sql2=mysql_query($sql2);
	$hours=mysql_result($sql2,0,'hours');
	echo $hours;
	#echo mysql_result($sql,$i,'hours');

	#$total=$total+mysql_result($sql,$i,'hours');
	$total=$total+$hours;

	echo "</td></tr>";
	$i++;
	}
	echo "<tr><td style=\"padding: 3px\"><b>TOTAL</b></td><td style=\"padding: 3px\">" .$total ."</td></tr>";
	echo "</table><br>";
}

/* detail task for a given date */
function task_detail($s_edate2) {
	######### DETAIL #########
$sql="
SELECT * FROM pm_tasks_time,pm_projects,pm_tasks
WHERE pm_tasks_time.date 
LIKE '$s_edate2' 
AND pm_tasks_time.project=pm_projects.id
AND pm_tasks.id=pm_tasks_time.task 
AND pm_projects.type NOT LIKE 'p' 
ORDER BY pm_tasks_time.id
";
#echo $sql;
echo "<hr><h2>D&eacute;tail</h2>
<table>
<tr>
<th>project</th><th>task</th><th>created</th><th>modified</th><th>comments</th><th>hours</th>
</tr>";
$sql=mysql_query($sql);
$i=0;
$total=0;
while($i<mysql_num_rows($sql)){
	
	if(intval($i/2)==($i/2)) {
		$classe="";
	}else{
		$classe="pair";
	}
	
echo "<tr><td class=\"" .$classe ."\">";
echo mysql_result($sql,$i,'pm_projects.name');
echo "</td><td class=\"" .$classe ."\">";
echo mysql_result($sql,$i,'pm_tasks.name');

echo " <a href=\"" .CHEMIN ."pm_tasks_times/edit/" .mysql_result($sql,$i,'pm_tasks_time.id') ."\" title=\"Modifier le temps\">";
echo "<img src=\"" .CHEMIN ."img/icons/chronometre.png\" alt=\"modifier heures\" style=\"width: 25px\">";
echo "</a>";

echo " <a href=\"" .CHEMIN ."pm_tasks_times/delete/" .mysql_result($sql,$i,'pm_tasks_time.id') ."\" title=\"Supprimer le temps\">";
echo "<img src=\"" .CHEMIN ."img/toolbar/drop.png\" alt=\"supprimer heures\" style=\"width: 25px\">";
echo "</a>";

echo " <a href=\"" .CHEMIN ."pm_tasks/edit/" .mysql_result($sql,$i,'pm_tasks.id') ."\" title=\"modifier tâche\">";
echo "<img src=\"" .CHEMIN ."img/toolbar/editor.png\" alt=\"modifier tâche\" style=\"width: 25px\">";
echo " <a href=\"" .CHEMIN ."pm_tasks/view/" .mysql_result($sql,$i,'pm_tasks.id') ."\"title=\"voir la tâche\">";
echo "<img src=\"" .CHEMIN ."img/toolbar/loupe.png\" alt=\"voir la tâche\" style=\"width: 25px\">";
echo "</a></td><td class=\"" .$classe ."\">";
echo mysql_result($sql,$i,'pm_tasks_time.created');
echo "</td><td class=\"" .$classe ."\">";
echo mysql_result($sql,$i,'pm_tasks_time.modified');
echo "</td><td class=\"" .$classe ."\">";
echo substr(mysql_result($sql,$i,'pm_tasks_time.comments'), 0,100);
echo "</td><td class=\"" .$classe ."\">";
echo mysql_result($sql,$i,'pm_tasks_time.hours');
echo "<span style=\"font-size: smaller\"> (#" .$i .")</span>";
echo "</td>";
echo "</tr>";
$i++;
}
echo "</table>";

}

####### CLIENTS #########
/*function to get a scrolling list of projets and highlight the current project if exists*/
function clients_sel($pid) {
$sql="SELECT id, name FROM pm_organizations ORDER BY name"; 
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
$i=0;
while($i<mysql_num_rows($sql)){
	echo "<option value=\"" .mysql_result($sql,$i,'id') ."\"";
	if($pid==mysql_result($sql,$i,'id')){
		echo " selected";
	}
	echo ">" .mysql_result($sql,$i,'name') ."</option>";
	$i++;
	}
}
/* function to extract specified usagers/clients */
function clients($id) {
	$sql="SELECT * FROM pm_organizations WHERE id=".$id;
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }
	echo "<a href=\"" .CHEMIN."/pm_organizations/view/".mysql_result($sql,0,'id') ."\">" .mysql_result($sql,0,'name') ."</a>";
	}

/* list of projets for a given client */
function client_projets($id) {
	$sql="SELECT id, name FROM pm_projects  WHERE pm_organization_id=".$id;
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }
	
	$i=0;
	echo "<ul>";
	while($i<mysql_num_rows($sql)){
		echo "<li><a href=\"" .CHEMIN."/pm_projects/view/".mysql_result($sql,$i,'id') ."\">" .mysql_result($sql,0,'name') ."</a></li>";
		$i++;
		}
	echo "</ul>";	
}

/* list of all tasks for a given client */
function client_tasks($id) {
	$datenow = date("Y-m-d");
	$sql="
	SELECT * FROM pm_tasks AS tas, pm_projects as proj 
	WHERE tas.project=proj.id
	AND proj.pm_organization_id=".$id ." 
	ORDER BY tas.due_date ASC
	";
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }
	
	$i=0;
	echo "<ul class=\"puce_cache\">";
	while($i<mysql_num_rows($sql)){
		echo "<li>";
		statut(mysql_result($sql,$i,'tas.status'));
		echo "&nbsp;<a href=\"" .CHEMIN."/pm_tasks/view/".mysql_result($sql,$i,'tas.id') ."\">" .mysql_result($sql,$i,'tas.name') ."</a>";
		echo "&nbsp;<span style=\"font-style: italic; font-size: smaller;\">(" .mysql_result($sql,$i,'tas.due_date') .")</span>";
		echo "</li>";
		$i++;
		}
	echo "</ul>";	
}

######### USERS ###########
/* function to extract specified member (owners) */
function membres($id) {
	$sql="SELECT * FROM pm_members WHERE id=".$id;
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }
	echo "<a href=\"../pm_members/view/".mysql_result($sql,0,'id') ."\">" .mysql_result($sql,0,'login') ."</a>";
	}
	
/* function to extract all members (owners) for a given task */
function ts_les_membres($id) {
	$sql="SELECT * FROM pm_tasks_pm_members, pm_members 
			WHERE pm_tasks_pm_members.pm_task_id=".$id
		." AND pm_tasks_pm_members.pm_member_id=pm_members.id"
	;
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }
$i=0;
	if(mysql_num_rows($sql)>0) {
		echo "<ol>";
	while($i<mysql_num_rows($sql)){
		echo "<li><a href=\"" .mysql_result($sql,$i,'id') ."\">" .mysql_result($sql,$i,'name') ."</a></li>";
		$i++;
		}
		echo "</ol>";
	}	
}
/*function to get a scrolling list of projets and highlight the current project if exists*/
function membres_sel($pid) {
$sql="SELECT id, name FROM pm_members ORDER BY name"; 
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
$i=0;
while($i<mysql_num_rows($sql)){
	echo "<option value=\"" .mysql_result($sql,$i,'id') ."\"";
	if($pid==mysql_result($sql,$i,'id')){
		echo " selected";
	}
	echo ">" .mysql_result($sql,$i,'name') ."</option>";
	$i++;
	}
}

function ae_gen_password($syllables = 3, $use_prefix = false)
{

    // Define function unless it is already exists
    if (!function_exists('ae_arr'))
    {
        // This function returns random array element
        function ae_arr(&$arr)
        {
            return $arr[rand(0, sizeof($arr)-1)];
        }
    }

    // 20 prefixes
    $prefix = array('aero', 'anti', 'auto', 'bi', 'bio',
                    'cine', 'deca', 'demo', 'dyna', 'eco',
                    'ergo', 'geo', 'gyno', 'hypo', 'kilo',
                    'mega', 'tera', 'mini', 'nano', 'duo');

    // 10 random suffixes
    $suffix = array('dom', 'ity', 'ment', 'sion', 'ness',
                    'ence', 'er', 'ist', 'tion', 'or'); 

    // 8 vowel sounds 
    $vowels = array('a', 'o', 'e', 'i', 'y', 'u', 'ou', 'oo'); 

    // 20 random consonants 
    $consonants = array('w', 'r', 't', 'p', 's', 'd', 'f', 'g', 'h', 'j', 
                        'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm', 'qu');

    $password = $use_prefix?ae_arr($prefix):'';
    $password_suffix = ae_arr($suffix);

    for($i=0; $i<$syllables; $i++)
    {
        // selecting random consonant
        $doubles = array('n', 'm', 't', 's');
        $c = ae_arr($consonants);
        if (in_array($c, $doubles)&&($i!=0)) { // maybe double it
            if (rand(0, 2) == 1) // 33% probability
                $c .= $c;
        }
        $password .= $c;
        //

        // selecting random vowel
        $password .= ae_arr($vowels);

        if ($i == $syllables - 1) // if suffix begin with vovel
            if (in_array($password_suffix[0], $vowels)) // add one more consonant 
                $password .= ae_arr($consonants);

    }

    // selecting random suffix
    $password .= $password_suffix;

    return $password;
}

function generate_password($length){
     // A List of vowels and vowel sounds that we can insert in
     // the password string
     $vowels = array("a",  "e",  "i",  "o",  "u",  "ae",  "ou",  "io",  
                     "ea",  "ou",  "ia",  "ai"); 
     // A List of Consonants and Consonant sounds that we can insert
     // into the password string
     $consonants = array("b",  "c",  "d",  "g",  "h",  "j",  "k",  "l",  "m",
                         "n",  "p",  "r",  "s",  "t",  "u",  "v",  "w",  
                         "tr",  "cr",  "fr",  "dr",  "wr",  "pr",  "th",
                         "ch",  "ph",  "st",  "sl",  "cl");
     // For the call to rand(), saves a call to the count() function
     // on each iteration of the for loop
     $vowel_count = count($vowels);
     $consonant_count = count($consonants);
     // From $i .. $length, fill the string with alternating consonant
     // vowel pairs.
     for ($i = 0; $i < $length; ++$i) {
         $pass .= $consonants[rand(0,  $consonant_count - 1)] .
                  $vowels[rand(0,  $vowel_count - 1)];
     }
     
     // Since some of our consonants and vowels are more than one
     // character, our string can be longer than $length, use substr()
     // to truncate the string
     return substr($pass,  0,  $length);
 
}

function generatePassword($length=9, $strength=0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}

function passe_mnemo(){
	#Description :
#Génère un mot de passe prononçable, pour faciliter sa mémorisation, mais malgré tout très compliqué.
#Par exemple :
#ZbleUrg (prononçable, mais difficile).
#Auteur : Damien Seguy
#Url : http://www.nexen.net
 if (func_num_args() == 1){ $nb = func_get_arg(0);} else { $nb = 6;}
 
  // on utilise certains chiffres : 1 = i, 5 = S, 6=b, 3=E, 9=G, 0=O
  $lettre = array();
  $lettre[0] = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',
  'j', 'k', 'l', 'm', 'o', 'n', 'p', 'q', 'r',
  's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A',
  'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
  'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'D',
  'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '9',
  '0', '6', '5', '1', '3');
  $lettre[1] = array('a', 'e', 'i', 'o', 'u', 'y', 'A', 'E',
  'I', 'O', 'U', 'Y' , '1', '3', '0' );
  $lettre[-1] = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k',
  'l', 'm', 'n', 'p', 'q', 'r', 's', 't',
  'v', 'w', 'x', 'z', 'B', 'C', 'D', 'F',
  'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P',
  'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Z',
  '5', '6', '9');

  
 /*
 * mod radeff: suppressed i, I, 1, o, O and 0
 * 
 */   $lettre[0] = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 
  'j', 'k', 'm', 'n', 'p', 'q', 'r',
  's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A',
  'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
  'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'D',
  'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '9', '6', '5', '3');
  $lettre[1] = array('a', 'e', 'o', 'u', 'y', 'A', 'E',
  'I',  'U', 'Y' , '3' );
  $lettre[-1] = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k',
   'm', 'n', 'p', 'q', 'r', 's', 't',
  'v', 'w', 'x', 'z', 'B', 'C', 'D', 'F',
  'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P',
  'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Z',
  '5', '6', '9');

 
  
  
  
  
  
  
  $retour = "";
  $prec = 1;
  $precprec = -1;
  srand((double)microtime()*20001107);
  while(strlen($retour) < $nb){
  // pour genere la suite de lettre, on dit : si les deux lettres sonts
  // des consonnes (resp. des voyelles) on affiche des voyelles (resp, des consonnes).
  // si les lettres sont de type differents, on affiche une lettre de l'alphabet
  $type = ($precprec + $prec)/2;
  $r = $lettre[$type][array_rand($lettre[$type], 1)];
  $retour .= $r;
  $precprec = $prec;
  $prec = in_array($r, $lettre[-1]) - in_array($r, $lettre[1]);
 
  }
//  if(!preg_match("/i/i",$retour)&&!preg_match("/0/",$retour)&&!preg_match("/o/",$retour)){
  return $retour;
//  }else{
//  	passe_mnemo(func_get_arg(0));
//  }
}


######### FILES ###########
/* function to print specified filetypes */
function typefichier($id) {
	echo '<img src="/pmcake/img/filetypes/' .$id .'.gif" alt="' .$id .'" />';
}

######### MySQL ###########

/* function to clean strings before insert or modify SQL */
function normaliser($string) {
//	return trim(addslashes($string));
	return addslashes($string);
}

######### HTML tools #######

function wd_remove_accents($str, $charset='utf-8')
/*
 * une fonction pour remplacer les caractères accentués par des caractères non accentués
* source: http://www.weirdog.com/blog/php/supprimer-les-accents-des-caracteres-accentues.html
*
* usage: $sql=wd_remove_accents($sql);
*/
{
	$str = htmlentities($str, ENT_NOQUOTES, $charset);

	$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
	$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

	return $str;
}
/* keep record of every transactions for logs history */
function ecritlog() {	
	$db=connect_db();
	$db_name=db_name();
	mysql_select_db($db_name,$db);
	$sql ="INSERT INTO `pm_urls_logs` (
	`id` ,
	`time` ,
	`url`
	)
	VALUES (
	NULL , '" .date("Y-m-d H:i:s") ."', '" .$_SERVER["REQUEST_URI"] ."'
	);
	";
	#echo $sql; exit;
	#do and check sql
	//don't run if image or so
	if(!preg_match("/\.gif$/",$_SERVER["REQUEST_URI"])) {
		$sql=mysql_query($sql);

		if(!$sql) {
			echo "SQL error: " .mysql_error(); exit;
		}
	}
}


/*convert SQL date time to french date*/
function dateSQL2fr($date) {
	$date=explode(" ", $date);
	$hour=$date[1];
	$date=$date[0];
	$date=explode("-", $date);
//	$date=mktime(0,0,0,$date[2],$date[1],$date[0]);
	$date=mktime(0,0,0,$date[1],$date[2],$date[0]);
	echo strftime("%a, %d-%m-%Y", $date);
}	

function dateSQLlong2fr($date) {
	if($date>1000000000) {
	//unixtime
	$timestamp=$date;
	} else {
			$timestamp=strtotime($date);		
	}
		//echo $date;
	$date_mod= date('D, d-m-Y H:i',$timestamp);
	$today1=dateen2fr($date_mod);
	echo $today1;
}	
/*same but no day name (shorter)*/
function dateSQL2frSmall($date) {
	$date=explode(" ", $date);
	$hour=$date[1];
	$date=$date[0];
	$date=explode("-", $date);
	
	$date=mktime(0,0,0,$date[1],$date[2],$date[0]);
	echo strftime("%d-%m-%Y", $date);
}	

/*convert english short date to french short date*/
function dateen2fr($today1) {
#mois en francais - attention à le faire dans ce sens car Mar(s) < Mardi !
$today1 = preg_replace("/Jan/", "Janvier", $today1);
$today1 = preg_replace("/Feb/", "Février", $today1);
$today1 = preg_replace("/Mar/", "Mars", $today1);
$today1 = preg_replace("/Apr/", "Avril", $today1);
$today1 = preg_replace("/May/", "Mai", $today1);
$today1 = preg_replace("/Jun/", "Juin", $today1);
$today1 = preg_replace("/Jul/", "Juillet", $today1);
$today1 = preg_replace("/Aug/", "Août", $today1);
$today1 = preg_replace("/Sept/", "Septembre", $today1);
$today1 = preg_replace("/Oct/", "Octobre", $today1);
$today1 = preg_replace("/Nov/", "Novembre", $today1);
$today1 = preg_replace("/Dec/", "Décembre", $today1);

$today1 = preg_replace("/Mon/", "Lundi", $today1);
$today1 = preg_replace("/Tue/", "Mardi", $today1);
$today1 = preg_replace("/Wed/", "Mercredi", $today1);
$today1 = preg_replace("/Thu/", "Jeudi", $today1);
$today1 = preg_replace("/Fri/", "Vendredi", $today1);
$today1 = preg_replace("/Sat/", "Samedi", $today1);
$today1 = preg_replace("/Sun/", "Dimanche", $today1);

//$today1=preg_replace("/-/"," ", $today1);

return $today1;
}

/* function to extract urls from variables */
function urlise($chaine) { 
	$chaine = preg_replace("/(https:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	$chaine=preg_replace("/(http:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	if(preg_match("/([a-zA-Z0-9]*\.)?[a-zA-Z0-9]*\.[a-zA-Z0-9]*@/",$chaine)){ 	//replace emails with mailto
	$search = '#(^|[ \n\r\t])(([a-z0-9\-_]+(\.?))+@([a-z0-9\-]+(\.?))+[a-z]{2,5})#si';
	$replace = '\\1<a href="mailto:\\2">\\2</a>';
	$chaine=preg_replace($search, $replace, $chaine);
	}else {
	if(!preg_match("/http:.*/",$chaine)){	//avoid to put a mailto: if the email is a GET variable
	$chaine = preg_replace('/[-a-zA-Z0-9]*\.?[-a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);
	}	
	
	}

	//echo nl2br($chaine);
	$chaine=nl2br($chaine);
	return $chaine;
}
function urlise2($chaine) { 
	#echo "test urlize: <br>" .$chaine ."<hr>";
	#$chaine=ereg_replace("(http://)(([[:punct:]]|[[:alnum:]]=?)*)","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine = preg_replace("/(https:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	$chaine=preg_replace("/(http:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	//now replace emails
	if(!preg_match("/[a-zA-Z0-9]*\.[a-zA-Z0-9]*@/",$chaine)){
	#$chaine = ereg_replace('[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~]+@([.]?[a-zA-Z0-9_/-])*','<a href="mailto:\\0">\\0</a>',$chaine);
	#$chaine = preg_replace('/[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);
	}else {
	$chaine = preg_replace('/[-a-zA-Z0-9]*\.?[-a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);	
	}

	//echo nl2br($chaine);
	$chaine=nl2br($chaine);
	echo $chaine;
}
function link_task($chaine) {
/*
 * highlight tasks linked
*/

	$chaine = preg_replace('/\{\{(.*?)\|(.*?)\}\}/', "
			<a href=\"/intranet/pmcake/pm_tasks/edit/$2\" title=\"linked task\">
			<span style=\"color: #008080;\">
			<img src=\"/intranet/pmcake/img/icons/bullet_arrow.gif\"
			border=\"0\" alt=\"linked task\" />linked task</span></a>", $chaine);
	return $chaine;

}


/* function to extract titles from variables */
function extrait_titres($chaine) { 
	#echo "test urlize: <br>" .$chaine ."<hr>";
	#$chaine=ereg_replace("(http://)(([[:punct:]]|[[:alnum:]]=?)*)","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine = preg_replace("/=== (.*)/","<br/><h2>\\1</h2>",$chaine);
	$chaine = preg_replace("/== (.*)/","<h3>\\1</h3>",$chaine);
	$chaine = preg_replace("/= (.*)/","<h4>\\1</h4>",$chaine);
	//echo nl2br($chaine);
//	$chaine="bla".$chaine;
	return $chaine;
}


function melto($chaine) { 
	#echo "test urlize: <br>" .$chaine ."<hr>";
	#$chaine=ereg_replace("(http://)(([[:punct:]]|[[:alnum:]]=?)*)","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine = "<a href=\"mailto:" .$chaine ."\">".$chaine ."</a>";
	echo $chaine;
}
######### BAD ###########
/* todo bad : used mysql connection, to remove - settings are in config/core.php 
 * */

	
/* a function to distinct private projets / tasks */
/* other available images: fleur.jpg redstar.jpg  redStar.png redstar.png * */	

function perso_list() {
		echo '<img src="/pmcake/img/icons/redstar.png" alt="Perso" title="Perso" style="width: 10px"/>&nbsp;';
}

/* options for delaying tasks */
function delais() {	
		echo '<option value="">--- repousser ---</option>';
		$sql="SELECT * FROM pm_delays ORDER BY days";
		$sql=mysql_query($sql);
		if(!$sql) {
			echo "SQL error: " .mysql_error(); exit;
		}
		$i=0;
		while($i<mysql_num_rows($sql)){
			echo "<option value=\"" .mysql_result($sql,$i,'days') ."\">repousser " .mysql_result($sql,$i,'lib')."</option>";
			$i++;
			}
}

/* options for tasks hours */
function ajoutheure() {	
		$sql="SELECT * FROM pm_times ORDER BY hours";
		$sql=mysql_query($sql);
		if(!$sql) {
			echo "SQL error: " .mysql_error(); exit;
		}
		$i=0;
		while($i<mysql_num_rows($sql)){
			echo "<option value=\"" .mysql_result($sql,$i,'hours') ."\">" .mysql_result($sql,$i,'lib')."</option>";
			$i++;
			}
}

/* print actions */
function les_actions($idaction) {
	$les_actions="
	e($html->link($html->image('toolbar/add.png', array('alt' => 'Ajouter', 'title' => 'Ajouter')), array('action'=>'add'), array('escape' => false)));
	e($html->link($html->image('toolbar/editor.png', array('alt' => 'Modifier')), array('action'=>'edit', $idaction), array('alt' => 'Modifier', 'title' => 'Modifier', 'escape' => false)));
	$delete_text = isset($delete_text) ? $delete_text : ___d('alaxos', 'do you really want to delete this item ?', true);
	e($html->link($html->image('toolbar/drop.png', array('alt' => __d('alaxos', 'delete', true))), array('action' => 'delete', $idaction), array('alt' => ___d('alaxos', 'delete', true), 'title' => ___d('alaxos', 'delete', true), 'escape' => false), $delete_text));
	e($html->link($html->image('toolbar/list.png', array('alt' => __d('alaxos', 'list', true))), array('action' => 'index'), array('alt' => ___d('alaxos', 'list', true), 'title' => ___d('alaxos', 'list', true), 'escape' => false)));
";
return $les_actions;
}

/* report the delay for a given task */
function push_delays($idc,$table) {
if($table==1){
$repousser="";
} else {
$repousser="../";
}
echo "<form action=\"".$repousser."repousser\" method=\"get\" name=\"" .$idc ."\">";
echo "<input type=\"hidden\" name=\"identifiant\" value=\"" .$idc ."\" />
	<a href=\"javascript:demain(" .$idc .")\"><img src=\"/pmcake/img/icons/bullet_arrow.gif\" alt=\"Déplacer à demain\" title=\"Déplacer à demain\"></a>
        <select name=\"ajout\" class=\"micro\" size=\"1\" onchange=\"repousser(" .$idc .",this.value)\" id=\"sel" .$idc ."\">";
		delais();
		echo "</select>";
	if($table==1){
		echo "<!-- ############ task ok ######### -->
		 	&nbsp;<input style=\"background: orange\" type=\"checkbox\" title=\"OK?\" name=\"ok\" onchange=\"task_ok(" .$idc .",this.value)\" />
		      ";
			echo"</td><td>";
	}
echo "</form>";
}

/* report the delay for many tasks ££*/
function push_all_delays($idc) {
echo "<form method=\"get\">
	<a href=\"javascript:demain(" .$idc .")\"><img src=\"/pmcake/img/icons/bullet_arrow.gif\" alt=\"Déplacer à demain\" title=\"Déplacer à demain\"></a>
	
        <select name=\"global_repousser\" class=\"micro\" size=\"1\" onchange=\"this.form.submit()\">";
delais();
echo "        </select>
      </form>
      </td>
      <td>";
}

function champiprevisualiser($id = null) {
		echo '<img width="100" src="' .CHEMINPHOTOS .'/'.$id.'"></em><span></span>';
	}
		
########################## UPLOADER #########################################	
			/**
 * Upload a file to a specified destination
 * 
 * @param string $path Path of original file
 * @param string $source Temp file
 * @param string $dest Destination path
 * @access public 
 */
function uploadFile($path, $source, $dest)
{
        #$source = str_replace('\\', '/', $source);;
       /* if (!is_dir($path)) {
            createDir($path);
        }*/
        $destination = $path . '/' . $dest;
        move_uploaded_file($source, $destination)||die("unable to mv tmp file and create");
    
}
function createDir($path)
{
	/**
 * Folder creation
 * 
 * @param string $path Path to the new directory
 * @access public 
 */
#            @mkdir('../webroot/files/' . $path, 0777)||die("unable to create dir");
            @mkdir('../webroot/files/' . $path, 0777);
}

//Link checker source http://www.phptoys.com/tutorial/create-link-checker.html
function getPage($link){
   
   if ($fp = fopen($link, 'r')) {
      $content = '';
        
      while ($line = fread($fp, 1024)) {
         $content .= $line;
      }
   }

   //echo $content;  
   if(strlen($content)<1) {
	echo "<pre>Broken link: " .$link ."</pre>";
	echo $content;
	}
}
function gethead($url) {
  // Gets url ready to use
   $info  = @parse_url( $url );

  // Opens socket
  if(preg_match("/^https/",$url)) {
  $socket=443;
}else{
  $socket=80;
}
  $fp    = @fsockopen( $info["host"],  $socket,  $errno,  $errstr,  10 );

  // Makes sure the socket is open or returns false
  if ( !$fp ) {
     return false;
  } else {

     // Checks the path is not empty
     if( empty( $info["path"] ) ) {

        // If it is empty it fills it
        $info["path"] = "/";
     }
     $query = ""; 

     // Checks if there is a query string in the url
     if( isset( $info["query"] ) ) {

          // If there is a query string it adds a ? to the front of it
          $query = "?".$info["query"]."";
     }

     // Sets the headers to send
      $out  = "HEAD ".$info["path"]."".$query." HTTP/1.0\r\n";
     $out .= "Host: ".$info["host"]."\r\n";
     $out .= "Connection: close \r\n" ;
     $out .= "User-Agent: link_checker/1.1\r\n\r\n";

     // writes the headers out
     fwrite( $fp,  $out );
     $html = '';

     // Reads what gets sent back
     while ( !feof( $fp ) ) {
          $html .= fread( $fp,  200 );
     }

     // Closes socket
     fclose( $fp );
  }
  //return $html;
  //echo $html;
   $headers = explode( "\r\n",  $html );
  unset( $header );
  for( $i=0;isset( $headers[$i] );$i++ ) {

    // Checks if the header is the status header
    if( preg_match( "/HTTP\/[0-9A-Za-z +]/i" , $headers[$i] ) ) {

      // If it is save the status
      $status = preg_replace( "/http\/[0-9]\.[0-9]/i", "", $headers[$i] );
    }
  }
  //return $status; 
  $status=trim($status);
  if($status!="200 OK") {
	 echo "<span style=\"background-color: #FFC8C8; padding: 3px;\">".$status."</span>";
}
} 

function contacts_groupes() {
	$sql="SELECT DISTINCT(Category) AS lib FROM contacts WHERE Category NOT LIKE '' GROUP BY Category";
	$sql=mysql_query($sql);
		if(!$sql) {
			echo "SQL error: " .mysql_error(); exit;
		}
		$i=0;
		?><option value="">*** catégorie ***</option><?
		while($i<mysql_num_rows($sql)){
			echo "<option>" .mysql_result($sql,$i,'lib')."</option>";
			$i++;
			}
}

/* look calendar */
/* ################# task ################# */ 

function extrait_donnees($annee_selectionne,$mois_aff,$jour_aff) {
	
//	echo "$annee_selectionne,$mois_aff,$jour_aff";
	echo "<strong>".$jour_aff."</strong>";

	if($mois_aff<10) {
		$mois_aff1="0".$mois_aff;
	} else {
		$mois_aff1=$mois_aff;
	}
	$sql="SELECT * FROM pm_tasks WHERE due_date LIKE '".$annee_selectionne."-".$mois_aff1."-".$jour_aff."'";
	//echo "<br>" .$sql; //tests
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }

	$i=0;

	echo "<table>";
	while($i<mysql_num_rows($sql)){
	if(intval($i/2)==($i/2)) {
	$couleur="#f5f5f5";
	} else {
		$couleur="#F3F3C6";
	}
		echo "<tr><td style=\"background-color: " .$couleur ."\"><a href=\"" .CHEMIN ."pm_tasks/view/" .mysql_result($sql,$i,'id');
		echo "\" title=\"";
		echo strstr(mysql_result($sql,$i,'description'),0,20);
		echo "\"><span class=\"petit\">";
		echo mysql_result($sql,$i,'name');
		echo "</span></a>";
		echo "<br />";
		statut(mysql_result($sql,$i,'status'));
		echo "<br />";
		?>

		<form action="repousser" method="GET" name="<? echo mysql_result($sql,$i,'id');?>">
		
		<input type="hidden" name="identifiant" value="<? echo mysql_result($sql,$i,'id');?>">
		<input type='image' src="/pmcake/img/icons/bullet_arrow.gif" alt="Déplacer à demain" title="Déplacer à demain" name="demain" value="demain">
			<select name="ajout" class="petit" size="1" onChange="goto_URL(<? echo mysql_result($sql,$i,'id');?>,this.value)">
				<? delais(); ?>
			</select>
			<!--<input type="submit" class="micro">--></form>
	</td>	
		<?
		echo "</tr>";
		$i++;
		} 
	echo "</table>";
}
/* ################# calendar ################# */ 

function calendrier($annee_selectionne,$mois_aff,$jour_aff) {
	echo "<strong>".$jour_aff."</strong>";
if(!is_numeric($mois_aff)) {
	$mois_aff1=date("m");
} else {
	$mois_aff1=$mois_aff;
}	
	if($mois_aff<10) {
		$mois_aff1="0".$mois_aff;
	}
	$sql="SELECT * FROM events, event_types WHERE 
	(start LIKE '".$annee_selectionne."-".$mois_aff1."-".$jour_aff."%'
	OR end LIKE '".$annee_selectionne."-".$mois_aff1."-".$jour_aff."%') 
	AND event_type_id=event_types.id   
	ORDER BY events.start";
	//echo "<br>" .$sql; //tests
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }

	$i=0;

	echo "<table>";
	while($i<mysql_num_rows($sql)){
		$couleur=mysql_result($sql,$i,'color');
		echo "<tr><td style=\"background-color: " .$couleur ."\"><a href=\"" .CHEMIN ."events/edit/" .mysql_result($sql,$i,'events.id');
		echo "\" title=\"";
		echo mysql_result($sql,$i,'title');
		echo '" class="tooltip">';
				echo mysql_result($sql,$i,'title');

		if(strlen(mysql_result($sql,$i,'details'))>0) {
	echo '<em><span></span>'.nl2br(mysql_result($sql,$i,'details')).'</em>';
}
			echo "</a>";
		echo "<br />";
		statut(mysql_result($sql,$i,'end'));
		echo "<br />";
		?>
	</td>	
		<?
		echo "</tr>";
		$i++;
		} 
	echo "</table>";
}
/* extract events for a specific day */
function extraitjour($jour_aff) {
	$sql="SELECT * FROM events, event_types WHERE 
	(start LIKE '".$jour_aff."%'
	OR end LIKE '".$jour_aff ."%') 
	AND event_type_id=event_types.id   
	ORDER BY events.start";
	//echo "<br>" .$sql; //tests
	$sql=mysql_query($sql);
	if(!$sql) { echo "SQL error: " .mysql_error(); }

	$i=0;

	echo "<table>";
	while($i<mysql_num_rows($sql)){
		$couleur=mysql_result($sql,$i,'color');
		echo "<tr><td style=\"background-color: " .$couleur ."\"><a href=\"" .CHEMIN ."events/edit/" .mysql_result($sql,$i,'events.id');
		echo "\" title=\"";
		echo mysql_result($sql,$i,'title');
		echo '" class="tooltip">';
				//echo preg_replace("^...","",mysql_result($sql,$i,'start'));
				$heure=preg_replace("/$jour_aff/","",mysql_result($sql,$i,'start'));
				$heure=preg_replace("/:..$/","",$heure);
				echo $heure;
				echo " ";
				echo mysql_result($sql,$i,'title');

		if(strlen(mysql_result($sql,$i,'details'))>0) {
	echo '<em><span></span>'.nl2br(mysql_result($sql,$i,'details')).'</em>';
}
			echo "</a>";
		echo "<br />";
		statut(mysql_result($sql,$i,'end'));
		echo "<br />";
		?>
	</td>	
		<?
		echo "</tr>";
		$i++;
		} 
	echo "</table>";
}
 function getFirstMonday($week, $year)
{
	// Si le 1er janvier tombe semaine 53 de l'année précédent on doit tenir compte d'une semaine en plus
	if (date("W",mktime(0,0,0,1,1,$year)) == 53)
	{
		$week++;
	}	
#	$startdate =  strtotime('+' . ($week-1) . ' week',mktime(0,0,0,1,1,$year));
	$startdate =  strtotime('+' . ($week) . ' week',mktime(0,0,0,1,1,$year));
	return strtotime('last monday',$startdate);
}

/* ################# faqs ################# */ 

function display_resume_faqs($txt,$l) {
	$txt=substr($txt,0,$l);
	$txt=preg_replace("/.$/","",$txt);
	echo $txt;
}

function check_zefiles($id) {
	$pmTask['PmTask']['id']=$id;
$sql="SELECT * FROM zefiles, pm_tasks WHERE task_id=pm_tasks.id ORDER BY zefiles.id DESC";
//echo $sql;
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}

$i=0;

echo "<table>";
while($i<mysql_num_rows($sql)){
	echo "<tr><td>#" .mysql_result($sql,$i,'id') 
	."</td><td><a href=\"" .CHEMIN ."files/" .mysql_result($sql,$i,'task_id') ."/" .mysql_result($sql,$i,'name') 
	."\">".mysql_result($sql,$i,'name') ."</a></td><td>";
	dateSQL2fr(mysql_result($sql,$i,'created'));
	#http://129.194.18.217/pmcake/files/1946/maisonpotterCapture-Google%20Earth.png
	echo "</td><td>";
	$extension=preg_replace("/^.*\./","",mysql_result($sql,$i,'name'));
	typefichier($extension);
	echo "</td>";
	
$filename = "/var/www/radeff/pmcake/app/webroot/" ."files/" .mysql_result($sql,$i,'task_id') ."/" .mysql_result($sql,$i,'name');

if (file_exists($filename)) {
    echo "<td style=\"background-color: lightgreen; font-size: smaller\">Le fichier $filename existe.</td>";
} else {
    echo "<td style=\"background-color: orange\">Le fichier $filename n'existe pas.
    <a href=\"".CHEMIN."zefiles/delete/".mysql_result($sql,$i,'zefiles.id') ."\">&nbsp;effacer</a>
    </td>";
}
	
	$i++;
	echo "</tr>";
	}
echo "</table>";

}
?>
