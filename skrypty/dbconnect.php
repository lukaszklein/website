<?php

$polaczenie = @mysqli_connect('localhost', 'root', '', 'pai_projekt');
if (!$polaczenie) {
  die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
}
 ?>