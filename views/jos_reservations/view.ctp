<div class="josReservations view">
<!-- <h2><?php  __('JosReservation');?></h2>-->
<h2>Détail demi-journée</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservation['JosReservation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservation['JosReservation']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservation['JosReservation']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nplaces'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservation['JosReservation']['nplaces']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('REMARQUES'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservation['JosReservation']['REMARQUES']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?
$thisDate=$josReservation['JosReservation']['date'];
	$sqlUser="SELECT *
FROM `jos_reservations_details`
WHERE `date` = '".$thisDate ."' ORDER BY user";
	#echo $sqlUser; //tests
	$sqlUser=mysql_query($sqlUser);
	$sqlUserN=mysql_num_rows($sqlUser);
	#if($sqlUserN>0) {
if(!$sqlUserN){
	$sqlUserN=0;
}
#echo " # " .$sqlUserN ."<br>"; //tests
$nplaces=$josReservation['JosReservation']['nplaces'];
	if($sqlUserN==$nplaces){ //le compte est bon
		$color="#00FF00";
		}elseif(($nplaces-$sqlUserN)==1){ //manque un
		$color="#99ff00";
		}elseif(($nplaces-$sqlUserN)==2){ //manque 2
		$color="3ff9900";
		}elseif(($nplaces-$sqlUserN)>=3){ //manque 2
		$color="#FF0000";	//rouge
		}
#	} else {
#	$color="#FF0000";	//rouge
#}
echo "<p style=\"background-color: " .$color ."\">Nombre de places: " .$nplaces ." / inscriptions: " .$sqlUserN ."</p>";

if($sqlUserN>0) {
	$user="";
	echo "<ul>";
	$j=0;
	while($j<$sqlUserN){
		$thisidUser = MYSQL_RESULT($sqlUser,$j,"id");
		$thisUser = MYSQL_RESULT($sqlUser,$j,"user");
		$npersUser = MYSQL_RESULT($sqlUser,$j,"npers");
		$remUser = MYSQL_RESULT($sqlUser,$j,"rem");
		
		
		#$user.="<img src=\"http://www.les-jardins-de-cocagne.ch/cms/images/stories/fruit/strawberry.jpg\" width=\"35\" height=\"25\">";
		#$user.=($j+1) .":";
		$user.="<li>";
		$user.="<a href=\"http://www.les-jardins-de-cocagne.ch/cake/jos_reservations_details/edit/" .$thisidUser."\">" .$thisUser."</a>";
		$user.="<br>Nbre de personnes: " .$npersUser;
		$user.="<br>Remarques: " .$remUser;
		
		#$user.=",&nbsp;";
		$user.="</li>";
		$j++;
	}
	echo ereg_replace("</li>$","",$user);

}
?>








<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Modifier', true), array('action'=>'edit', $josReservation['JosReservation']['id'])); ?> </li>
		<li><?php echo $html->link(__('Effacer', true), array('action'=>'delete', $josReservation['JosReservation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josReservation['JosReservation']['id'])); ?> </li>
		<li><?php echo $html->link(__('Lister', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Nouvelle demi-journée', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
