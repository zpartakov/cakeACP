  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><? 
$this->pageTitle="Emails Points de distribution";
echo $this->pageTitle 
?>
</title>
</head>
<body>
<?php
$i = 0; $x="";
foreach ($josPdds as $josPdd):
			#$x.= $josPdd['JosPdd']['PDDINo'] .";"; 
			#$x.= $josPdd['JosPdd']['PDDTexte']; 
			#$x.=  " <";
		 $x.=  $josPdd['JosPdd']['PDDEmail'];
		 #$x.=  ">";
		 $x.=  "\n";  
		 
endforeach; 
//echo nl2br(utf8_decode(htmlentities($x)));
echo nl2br($x);
/*echo "<hr>2";
echo nl2br(utf8_encode(htmlentities($x)));
echo "<hr>3";
echo nl2br(htmlentities($x));
*/
		 ?>
</body>
</html>
