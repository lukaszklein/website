<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once './skrypty/dbconnect.php';
    
    // Prepare a delete statement
    $sql = "DELETE FROM kategorie WHERE id = ?";
    
    if($stmt = mysqli_prepare($polaczenie, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: kategorie_spis.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
			<div class="col-sm-3"></div>
                <div class="col-sm-4" align=center>
                    <div class="page-header">
                        <h1>Usun wpis</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Czy na pewno chcesz usunac wybrany wpis?</p><br>
                            <p>
                                <input type="submit" value="Tak" class="btn btn-danger">
                                <a href="kategorie_spis.php" class="btn btn-default">Nie</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
	</div>
	<?php include 'stopka.php';?>
	<script src="./js/lightbox.js"></script>
</body>
</html>