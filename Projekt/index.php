<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<div class=main>
<img src=logo.png width="400" height="150"><br/>

<a class=button href='nowagra.php'>Nowa Gra</a>
<a class=button href='zasady.php'>Zasady</a><br/>

<h2>Wybierz liczbę graczy:</h2>

<form class="wlini" method="post">
   <input type="hidden" name ="gracze" value="2" />
   <input type="submit" value="2 Graczy" />
</form>
<form class="wlini" method="post">
   <input type="hidden" name ="gracze" value="3" />
   <input type="submit" value="3 Graczy" />
</form>
<form class="wlini" method="post">
   <input type="hidden" name ="gracze" value="4" />
   <input type="submit" value="4 Graczy" />
</form><br/><br/>



<?php
if (isset($_POST['gracze']))
{
	echo '
	<form method="post" action="gra.php">
	';
	$ile=$_POST['gracze']+1;
	for ($i=1;$i<$ile;$i++)
	{
		echo '<input type="text" name="gracz'.$i.'" placeholder="Gracz '.$i.'" />';
	}
	echo '<br/>
	<input type="hidden" name="gracze" value="'.$_POST['gracze'].'"/><br/>
	<input type="submit" value="Start" />
	</form>
	';
}
?>





</div>
</html>