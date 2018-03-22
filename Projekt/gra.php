<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Super Farmer</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class=main>
<img src=logo.png width="400" height="150"><br/>
<a class=button href='nowagra.php'>Nowa Gra</a>
<a class=button href='zasady.php'>Zasady</a>
<a input type="submit" value="Rzuć kostkami"</a>
<br/>

<?php	//góra
class Stado{
	public $krolik;
	public $owca;
	public $swinia;
	public $krowa;
	public $kon;
	public $mpies;
	public $dpies;
	
	function Stado()
	{
		$this->krolik=60;
		$this->owca=24;
		$this->swinia=20;
		$this->krowa=12;
		$this->kon=6;
		$this->mpies=4;
		$this->dpies=2;
	}
}
class Gracz extends Stado{
	public $nazwa;

	function Gracz($nazwa)
	{
		$this->nazwa=$nazwa;
		$this->krolik=0;
		$this->owca=0;
		$this->swinia=0;
		$this->krowa=0;
		$this->kon=0;
		$this->mpies=0;
		$this->dpies=0;
	}
}
if (isset($_POST['gracze'])){  //nowa gra
	$_SESSION['iloscgraczy']=$_POST['gracze'];
	$_SESSION['ruch']=1;
	$_SESSION['stado']=new Stado();
	if ($_POST['gracze']==2)
	{
		$_SESSION['gracze'] = array(
		1=>new Gracz($_POST['gracz1']),
		2=>new Gracz($_POST['gracz2']),
		);
	}
	if ($_POST['gracze']==3)
	{
		$_SESSION['gracze'] = array(
		1=>new Gracz($_POST['gracz1']),
		2=>new Gracz($_POST['gracz2']),
		3=>new Gracz($_POST['gracz3']),
		);
	}
	if ($_POST['gracze']==4)
	{
		$_SESSION['gracze'] = array(
		1=>new Gracz($_POST['gracz1']),
		2=>new Gracz($_POST['gracz2']),
		3=>new Gracz($_POST['gracz3']),
		4=>new Gracz($_POST['gracz4']),
		);
	}
}
if (!isset($_SESSION['iloscgraczy']))
	header("Location: nowagra.php");
if (isset($_POST['tura'])){	//zmiana tury
	if ($_SESSION['ruch']==$_SESSION['iloscgraczy'])
		$_SESSION['ruch']=1;
	else
		$_SESSION['ruch']++;
}

echo '<h1>Gracz '.$_SESSION['ruch'].' - '.$_SESSION['gracze'][$_SESSION['ruch']]->nazwa.'</h1>'; // czyja tura
?>

<div class="obok">
<?php
if (isset($_POST['zmiana'])) // wymiana lub rzut kostka
{
	if ($_SESSION['gracze'][$_SESSION['ruch']]->krolik>0	//sprawdzanie czy wygrales
		&& $_SESSION['gracze'][$_SESSION['ruch']]->owca>0
		&& $_SESSION['gracze'][$_SESSION['ruch']]->swinia>0
		&& $_SESSION['gracze'][$_SESSION['ruch']]->krowa>0
		&& $_SESSION['gracze'][$_SESSION['ruch']]->kon>0)
		{
			echo '<h1>WYGRALES</h1>';
			return;
		}
	$r1=rand(1,12);		//losowanie kostki
	$r2=rand(1,12);
	//echo 'Wyrzucono: ',$r1,' i ', $r2;
	echo '<h3>Wylosowano</h3>';		
	
	
	
	
	
	if  ($r2==12)	//losowanie kostki - lis
	{
		
			$x=($_SESSION['gracze'][$_SESSION['ruch']]->krolik);
			if($_SESSION['gracze'][$_SESSION['ruch']]->mpies>=1)
			{
			$_SESSION['gracze'][$_SESSION['ruch']]->mpies=$_SESSION['gracze'][$_SESSION['ruch']]->mpies-1;
			$_SESSION['stado']->mpies=$_SESSION['stado']->mpies+1;
			}
			else
			{
			
			$_SESSION['stado']->krolik += $_SESSION['gracze'][$_SESSION['ruch']]->krolik;	
			$_SESSION['gracze'][$_SESSION['ruch']]->krolik=0;
			
			}
		
		echo '<br>Atak LISA!<br>';
		echo '<img class="fadeIn" style="border:4px solid red;" src=8.jpg>';
	}
	
	if ($r1==12)	//losowanie kostki - wilk
	{
	
			/*$x1=($_SESSION['gracze'][$_SESSION['ruch']]->krolik);
			$x2=($_SESSION['gracze'][$_SESSION['ruch']]->swinia);
			$x3=($_SESSION['gracze'][$_SESSION['ruch']]->owca);
			$x4=($_SESSION['gracze'][$_SESSION['ruch']]->krowa);
			*/
			if($_SESSION['gracze'][$_SESSION['ruch']]->dpies>=1)
			{
			$_SESSION['gracze'][$_SESSION['ruch']]->dpies=$_SESSION['gracze'][$_SESSION['ruch']]->dpies-1;
			$_SESSION['stado']->dpies=$_SESSION['stado']->dpies+1;
			}
			else
			{
			
			$_SESSION['stado']->krolik += $_SESSION['gracze'][$_SESSION['ruch']]->krolik;	
			$_SESSION['gracze'][$_SESSION['ruch']]->krolik=0;
			
			$_SESSION['stado']->swinia += $_SESSION['gracze'][$_SESSION['ruch']]->swinia;	
			$_SESSION['gracze'][$_SESSION['ruch']]->swinia=0;
			
			$_SESSION['stado']->owca += $_SESSION['gracze'][$_SESSION['ruch']]->owca;	
			$_SESSION['gracze'][$_SESSION['ruch']]->owca=0;
			
			$_SESSION['stado']->krowa += $_SESSION['gracze'][$_SESSION['ruch']]->krowa;	
			$_SESSION['gracze'][$_SESSION['ruch']]->krowa=0;
			
			}
		
		echo '<br>Atak WILKA!<br>';
		echo '<img class="fadeIn" style="border:4px solid green;" src=9.jpg>';
	}
	
	
	
	
	
	
	else if ($r1<=6)		//losowanie kostki - krolik
	{
		$los1='krolik';
		if ($r2<=6)
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->krolik+2)/2);
			if($_SESSION['stado']->krolik>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krolik+=$x;
				$_SESSION['stado']->krolik=$_SESSION['stado']->krolik-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krolik+=$_SESSION['stado']->krolik;
				$_SESSION['stado']->krolik=0;
			}
		} 
		
		else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->krolik+1)/2);
			if($_SESSION['stado']->krolik>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krolik+=$x;
				$_SESSION['stado']->krolik=$_SESSION['stado']->krolik-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krolik+=$_SESSION['stado']->krolik;
				$_SESSION['stado']->krolik=0;
			}
		}
		//echo 'Dostales '.$x.' krolikow<br/>';
		echo '<img class="fadeIn" style="border:4px solid green;" src=1.jpg>';
	}
	
	
	
	
	
	else if (($r1>6) and ($r1<=9))		//losowanie kostki - owca
	{
		$los1='owca';
		if (($r2>6) and ($r2<=9))
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->owca+2)/2);
			if($_SESSION['stado']->owca>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->owca+=$x;
				$_SESSION['stado']->owca=$_SESSION['stado']->owca-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->owca+=$_SESSION['stado']->owca;
				$_SESSION['stado']->owca=0;
			}
		} else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->owca+1)/2);
			if($_SESSION['stado']->owca>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->owca+=$x;
				$_SESSION['stado']->owca=$_SESSION['stado']->owca-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->owca+=$_SESSION['stado']->owca;
				$_SESSION['stado']->owca=0;
			}
		}
		//echo 'Dostales '.$x.' owiec<br/>';
		echo '<img class="fadeIn" style="border:4px solid green;" src=2.jpg>';
	}

	
	
	
	
	else if ($r1==10)		//losowanie kostki - swinia
	{
		$los1='swinia';
		if ($r2==10)
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->swinia+2)/2);
			if($_SESSION['stado']->swinia>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->swinia+=$x;
				$_SESSION['stado']->swinia=$_SESSION['stado']->swinia-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->swinia+=$_SESSION['stado']->swinia;
				$_SESSION['stado']->swinia=0;
			}
		} else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->swinia+1)/2);
			if($_SESSION['stado']->swinia>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->swinia+=$x;
				$_SESSION['stado']->swinia=$_SESSION['stado']->swinia-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->swinia+=$_SESSION['stado']->swinia;
				$_SESSION['stado']->swinia=0;
			}
		}
		//echo 'Dostales '.$x.' swin<br/>';
		echo '<img class="fadeIn" style="border:4px solid green;" src=3.jpg>';
	}	
	
	
	
	
	
	else if ($r1==11)		//losowanie kostki - krowa
	{
		$los1='krowa';
		if ($r2==11)
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->krowa+2)/2);
			if($_SESSION['stado']->krowa>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krowa+=$x;
				$_SESSION['stado']->krowa=$_SESSION['stado']->krowa-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krowa+=$_SESSION['stado']->krowa;
				$_SESSION['stado']->krowa=0;
			}
		} else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->krowa+1)/2);
			if($_SESSION['stado']->krowa>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krowa+=$x;
				$_SESSION['stado']->krowa=$_SESSION['stado']->krowa-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krowa+=$_SESSION['stado']->krowa;
				$_SESSION['stado']->krowa=0;
			}
		}
		//echo 'Dostales '.$x.' owiec<br/>';
		echo '<img class="fadeIn" style="border:4px solid green;" src=4.jpg>';
	}
	
		
	
	
	
	
	
     if ($r2<=6)		//losowanie kostki - krolik
	{
		$los2='krolik';
		if ($r1<=6)
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->krolik+2)/2);
			if($_SESSION['stado']->krolik>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krolik+=$x;
				$_SESSION['stado']->krolik=$_SESSION['stado']->krolik-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krolik+=$_SESSION['stado']->krolik;
				$_SESSION['stado']->krolik=0;
			}
		} 
		
		else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->krolik+1)/2);
			if($_SESSION['stado']->krolik>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krolik+=$x;
				$_SESSION['stado']->krolik=$_SESSION['stado']->krolik-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->krolik+=$_SESSION['stado']->krolik;
				$_SESSION['stado']->krolik=0;
			}
		}
		//echo 'Dostales '.$x.' krolikow<br/>';
		echo '<img class="fadeIn" style="border:4px solid red;" src=1.jpg>';
	}
	
	
	
	
	
	
	
	
	
	
	else if (($r2>6) and ($r2<=8))		//losowanie kostki - owca
	{
		$los2='owca';
		if (($r1>6) and ($r1<=8))
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->owca+2)/2);
			if($_SESSION['stado']->owca>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->owca+=$x;
				$_SESSION['stado']->owca=$_SESSION['stado']->owca-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->owca+=$_SESSION['stado']->owca;
				$_SESSION['stado']->owca=0;
			}
		} else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->owca+1)/2);
			if($_SESSION['stado']->owca>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->owca+=$x;
				$_SESSION['stado']->owca=$_SESSION['stado']->owca-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->owca+=$_SESSION['stado']->owca;
				$_SESSION['stado']->owca=0;
			}
		}
		//echo 'Dostales '.$x.' owiec<br/>';
		echo '<img class="fadeIn" style="border:4px solid red;" src=2.jpg>';
	}

	
	
	
	
	
	

	else if (($r2>8) and ($r2<=10))		//losowanie kostki - swinia
	{
		$los2='swinia';
		if (($r1>8) and ($r1<=10))
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->swinia+2)/2);
			if($_SESSION['stado']->swinia>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->swinia+=$x;
				$_SESSION['stado']->swinia=$_SESSION['stado']->swinia-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->swinia+=$_SESSION['stado']->swinia;
				$_SESSION['stado']->swinia=0;
			}
		} else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->swinia+1)/2);
			if($_SESSION['stado']->swinia>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->swinia+=$x;
				$_SESSION['stado']->swinia=$_SESSION['stado']->swinia-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->swinia+=$_SESSION['stado']->swinia;
				$_SESSION['stado']->swinia=0;
			}
		}
		//echo 'Dostales '.$x.' swin<br/>';
		echo '<img class="fadeIn" style="border:4px solid red;" src=3.jpg>';
	}	
	
	
	
	
	
	
	
	
	
	else if ($r2==11)		//losowanie kostki - kon
	{
		$los2='kon';
		if ($r1==11)
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->kon+2)/2);
			if($_SESSION['stado']->kon>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->kon+=$x;
				$_SESSION['stado']->kon=$_SESSION['stado']->kon-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->kon+=$_SESSION['stado']->kon;
				$_SESSION['stado']->kon=0;
			}
		} else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->kon+1)/2);
			if($_SESSION['stado']->kon>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->kon+=$x;
				$_SESSION['stado']->kon=$_SESSION['stado']->kon-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->kon+=$_SESSION['stado']->kon;
				$_SESSION['stado']->kon=0;
			}
		}
		//echo 'Dostales '.$x.' owiec<br/>';
		echo '<img class="fadeIn" style="border:4px solid red;" src=5.jpg>';
	}
	
	
	/*
	else if ($r2==9)		//losowanie kostki - mpies
	{
		$los2='mpies';
		if ($r1==9)
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->mpies+2)/2);
			if($_SESSION['stado']->mpies>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->mpies+=$x;
				$_SESSION['stado']->mpies=$_SESSION['stado']->mpies-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->mpies+=$_SESSION['stado']->mpies;
				$_SESSION['stado']->mpies=0;
			}
		} else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->mpies+1)/2);
			if($_SESSION['stado']->mpies>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->mpies+=$x;
				$_SESSION['stado']->mpies=$_SESSION['stado']->mpies-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->mpies+=$_SESSION['stado']->mpies;
				$_SESSION['stado']->mpies=0;
			}
		}
		//echo 'Dostales '.$x.' owiec<br/>';
		echo '<img class="fadeIn" src=6.jpg>';
	}
	
	else if ($r2==10)		//losowanie kostki - dpies
	{
		$los2='dpies';
		if ($r1==10)
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->dpies+2)/2);
			if($_SESSION['stado']->dpies>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->dpies+=$x;
				$_SESSION['stado']->dpies=$_SESSION['stado']->dpies-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->dpies+=$_SESSION['stado']->dpies;
				$_SESSION['stado']->dpies=0;
			}
		} else
		{
			$x=floor(($_SESSION['gracze'][$_SESSION['ruch']]->dpies+1)/2);
			if($_SESSION['stado']->dpies>$x)
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->dpies+=$x;
				$_SESSION['stado']->dpies=$_SESSION['stado']->dpies-$x;
			} else
			{
				$_SESSION['gracze'][$_SESSION['ruch']]->dpies+=$_SESSION['stado']->dpies;
				$_SESSION['stado']->dpies=0;
			}
		}
		//echo 'Dostales '.$x.' owiec<br/>';
		echo '<img class="fadeIn" src=7.jpg>';
	}
	
	*/
/*
	@$los1d=$x;
	
	
	if (isset($los1))
	{
		echo '<br/>Dodano '.$los1d.' '.$los1;
	}
	if (isset($los2))
	{
		if (isset($los1))
			if (!($los1==$los2))
		echo '<br/>Dodano '.$x.' '.$los2;
	}
	*/
		echo '
	<br/><br/><form method="post">
	<input type="hidden" name="tura" value="1" />
	<input type="submit" value="Koniec tury" />
	</form>';
} else
{
	if (isset($_POST['ile']))		//wymiana (sprawdzanie czy mozesz i wymiana)
	{
		if($_SESSION['gracze'][$_SESSION['ruch']]->$_POST['co']<$_POST['ile'])
		{
			echo 'Nie masz tyle :(';
		} else
		{
			if($_SESSION['stado']->$_POST['naco']<$_POST['naile'])
			{
				echo 'Nie ma tyle w stadzie :(';
			} else
			{
				$_SESSION['stado']->$_POST['naco']-=$_POST['naile'];
				$_SESSION['stado']->$_POST['co']+=$_POST['ile'];
				$_SESSION['gracze'][$_SESSION['ruch']]->$_POST['co']-=$_POST['ile'];
				$_SESSION['gracze'][$_SESSION['ruch']]->$_POST['naco']+=$_POST['naile'];
			}
		}
		echo '<br/>Masz:'.$_SESSION['gracze'][$_SESSION['ruch']]->$_POST['co'];
	}
	
	
	
	
	if (($_SESSION['gracze'][$_SESSION['ruch']]->krolik>=6) or ($_SESSION['gracze'][$_SESSION['ruch']]->owca>=1) or ($_SESSION['gracze'][$_SESSION['ruch']]->swinia>=1) or ($_SESSION['gracze'][$_SESSION['ruch']]->krowa>=1) or ($_SESSION['gracze'][$_SESSION['ruch']]->kon>=1) or ($_SESSION['gracze'][$_SESSION['ruch']]->mpies>=1) or ($_SESSION['gracze'][$_SESSION['ruch']]->dpies>=1)){
	echo @'
<h3>Wymień</h3>
<select id=1 form="zamiana" name="co" onchange="ustaw()" size="7">
  <option value="krolik">króliki</option>
  <option value="owca">owce</option>
  <option value="swinia">świnie</option>
  <option value="krowa">krowy</option>
  <option value="kon">konie</option>
  <option value="mpies">małe psy</option>
  <option value="dpies">duże psy</option>
</select>
<p class=jednalinia id="demo"></p>
<select id=2 form="zamiana" name="naco" onchange="ustaw()" size="7">
  <option value="krolik">króliki</option>
  <option value="owca">owce</option>
  <option value="swinia">świnie</option>
  <option value="krowa">krowy</option>
  <option value="kon">konie</option>
  <option value="mpies">małe psy</option>
  <option value="dpies">duże psy</option>
</select>
<form method="post" id="zamiana">
<input id="ile" type="text" name ="ile" readonly size=3/>:
<input id="doilu" type="text" name ="naile" readonly size=3/><br/>
<input type="submit" value="Wymień!" /><br/><br/>
	</form>';}

echo @'
<br>
<form action="gra.php" method="post">
<input type="hidden" name="zmiana">
<input type="submit" value="Rzuć kostkami"/>
</form>
';
}

?>
<script>
function ustaw() {		//funkcja liczaca ile na ile mozesz zamienic i wypelnia forme
	if ((document.getElementById(1).selectedIndex==-1) || (document.getElementById(2).selectedIndex==-1))
		return;
	var x;
	var y;
	switch (document.getElementById(1).selectedIndex) {
    case 0:
        x = 1;
        break;
    case 5:
    case 1:
        x = 6;
        break;
    case 2:
        x = 12;
        break;
    case 3:
	case 6:
        x = 36;
        break;
    case 4:
        x = 72;
        break;
	}
	switch (document.getElementById(2).selectedIndex) {
    case 0:
        y = 1;
        break;
    case 1:
    case 5:
        y = 6;
        break;
    case 2:
        y = 12;
        break;
    case 3:
	case 6:
        y = 36;
        break;
    case 4:
        y = 72;
        break;
	}
	if (x>y) {
		x=x/y;
		y=1;
	} 
	else {
		y=y/x;
		x=1;
	}
	document.getElementById('ile').value=y;
	document.getElementById('doilu').value=x;
}
</script>
</div>
<div class="obok">
<h3>Zwierzęta w stadzie:</h3>
<?php echo '
 <img class="min" src=1.jpg>: '.$_SESSION['stado']->krolik.'<br/>
 <img class="min" src=2.jpg>: '.$_SESSION['stado']->owca.'<br/>
 <img class="min" src=3.jpg>: '.$_SESSION['stado']->swinia.'<br/>
 <img class="min" src=4.jpg>: '.$_SESSION['stado']->krowa.'<br/>
 <img class="min" src=5.jpg>: '.$_SESSION['stado']->kon.'<br/>
 <img class="min" src=6.jpg>: '.$_SESSION['stado']->mpies.'<br/>
 <img class="min" src=7.jpg>: '.$_SESSION['stado']->dpies.'<br/>
';
?>
<br><h3>Tabela wymiany</h3>
1 owca      = 6 królików<br/>
1 świnia    =     2 owce<br/>
1 krowa     =   3 świnie<br/>
1 koń       =    2 krowy<br/>
1 mały pies =     1 owca<br/>
1 duży pies =    1 krowa<br/>
</div>
<div class="obok">
<h3>Twoje zwierzęta:</h3>
<?php			//twoje zwierzeta
if ($_SESSION['gracze'][$_SESSION['ruch']]->krolik>0)
	echo ' <img  src=1.jpg> x'.$_SESSION['gracze'][$_SESSION['ruch']]->krolik.'<br/>';
if ($_SESSION['gracze'][$_SESSION['ruch']]->owca>0)
	echo ' <img  src=2.jpg> x'.$_SESSION['gracze'][$_SESSION['ruch']]->owca.'<br/>';
if ($_SESSION['gracze'][$_SESSION['ruch']]->swinia>0)
	echo ' <img  src=3.jpg> x'.$_SESSION['gracze'][$_SESSION['ruch']]->swinia.'<br/>';
if ($_SESSION['gracze'][$_SESSION['ruch']]->krowa>0)
	echo ' <img  src=4.jpg> x'.$_SESSION['gracze'][$_SESSION['ruch']]->krowa.'<br/>';
if ($_SESSION['gracze'][$_SESSION['ruch']]->kon>0)
	echo ' <img  src=5.jpg> x'.$_SESSION['gracze'][$_SESSION['ruch']]->kon.'<br/>';
if ($_SESSION['gracze'][$_SESSION['ruch']]->mpies>0)
	echo ' <img  src=6.jpg> x'.$_SESSION['gracze'][$_SESSION['ruch']]->mpies.'<br/>';
if ($_SESSION['gracze'][$_SESSION['ruch']]->dpies>0)
	echo ' <img  src=7.jpg> x'.$_SESSION['gracze'][$_SESSION['ruch']]->dpies.'<br/>';
?>
</div>

</div>
</body>
</html>