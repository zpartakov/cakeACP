<?php
$this->pageTitle="Les légumes des Jardins de Cocagne";
?>
<table>
<tr>
	<td>
		<a href="http://cocagne.ch" title="Accueil Les Jardins de Cocagne">
			<img style="margin-left: 4em" src="http://cocagne.ch/c5/files/5414/1766/8062/newlogoCa200.png" alt="Les Jardins de Cocagne" />
		</a>
	</td>
	<td>
		Les Jardins de Cocagne<br />
		66 ch. des Plantées<br />
		1285 Sézegnin-Athenaz<br />
		Tél. +41 22 756 34 45<br />
		<br />
		CCP 12-1652-9<br />
		<br />
		Téléphone pour renseignements: 022 734 28 36<br />
		<br />
		Site internet: <a href="http://cocagne.ch/">www.cocagne.ch</a><br />
		@email: <a href="mailto:cocagne@cocagne.ch">cocagne@cocagne.ch</a><br />
	</td>
	<td>
		<a title="FRACP - Fédération romande de l’agriculture contractuelle de proximité" href="http://www.acpch.ch/" target="_blank">
			<img style="float: left;" src="http://www.cocagne.ch/c5/files/6713/8627/8479/logoacpvert.png" alt="logo FRACP - Fédération romande de l’agriculture contractuelle de proximité" width="100" height="64" />
		</a>
	</td>
</tr>
</table>
<div style="font-size: 4em"><?php echo $this->pageTitle; ?></div>

<div style="font-size: 3em">Table des matières</div>
<div class="tdm">
	<?php
	$book="";
	$i = 0;
	foreach ($cocagneLegumes as $cocagneLegume):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		if(!preg_match("/^-/",$cocagneLegume['CocagneLegume']['legume'])){
			/* n'affiche que les titres qui ne commencent pas par un "-"  */
		?>
			<p<?php echo $class;?>>
				<?php echo $cocagneLegume['CocagneLegume']['legume']; ?>&nbsp;
				&nbsp;</p>
			
		<?php 
		/* peuple la variable book avec les infos */
		
		$book.="
			<h1>".$cocagneLegume['CocagneLegume']['legume'] ."</h1>";
		$book.="<p></p><img class=\"illustration\" src=\"http://www.cocagne.ch/cms/images/stories/legumes/".$cocagneLegume['CocagneLegume']['id'] .".jpg\"></p>";
			$book.="
			<h2>
			Saisons:
			</h2><p>";
			
			$saisons="";
						 
						if ($cocagneLegume['CocagneLegume']['printemps']==1){
						$saisons.= "Printemps, ";
						}
						if ($cocagneLegume['CocagneLegume']['ete']==1){
						$saisons.="Été, ";
						}
						if ($cocagneLegume['CocagneLegume']['automne']==1){
						$saisons.="Automne, ";
						}						
						if ($cocagneLegume['CocagneLegume']['hiver']==1){
						$saisons.= "Hiver";
						}
						$saisons=preg_replace("/, $/","",$saisons);
			$book.=$saisons;			
			$book.="</p>";	
				if(strlen($cocagneLegume['CocagneLegume']['generalite'])>1) {
				$book.="
					<h2>";
					    $book.= "Généralité :
					</h2>
					   <p>";
					
						$book.= nl2br($cocagneLegume['CocagneLegume']['generalite']);
						$book.="
					   </p>";
				}
				
				
				if(strlen($cocagneLegume['CocagneLegume']['origine'])>1) {
					$book.="
					<h2>";
					   $book.= "Origine :
					</h2>
					   <p>
					   ";
						$book.= nl2br($cocagneLegume['CocagneLegume']['origine']);
					   $book.="</p>";
				}

				if(strlen($cocagneLegume['CocagneLegume']['choix'])>1) {
					$book.="
						<h2>";
					   $book.= "Choix :
					</h2>
					   <p>
					   ";
					$book.= nl2br($cocagneLegume['CocagneLegume']['choix']);
					   $book.="</p>
					";
				}

				if(strlen($cocagneLegume['CocagneLegume']['preparation'])>1) {
					$book.="				<h2>";
				   $book.= "Préparation:
				</h2>
				   
				   <p>";
				$book.= nl2br($cocagneLegume['CocagneLegume']['preparation']);
				   $book.="</p>
				";
				}
				
				if(strlen($cocagneLegume['CocagneLegume']['conservation'])>1) {
					$book.="
				<h2>";
				   $book.=  "Conservation :
				</h2>
				   <p>";
				$book.= nl2br($cocagneLegume['CocagneLegume']['conservation']);
				   $book.="
				</p>";
				}
				
				if(strlen($cocagneLegume['CocagneLegume']['conseils'])>1) {
					$book.="
				<h2>";
				   $book.= "Conseils :
				</h2>
				   <p>";
				$book.= nl2br($cocagneLegume['CocagneLegume']['conseils']);
				   $book.="
				</p>";
				}
				
				if(strlen($cocagneLegume['CocagneLegume']['conseils_sante'])>1) {
					$book.="
				<h2>";
				   $book.= "Conseils santé :
				</h2>
				   <p>";
				$book.= nl2br($cocagneLegume['CocagneLegume']['conseils_sante']);
				   $book.="
				</p>";
				}
				if(strlen($cocagneLegume['CocagneLegume']['remarques'])>1) {
					$book.="
				<h2>";
				   $book.= "Remarques :
				</h2>
				   <p>";
				
				$chaine=$cocagneLegume['CocagneLegume']['remarques'];
				$chaine = preg_replace("/(http:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a href=\"\\0\">\\0</a>",$chaine);
				$book.= nl2br($chaine);
				   $book.="
				</p>";
				}
				$book.="
				<hr />";
						}
	endforeach; 
	?>
</div>
<div style="margin-right: 7cm">
<?php
echo $book;
?>
</div>
