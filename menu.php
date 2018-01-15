
<nav class="navbar navbar-inverse">
<div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand">Menu nawigacyjne</a>
    </div>
<div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Strona glowna</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategorie <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php

//Dynamiczne menu (dane z bazy)
$polaczenie = @mysqli_connect('localhost', 'root', '', 'pai_projekt');
if (!$polaczenie) {
  die('Wyst¹pi³ b³¹d po³¹czenia: ' . mysqli_connect_errno());
}
@mysqli_query($polaczenie, 'SET NAMES utf8');
 
$sql = 'SELECT `id`, `nazwa` 
             FROM `kategorie` 
             ORDER BY `nazwa`';
$wynik = mysqli_query($polaczenie, $sql);
if (mysqli_num_rows($wynik) > 0) {
  echo "<ul>" . PHP_EOL;
  while (($kategoria = @mysqli_fetch_array($wynik))) {
    echo '<li><a href="kategorie.php?kat_id=' . $kategoria['id'] . '">' . $kategoria['nazwa'] . '</a></li>' . PHP_EOL;
  }
  echo "</ul>" . PHP_EOL;
} else {
  echo 'wyników 0';
}
 

?>
          </ul>
        </li>
		<li><a href="kontakt.php">Kontakt</a></li>
		<?php
		if ($zalogowany==1)
		{
			if ($_SESSION['user']==1)
		{
		echo '<li><a href="kategorie_spis.php">Edytor zawartosci</a></li>';
		}
		}
		?>
      </ul>
	  <?php 
	  if ( isset($_SESSION['user'])=="" )
	  {
		echo '<ul class="nav navbar-nav navbar-right">';
        echo '<li><a href="rejestruj.php"><span class="glyphicon glyphicon-user"></span> Zarejestruj sie</a></li>';
        echo '<li><a href="loguj.php"><span class="glyphicon glyphicon-log-in"></span> Zaloguj sie</a></li>';
        echo '</ul>';
	  }
	  else
	  {
		  echo '<ul class="nav navbar-nav navbar-right">';
		  echo '<li><a href="profil.php"><span class="glyphicon glyphicon-home"></span> Profil</a></li>';
		  echo '<li><a href="wyloguj.php?logout"><span class="glyphicon glyphicon-log-out"></span> Wyloguj sie</a></li>';
	  }
		  ?>
	  
    </div>
  </div>
  </nav>