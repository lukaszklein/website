<?php include './skrypty/czyzalogowany.php';?>
<!DOCTYPE html>
<html lang="en">
	<?php include 'head.php';?>
	<body>
	<?php include 'naglowek.php';?>
	<?php include 'menu.php';?>
	<?php
		if ($zalogowany==1)
		{
			if ($_SESSION['user']==1)
		{?>
		<div class="row">
		<div class="col-sm-1">
			<nav class="nav-sidebar">
				<ul class="nav">
                    <li><a href="kategorie_spis.php">Kategorie</a></li>
                    <li><a href="produkty_spis.php">Produkty</a></li>
				</ul>
			</nav>
		</div>
		<div class="col-sm-10" align=center>
			<div class="wrapper">
        <div class="container-fluid">              
                    <div class="page-header clearfix">
                        <h2 align=center">Kategorie</h2>
                        <a href="kategorie_tworzenie.php" class="btn btn-success pull-right">Dodaj kategorie</a>
                    </div>
                    <?php
                    // Include config file
                    require_once './skrypty/dbconnect.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM kategorie";
                    if($result = mysqli_query($polaczenie, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            $table="<table class='table table-bordered table-striped'>";
                            $table.="<thead><tr><th>#</th><th>Nazwa</th><th>Dzialanie</th></tr></thead><tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    $table.="<tr><td>" . $row['id'] . "</td><td>" . $row['nazwa'] . "</td>";
                                    $table.="<td>";
                                    $table.="<a href='kategorie_odczyt.php?id=". $row['id'] ."' title='Wyswietl' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                    $table.="<a href='kategorie_edycja.php?id=". $row['id'] ."' title='Zmien' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                    $table.="<a href='kategorie_usuniecie.php?id=". $row['id'] ."' title='Usun' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                    $table.="</td></tr>";
                                }
                                $table.="</tbody></table>";
								echo $table;
                        } else{
                            echo "0 wynikow";
                        }
                    } else{
                        echo "Błąd połączenia " . mysqli_error($polaczenie);
                    }
                    mysqli_close($polaczenie);
                    ?>
                </div>       
			</div>
			</div>
			</div>
	
		<?php }
		else echo 'brak uprawnien';		}
		?>
	
	<?php include 'stopka.php';?>
	<script src="./js/lightbox.js"></script>
	</body>
</html>
