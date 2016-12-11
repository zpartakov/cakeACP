<h1>Aide</h1>
La plupart des services se trouvent en passant par le menu "Outils" 	
		<? 
		echo $html->image("potiron.gif", array('url' => '#', 'alt' => 'Outils', 'title' => 'Outils', 'style'=>'width: 27px'));
		?>
<h2>Entrer des récoltes</h2>
Commencer par 
<?php echo $html->link('créer la fiche de récolte', '/recoltes'); ?>
, puis entrer la <?php echo $html->link('récolte de légumes', '/recolteslegumes'); ?>
<h2>Divers</h2>
S'il manque des terrains, légumes, catégories ou autres, les entrer <em>via</em> le menu "Outils" 
