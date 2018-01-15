<div class="container">
<?php

$polaczenie = @mysqli_connect('localhost', 'root', '', 'pai_projekt');
if (!$polaczenie) {
  die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
}
@mysqli_query($polaczenie, 'SET NAMES utf8');

$kat_id = isset($_GET['kat_id']) ? (int)$_GET['kat_id'] : 1;
$sql = 'SELECT `nazwa`, `opis`, `img`, `imgmini` 
             FROM `produkty` 
             WHERE `kategoria_id` = ' . $kat_id .
             ' ORDER BY `nazwa`';
$wynik = mysqli_query($polaczenie, $sql);
$wszystkie_produkty=array();
while ($objekt = mysqli_fetch_array($wynik))
{
	$wszystkie_produkty[]=$objekt;
}
	$table='<table class="table">';
    $table.='<thead><tr><th>Nazwa produktu</th><th>Opis produktu</th><th>Miniatura</th></tr></thead>';
    $table.='<tbody>';
if (mysqli_num_rows($wynik) > 0) {
  foreach($wszystkie_produkty as $produkt) {
	  $table.='<tr>';
	  $table.='<td><b>' . $produkt['nazwa'] . '</b></td>';
      $table.='<td>' . $produkt['opis'] . '</td>';
	  $table.='<td><a href="./img/' . $produkt['img'] . '" data-lightbox="gwozdz" data-title="'.$produkt['opis'].'"><img class="example-image" src="./img/' . $produkt['imgmini'] . '" alt="Mlot 1"/></a></td></tr>'. PHP_EOL; 
  }
  $table.='</tbody></table>';
  echo $table;
} else {
  echo 'wyników 0';
}
?>
</div>