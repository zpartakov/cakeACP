<?php
$path="/home/www/5d627f3a1db67c4ae1d991552c9bba6a/web";
require($path.'/tools/fpdf17/fpdf.php');
class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    $this->Image('../../../pics/newlogoCa200.png',10,12,30);
    $this->Image('../../../pics/fracp.png',170,6,30);
    // Police Arial gras 15
    $this->SetFont('Times','B',15);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(30,10,'Les Jardins de Cocagne');
    // Saut de ligne
    $this->Ln(20);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Times','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);

  
    $pdf->Cell(30,10,utf8_decode('66 ch. des Plantées'));
    $pdf->Ln(5);
    $pdf->Cell(30,10,utf8_decode('1285 Sézegnin-Athenaz'));
    $pdf->Ln(5);
    $pdf->Cell(30,10,utf8_decode('Tél. +41 22 756 34 45'));
    $pdf->Ln(5);
    $pdf->Cell(30,10,'CCP 12-1652-9');
    $pdf->Ln(5);
    $pdf->Cell(30,10,utf8_decode('Téléphone pour renseignements: 022 734 28 36'));
    $pdf->Ln(5);
    $pdf->Cell(30,10,'Site internet: www.cocagne.ch');
    $pdf->Ln(5);
    $pdf->Cell(30,10,'@email: cocagne@cocagne.ch');
    $pdf->SetFont('Times','B',24);
    $pdf->Ln(15);
	$pdf->Cell(30,10,utf8_decode('Les légumes des Jardins de Cocagne'));
    $pdf->Ln(15);
    $pdf->SetFont('Times','',14);
	$pdf->Cell(30,10,utf8_decode('Table des matières'));
    
    $pdf->Ln(15);
    $pdf->SetFont('Times','',12);
    
    $book="";
	$i = 0;
	/*
	 * table des matières
	 */
	 foreach ($cocagneLegumes as $cocagneLegume):
		if(!preg_match("/^-/",$cocagneLegume['CocagneLegume']['legume'])){
			/* n'affiche que les titres qui ne commencent pas par un "-"  */
	$pdf->Cell(30,10,utf8_decode($cocagneLegume['CocagneLegume']['legume']));
    $pdf->Ln(5);
	
						}
	endforeach; 
    /*
     * on recommence la boucle avec le détail de chaque légumes
     */
    foreach ($cocagneLegumes as $cocagneLegume):
		if(!preg_match("/^-/",$cocagneLegume['CocagneLegume']['legume'])){
			$pdf->Ln(25);
			/* n'affiche que les titres qui ne commencent pas par un "-"  */
	    $pdf->SetFont('Times','B',24);
			
	$pdf->Cell(30,10,utf8_decode($cocagneLegume['CocagneLegume']['legume']));
    $pdf->Ln(10);
        $pdf->SetFont('Times','',12);
//        $img='/web/c5/images/stories/legumes/'.$cocagneLegume['CocagneLegume']['id'] .'.jpg';
  //      $pdf->Image($img,10,12,30);
    						
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
						$pdf->Ln(5);
						$pdf->Cell(30,10,"Saisons: ".utf8_decode($saisons));
				if(strlen($cocagneLegume['CocagneLegume']['generalite'])>1) {
						$pdf->Ln(5);
						$pdf->Cell(30,10,utf8_decode("Généralité : ".$cocagneLegume['CocagneLegume']['generalite']));
				}    
	
	}
	endforeach; 
$pdf->Output();
exit;
?>
<div class="tdm">
	<?php
/*			$book.="
			<div class=\"titre\">
			$book.="</p>";	
				$book.="
					<div class=\"titre\">";
					    $book.= "
					</div>
					   <p>";
					
						$book.= nl2br();
						$book.="
					   </p>";
				}
				
				
				if(strlen($cocagneLegume['CocagneLegume']['origine'])>1) {
					$book.="
					<div class=\"titre\">";
					   $book.= "Origine :
					</div>
					   <p>
					   ";
						$book.= nl2br($cocagneLegume['CocagneLegume']['origine']);
					   $book.="</p>";
				}

				if(strlen($cocagneLegume['CocagneLegume']['choix'])>1) {
					$book.="
						<div class=\"titre\">";
					   $book.= "Choix :
					</div>
					   <p>
					   ";
					$book.= nl2br($cocagneLegume['CocagneLegume']['choix']);
					   $book.="</p>
					";
				}

				if(strlen($cocagneLegume['CocagneLegume']['preparation'])>1) {
					$book.="				<div class=\"titre\">";
				   $book.= "Préparation:
				</div>
				   
				   <p>";
				$book.= nl2br($cocagneLegume['CocagneLegume']['preparation']);
				   $book.="</p>
				";
				}
				
				if(strlen($cocagneLegume['CocagneLegume']['conservation'])>1) {
					$book.="
				<div class=\"titre\">";
				   $book.=  "Conservation :
				</div>
				   <p>";
				$book.= nl2br($cocagneLegume['CocagneLegume']['conservation']);
				   $book.="
				</p>";
				}
				
				if(strlen($cocagneLegume['CocagneLegume']['conseils'])>1) {
					$book.="
				<div class=\"titre\">";
				   $book.= "Conseils :
				</div>
				   <p>";
				$book.= nl2br($cocagneLegume['CocagneLegume']['conseils']);
				   $book.="
				</p>";
				}
				
				if(strlen($cocagneLegume['CocagneLegume']['conseils_sante'])>1) {
					$book.="
				<div class=\"titre\">";
				   $book.= "Conseils santé :
				</div>
				   <p>";
				$book.= nl2br($cocagneLegume['CocagneLegume']['conseils_sante']);
				   $book.="
				</p>";
				}
				if(strlen($cocagneLegume['CocagneLegume']['remarques'])>1) {
					$book.="
				<div class=\"titre\">";
				   $book.= "Remarques :
				</div>
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
*/
	?>
