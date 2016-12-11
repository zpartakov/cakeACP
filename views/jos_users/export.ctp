<h2><?php __('Cocagnard/e/s');?></h2>

<?php
$i = 0;
foreach ($josUsers as $josUser):
echo "Nom d'utilisateur: " .$josUser['JosUser']['username']; 
echo "<br>Email: ".$josUser['JosUser']['email'];
echo "<br>Role: " .$josUser['JosUser']['usertype'];
echo "<br>################################################<br><br>";
endforeach; 
?>

