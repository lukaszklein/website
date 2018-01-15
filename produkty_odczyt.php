<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once './skrypty/dbconnect.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM produkty WHERE id = ?";
    
    if($stmt = mysqli_prepare($polaczenie, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["nazwa"];
				$cat = $row['kategoria_id'];
				$desc = $row['opis'];
				$img = $row['img'];
				$mini = $row['imgmini'];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<?php include './skrypty/czyzalogowany.php';?>
<!DOCTYPE html>
<html lang="en">
	<?php include 'head.php';?>
	<body>
	<?php include 'naglowek.php';?>
	<?php include 'menu.php';?>
	<div class="row">
	<div class="col-sm-1">
			<nav class="nav-sidebar">
				<ul class="nav">
                    <li><a href="kategorie_spis.php">Kategorie</a></li>
                    <li><a href="produkty_spis.php">Produkty</a></li>
				</ul>
			</nav>
		</div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10" align=center>
                    <div class="page-header">
                        <h1>Widok produktu</h1>
                    </div>
                    <div class="form-group">
                        <label>Nazwa</label>
                        <p class="form-control-static"><?php echo $name; ?></p>
                    </div>
					<div class="form-group">
                        <label>Kategoria</label>
                        <p class="form-control-static"><?php echo $cat; ?></p>
                    </div>
					<div class="form-group">
                        <label>Opis</label>
                        <p class="form-control-static"><?php echo $desc; ?></p>
                    </div>
					<div class="form-group">
                        <label>Obraz</label>
                        <p class="form-control-static"><?php echo $img; ?></p>
                    </div>
					<div class="form-group">
                        <label>Miniatura</label>
                        <p class="form-control-static"><?php echo $mini; ?></p>
                    </div>
                    <p><a href="produkty_spis.php" class="btn btn-primary">Powrót</a></p>
                </div>
            </div>        
        </div>
    </div>
	</div>
	<?php include 'stopka.php';?>
	<script src="./js/lightbox.js"></script>
</body>
</html>
